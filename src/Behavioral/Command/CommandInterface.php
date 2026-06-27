<?php

namespace DesignPatterns\Behavioral\Command;

/**
 * Command interface.
 *
 * All concrete commands must implement this contract so the
 * CommandBus can invoke them without knowing their details.
 */
interface CommandInterface
{
    /**
     * Execute the encapsulated action.
     *
     * @return void
     */
    public function execute(): void;
}
