<?php

namespace DesignPatterns\Structural\Decorator;

/**
 * Concrete Decorator: adds SMS notification on top of any existing notifier.
 *
 * Calls the wrapped notifier first, then delivers the message
 * to the configured phone number via SMS.
 */
class SmsNotifierDecorator extends NotifierDecorator
{
    /**
     * The recipient phone number in international format.
     *
     * @var string
     */
    private string $phoneNumber;

    /**
     * @param NotifierInterface $notifier    The notifier to wrap.
     * @param string            $phoneNumber Recipient phone number (e.g. '+8801711111111').
     */
    public function __construct(NotifierInterface $notifier, string $phoneNumber)
    {
        parent::__construct($notifier);
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * Delegate to the wrapped notifier, then send an SMS notification.
     *
     * @param string $message The notification content to deliver.
     *
     * @return void
     */
    public function send(string $message): void
    {
        parent::send($message);

        echo "Sending SMS to {$this->phoneNumber}: {$message}" . PHP_EOL;
    }
}
