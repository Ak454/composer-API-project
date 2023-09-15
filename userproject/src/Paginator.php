<?php

namespace Akash\UserProject;

/**
 * Class Paginator
 *
 * This class is responsible for handling paginated requests to the remote API.
 * It can retrieve the next page and determine if there are more results to return.
 *
 */
class Paginator
{
    /**
     * @var UserService The user service for making API requests.
     */
    private UserService $userService;

    /**
     * @var int The current page of results.
     */
    private int $currentPage;

    /**
     * @var int The total number of pages.
     */
    private int $totalPages;

   /**
     * UserPaginator constructor.
     *
     * @param UserService $userService The user service for making API requests.
     * @param int $currentPage The current page of results.
     * @param int $totalPages The total number of pages.
     */

    public function __construct(UserService $userService, $currentPage, $totalPages)
    {
        $this->userService = $userService;
        $this->currentPage = $currentPage;
        $this->totalPages = $totalPages;
    }

    /**
     * Retrieves the next page of results.
     *
     * @return PaginatedUserDTO|null The next page of user data or null if there are no more pages.
     */
    public function getNextPage()
    {
        if ($this->currentPage < $this->totalPages) {
            return $this->userService->getPaginatedUsers($this->currentPage + 1);
        }

        return null;
    }

    /**
     * Checks if there are more results available.
     *
     * @return bool Returns true if there are more results, false otherwise.
     */
    public function hasMoreResults()
    {
        return $this->currentPage < $this->totalPages;
    }
}