<?php

namespace Akash\UserProject;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class UserService
{
    /**
     * @var Client The HTTP client for making API requests.
     */
    private $client;

    /**
     * @param Client $client The HTTP client for making API requests.
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Makes an API request with error handling.
     * 
     * Possible improvements could be to add a retry timer, e.g. if request fails due to timeout or perhaps hitting an api Limit, can set a fallback to retry the request after certain amount of time has passed e.g. 1 minute
     *
     * @param string $method The HTTP method (GET, POST, etc.).
     * @param string $url The URL of the API endpoint.
     * @param array $options The request options. Could be used in the future perhaps 
     *
     * @return array|null The response data or null on error.
     */
    private function makeRequest($method, $url, $options = [])
    {
        try {
            $response = $this->client->request($method, $url, $options);
            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                // Could be extended to handle different API Error codes e.g. 500, 404 etc.
                $response = $e->getResponse();
                $statusCode = $response->getStatusCode();
                $errorBody = json_decode($response->getBody()->getContents(), true);

                // Log or handle the error appropriately using status codes / error body above
                // Can possibly use a retry mechanism if an api rate limit is hit.
            } else {
                // Handle connection or timeout error
                // Log or handle the error appropriately
            }

            return null; // Return null (could throw an exception here)
        }
    }

    /**
     * Retrieves a user by ID.
     *
     * @param int $id The user ID.
     *
     * @return UserDTO|null The user data or null on error.
     */
    public function getUserById($id)
    {
        $data = $this->makeRequest('GET', "https://reqres.in/api/users/{$id}");
        if ($data !== null) {
            return new UserDTO($data['data']);
        }

        return null;
    }

    /**
     * Retrieves a paginated list of users.
     *
     * @param int $page The page number.
     *
     * @return PaginatedUserDTO|null The paginated user data or null on error.
     */
    public function getPaginatedUsers($page = 1)
    {
        $data = $this->makeRequest('GET', "https://reqres.in/api/users?page={$page}");
        if ($data !== null) {
            $users = [];
            foreach ($data['data'] as $userData) {
                $users[] = new UserDTO($userData);
            }

            return new PaginatedUserDTO($users, $data['page'], $data['total_pages']);
        }

        return null;
    }

    /**
     * Creates a new user.
     *
     * @param string $name The user's name.
     * @param string $job The user's job.
     *
     * @return int|null The new user's ID or null on error.
     */
    public function createUser($name, $job)
    {
        $data = $this->makeRequest('POST', 'https://reqres.in/api/users', [
            'json' => [
                'name' => $name,
                'job' => $job,
            ]
        ]);

        if ($data !== null) {
            return $data['id'];
        }

        return null;
    }
}