<?php

namespace DesignPatterns\Behavioral\Command;

/**
 * Receiver: contains the actual user-management business logic.
 */
class UserService
{
    /**
     * Block the specified user account.
     *
     * @param int $userId The ID of the user to block.
     *
     * @return void
     */
    public function blockUser(int $userId): void
    {
        echo "User {$userId} blocked.\n";
    }
}
