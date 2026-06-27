<?php

require_once __DIR__ . '/../vendor/autoload.php';

use DesignPatterns\Behavioral\Observer\EmailSubscriber;
use DesignPatterns\Behavioral\Observer\Product;
use DesignPatterns\Behavioral\Observer\SmsSubscriber;

class ObserverDemo
{
    /**
     * Run the complete Observer pattern demonstration.
     *
     * @return void
     */
    public function run(): void
    {
        $this->showHeader();

        $this->demonstrateAllSubscribers();
        $this->demonstrateAfterUnsubscribe();
        $this->demonstrateDuplicateSubscription();

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
        echo "       OBSERVER PATTERN DEMONSTRATION       \n";
        echo "============================================\n\n";
    }

    /**
     * Demonstrate all subscribers being notified.
     *
     * @return void
     */
    private function demonstrateAllSubscribers(): void
    {
        echo "1. All Subscribers Notified:\n";
        echo "============================\n";

        $product         = new Product();
        $emailSubscriber = new EmailSubscriber();
        $smsSubscriber   = new SmsSubscriber();

        $product->subscribe($emailSubscriber);
        $product->subscribe($smsSubscriber);

        $product->backInStock('iPhone 15 Pro');

        echo "\n";
    }

    /**
     * Demonstrate notification after unsubscribing one observer.
     *
     * @return void
     */
    private function demonstrateAfterUnsubscribe(): void
    {
        echo "2. After Unsubscribing SMS:\n";
        echo "===========================\n";

        $product         = new Product();
        $emailSubscriber = new EmailSubscriber();
        $smsSubscriber   = new SmsSubscriber();

        $product->subscribe($emailSubscriber);
        $product->subscribe($smsSubscriber);
        $product->unsubscribe($smsSubscriber);

        $product->backInStock('MacBook Air M3');

        echo "\n";
    }

    /**
     * Demonstrate that duplicate subscriptions are silently ignored.
     *
     * @return void
     */
    private function demonstrateDuplicateSubscription(): void
    {
        echo "3. Duplicate Subscription (silently ignored):\n";
        echo "==============================================\n";

        $product         = new Product();
        $emailSubscriber = new EmailSubscriber();

        $product->subscribe($emailSubscriber);
        $product->subscribe($emailSubscriber); // duplicate — silently ignored

        $product->backInStock('AirPods Pro');

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
        echo "✅ Observer pattern demo completed! ✅\n";
        echo "============================================\n";
    }
}

// Run demonstration
$demo = new ObserverDemo();
$demo->run();
