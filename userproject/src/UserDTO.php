<?php
namespace Akash\UserProject;


/**
 * Class UserDTO
 *
 * This class represents a user data transfer object (DTO).
 *
 */
class UserDTO implements \JsonSerializable
{
 
    /**
     * @var int The user's ID.
     */
    private int $id;

     /**
     * @var string The user's first name.
     */
    private string $firstName;

    /**
     * @var string The user's last name.
     */
    private string $lastName;

     /**
     * @var string The user's email address.
     */
    private string $email;

    /**     
     * @param array $data The user data as an associative array.
     */
    public function __construct($data)
    {
        $this->id = $data['id'];
        $this->firstName = $data['first_name'];
        $this->lastName = $data['last_name'];
        $this->email = $data['email'];
    }

    /**
     * Serialize the object to JSON.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'email' => $this->email,
        ];
    }

  /**
     * Get the user's ID.
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get the user's first name.
     *
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * Get the user's last name.
     *
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * Get the user's email address.
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }}
