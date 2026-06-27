<?php

namespace DesignPatterns\Behavioral\Command;

/**
 * Invoker: dispatches commands immediately or queues them for later processing.
 *
 * The CommandBus knows nothing about the business logic inside each command.
 * It only manages execution, queuing, and retry logic.
 */
class CommandBus
{
    /** @var CommandInterface[] Queued commands waiting for deferred execution. */
    private array $queue = [];

    /**
     * Dispatch a command immediately with up to 3 retry attempts.
     *
    * @param CommandInterface $command The command to execute.
     *
     * @return void
     */
    public function dispatch(CommandInterface $command): void
    {
        $this->runWithRetry($command);
    }

    /**
     * Queue a command for deferred execution.
     *
    * @param CommandInterface $command The command to queue.
     *
     * @return self Fluent interface.
     */
    public function dispatchLater(CommandInterface $command): self
    {
        $this->queue[] = $command;
        echo "Command queued.\n";

        return $this;
    }

    /**
     * Process all queued commands in order, with retry logic for each.
     *
     * @return void
     */
    public function processQueue(): void
    {
        foreach ($this->queue as $command) {
            $this->runWithRetry($command);
        }

        $this->queue = [];
    }

    /**
     * Execute a command with up to 3 retry attempts on failure.
     *
    * @param CommandInterface $command The command to run.
     *
     * @return void
     */
    private function runWithRetry(CommandInterface $command): void
    {
        for ($attempt = 1; $attempt <= 3; $attempt++) {
            try {
                echo "Attempt {$attempt}: ";
                $command->execute();

                return;
            } catch (\Throwable $exception) {
                echo "Failed.\n";

                if ($attempt === 3) {
                    echo "Command failed after 3 attempts.\n";
                }
            }
        }
    }
}
