<?php

require_once __DIR__ . '/../vendor/autoload.php';

use DesignPatterns\Structural\Decorator\EmailNotifier;
use DesignPatterns\Structural\Decorator\FacebookNotifierDecorator;
use DesignPatterns\Structural\Decorator\SlackNotifierDecorator;
use DesignPatterns\Structural\Decorator\SmsNotifierDecorator;

class DecoratorDemo
{
    /**
     * Run the complete Decorator pattern demonstration.
     *
     * @return void
     */
    public function run(): void
    {
        $this->showHeader();

        $this->demonstrateEmailOnly();
        $this->demonstrateEmailWithSms();
        $this->demonstrateAllChannels();

        $this->showFooter();
    }

    /**
     * Display demonstration header.
     *
     * @return void
     */
    private function showHeader(): void
    {
        echo "============================================\n";
        echo "      DECORATOR PATTERN DEMONSTRATION       \n";
        echo "============================================\n\n";
    }

    /**
     * Demonstrate base EmailNotifier with no decoration.
     *
     * @return void
     */
    private function demonstrateEmailOnly(): void
    {
        echo "Scenario 1 — Email Only (no decorators):\n";
        echo "-----------------------------------------\n";

        $notifier = new EmailNotifier([
            'user@example.com',
            'admin@example.com',
        ]);

        $notifier->send('Server is down!');
        echo "\n";
    }

    /**
     * Demonstrate EmailNotifier wrapped with the SMS decorator.
     *
     * @return void
     */
    private function demonstrateEmailWithSms(): void
    {
        echo "Scenario 2 — Email + SMS (one decorator):\n";
        echo "------------------------------------------\n";

        $notifier = new EmailNotifier(['user@example.com']);
        $notifier = new SmsNotifierDecorator($notifier, '+8801711111111');

        $notifier->send('Disk usage above 90%!');
        echo "\n";
    }

    /**
     * Demonstrate full decorator chain: Email → SMS → Slack → Facebook.
     *
     * @return void
     */
    private function demonstrateAllChannels(): void
    {
        echo "Scenario 3 — All Channels (full decorator chain):\n";
        echo "---------------------------------------------------\n";

        $notifier = new EmailNotifier([
            'user@example.com',
            'admin@example.com',
        ]);

        // Wrap layer by layer — order determines notification sequence.
        $notifier = new SmsNotifierDecorator($notifier, '+8801711111111');
        $notifier = new SlackNotifierDecorator($notifier, '#critical-alerts');
        $notifier = new FacebookNotifierDecorator($notifier, 'john_doe');

        $notifier->send('Server is down!');
        echo "\n";
    }

    /**
     * Display demonstration footer.
     *
     * @return void
     */
    private function showFooter(): void
    {
        echo "============================================\n";
        echo "✅ Decorator pattern demo completed! ✅\n";
        echo "============================================\n";
    }
}

// Run demonstration
$demo = new DecoratorDemo();
$demo->run();
