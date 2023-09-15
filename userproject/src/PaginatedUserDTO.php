<?php
namespace Akash\UserProject;

/** 
 * This class represents a paginated list of user data.
 */
class PaginatedUserDTO implements \JsonSerializable
{
    /**
     * @var array The list of users.
     */
    private array $users;

    /**
     * @var int The current page number.
     */
    private int $currentPage;

    /**
     * @var int The total number of pages.
     */
    private int $totalPages;

    /**    
     * @param array $users The list of users.
     * @param int $currentPage The current page number.
     * @param int $totalPages The total number of pages.
     */
    public function __construct($users, $currentPage, $totalPages)
    {
        $this->users = $users;
        $this->currentPage = $currentPage;
        $this->totalPages = $totalPages;
    }

    /**
     * Serialize the object to JSON.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'users' => $this->users,
            'current_page' => $this->currentPage,
            'total_pages' => $this->totalPages,
        ];
    }
}