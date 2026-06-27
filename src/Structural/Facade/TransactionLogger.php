<?php
namespace DesignPatterns\Structural\Facade;

/**
 * Logs transaction events and statuses.
 */
class TransactionLogger
{
    /**
     * Record a transaction status.
     *
     * @param string $status
     * @return void
     */
    public function logTransaction(string $status): void
    {
        echo "Logging transaction status: {$status}" . PHP_EOL;
    }
}
