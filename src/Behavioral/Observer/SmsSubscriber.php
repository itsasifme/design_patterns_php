<?php

namespace DesignPatterns\Behavioral\Observer;

/**
 * Concrete observer: handles product notifications via SMS.
 */
class SmsSubscriber implements ObserverInterface
{
    /**
     * Send an SMS notification when the subject triggers an update.
     *
     * @param string $message The notification message.
     *
     * @return void
     */
    public function update(string $message): void
    {
        echo "SMS sent: {$message}\n";
    }
}
