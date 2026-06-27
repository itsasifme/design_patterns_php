<?php

namespace DesignPatterns\Structural\Decorator;

/**
 * Concrete Component: the core notifier that sends messages via email.
 *
 * This is the base object being decorated. It implements
 * NotifierInterface directly without wrapping anything.
 */
class EmailNotifier implements NotifierInterface
{
    /**
     * List of recipient email addresses.
     *
     * @var string[]
     */
    private array $emails;

    /**
     * @param string[] $emails One or more recipient email addresses.
     */
    public function __construct(array $emails)
    {
        $this->emails = $emails;
    }

    /**
     * Send the message to all configured email addresses.
     *
     * @param string $message The notification content to deliver.
     *
     * @return void
     */
    public function send(string $message): void
    {
        foreach ($this->emails as $email) {
            echo "Sending EMAIL to {$email}: {$message}" . PHP_EOL;
        }
    }
}
