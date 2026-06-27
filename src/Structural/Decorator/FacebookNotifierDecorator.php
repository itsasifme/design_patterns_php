<?php

namespace DesignPatterns\Structural\Decorator;

/**
 * Concrete Decorator: adds Facebook notification on top of any existing notifier.
 *
 * Calls the wrapped notifier first, then sends the message
 * to the configured Facebook user account.
 */
class FacebookNotifierDecorator extends NotifierDecorator
{
    /**
     * The Facebook username or profile handle to notify.
     *
     * @var string
     */
    private string $facebookUser;

    /**
     * @param NotifierInterface $notifier     The notifier to wrap.
     * @param string            $facebookUser Target Facebook username (e.g. 'john_doe').
     */
    public function __construct(NotifierInterface $notifier, string $facebookUser)
    {
        parent::__construct($notifier);
        $this->facebookUser = $facebookUser;
    }

    /**
     * Delegate to the wrapped notifier, then send a Facebook notification.
     *
     * @param string $message The notification content to deliver.
     *
     * @return void
     */
    public function send(string $message): void
    {
        parent::send($message);

        echo "Sending FACEBOOK message to {$this->facebookUser}: {$message}" . PHP_EOL;
    }
}
