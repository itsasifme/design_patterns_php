<?php

namespace DesignPatterns\Structural\Decorator;

/**
 * Component interface that defines the contract for both concrete
 * components and decorators.
 *
 * Every notifier and decorator must follow this same interface,
 * enabling transparent wrapping at runtime.
 */
interface NotifierInterface
{
    /**
     * Send a notification message through the implemented channel(s).
     *
     * @param string $message The notification content to deliver.
     *
     * @return void
     */
    public function send(string $message): void;
}