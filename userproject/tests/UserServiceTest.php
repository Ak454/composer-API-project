<?php

use GuzzleHttp\Client;
use Akash\UserProject\UserDTO;
use PHPUnit\Framework\TestCase;
use Akash\UserProject\UserService;
use Akash\UserProject\PaginatedUserDTO;

/**
 * Class UserServiceTest
 *
 * This class contains unit tests for the UserService class.
 */
class UserServiceTest extends TestCase
{
    /**
     * @var UserService The UserService instance to be used in the tests.
     */
    private $userService;

    /**
     * Set up the UserService instance before each test.
     */
    protected function setUp(): void
    {
        $client = new Client();
        $this->userService = new UserService($client);
    }

    /**
     * Test retrieving a user by ID.
     */
    public function testGetUserById()
    {
        $user = $this->userService->getUserById(1);

        $this->assertInstanceOf(UserDTO::class, $user);
    }

    /**
     * Test retrieving a paginated list of users.
     */
    public function testGetPaginatedUsers()
    {
        $paginatedUsers = $this->userService->getPaginatedUsers(1);

        $this->assertInstanceOf(PaginatedUserDTO::class, $paginatedUsers);
    }

    /**
     * Test creating a new user.
     */
    public function testCreateUser()
    {
        $name = 'John Smith';
        $job = 'Web Developer';
        $userId = $this->userService->createUser($name, $job);

        $this->assertIsString($userId);
    }
}
