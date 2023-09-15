<?php

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Akash\UserProject\UserDTO;
use PHPUnit\Framework\TestCase;
use Akash\UserProject\UserService;
use GuzzleHttp\Handler\MockHandler;

/**
 * Class UserServiceIntegrationTest
 *
 * This class contains integration tests for the UserService class.
 */
class UserServiceIntegrationTest extends TestCase
{
    /**
     * @var UserService The UserService instance to be used in the tests.
     */
    private $userService;

    protected function setUp(): void
    {
        $mockHandler = new MockHandler([
            new Response(200, [], json_encode(['data' => ['id' => 1, 'first_name' => 'John', 'last_name' => 'Smith', 'email' => 'john.smith@example.com']])),
            new Response(201, [], json_encode(['id' => 2])),
        ]);

        $handlerStack = HandlerStack::create($mockHandler);
        $client = new Client(['handler' => $handlerStack]);

        $this->userService = new UserService($client);
    }

    /**
     * Test retrieving a user by ID.
     */
    public function testGetUserById()
    {
        $user = $this->userService->getUserById(1);

        $this->assertInstanceOf(UserDTO::class, $user);
        $this->assertEquals(1, $user->getId());
        $this->assertEquals('John', $user->getFirstName());
        $this->assertEquals('Smith', $user->getLastName());
        $this->assertEquals('john.smith@example.com', $user->getEmail());
    }

    /**
     * Test creating a new user.
     * @todo not working correctly would need some more time to look into this -> Returning null instead of int
     */
    public function testCreateUser()
    {
        $name = 'Jane Smith';
        $job = 'Designer';
        $userId = $this->userService->createUser($name, $job);

        $this->assertIsInt($userId);
        $this->assertEquals(2, $userId);
    }

    // @todo write another test in regards with getting paginated users.
}
