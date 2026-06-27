<?php

namespace DesignPatterns\Behavioral\Command;

/**
 * Concrete command: encapsulates a block-user action.
 */
class BlockUserCommand implements CommandInterface
{
    /**
     * @param UserService $userService Receiver that performs the blocking.
     * @param int         $userId      The ID of the user to block.
     */
    public function __construct(
        private readonly UserService $userService,
        private readonly int $userId,
    ) {
    }

    /**
     * Execute the block-user action on the receiver.
     *
     * @return void
     */
    public function execute(): void
    {
        $this->userService->blockUser($this->userId);
    }
}
