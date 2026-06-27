<?php

namespace DesignPatterns\Structural\Decorator;

/**
 * Base Decorator that wraps a NotifierInterface instance.
 *
 * Delegates all send() calls to the wrapped notifier by default.
 * Concrete decorators extend this class to add extra behaviour
 * before or after the delegation.
 */
abstract class NotifierDecorator implements NotifierInterface
{
    /**
     * The wrapped notifier instance (component or another decorator).
     *
     * @var NotifierInterface
     */
    protected NotifierInterface $notifier;

    /**
     * @param NotifierInterface $notifier The notifier to wrap.
     */
    public function __construct(NotifierInterface $notifier)
    {
        $this->notifier = $notifier;
    }

    /**
     * Delegate the send call to the wrapped notifier.
     *
     * @param string $message The notification content to deliver.
     *
     * @return void
     */
    public function send(string $message): void
    {
        $this->notifier->send($message);
    }
}
