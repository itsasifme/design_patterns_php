<?php

namespace DesignPatterns\Behavioral\Observer;

/**
 * Observer interface.
 *
 * Any object that wants to receive notifications from a subject
 * must implement this contract.
 */
interface ObserverInterface
{
    /**
     * Receive and react to a notification from the subject.
     *
     * @param string $message The notification message from the subject.
     *
     * @return void
     */
    public function update(string $message): void;
}
