<?php

namespace DesignPatterns\Structural\Decorator;

/**
 * Concrete Decorator: adds Slack notification on top of any existing notifier.
 *
 * Calls the wrapped notifier first, then posts the message
 * to the configured Slack channel.
 */
class SlackNotifierDecorator extends NotifierDecorator
{
    /**
     * The target Slack channel name (e.g. '#critical-alerts').
     *
     * @var string
     */
    private string $slackChannel;

    /**
     * @param NotifierInterface $notifier     The notifier to wrap.
     * @param string            $slackChannel Target Slack channel (e.g. '#critical-alerts').
     */
    public function __construct(NotifierInterface $notifier, string $slackChannel)
    {
        parent::__construct($notifier);
        $this->slackChannel = $slackChannel;
    }

    /**
     * Delegate to the wrapped notifier, then post a Slack message.
     *
     * @param string $message The notification content to deliver.
     *
     * @return void
     */
    public function send(string $message): void
    {
        parent::send($message);

        echo "Sending SLACK message to {$this->slackChannel}: {$message}" . PHP_EOL;
    }
}
