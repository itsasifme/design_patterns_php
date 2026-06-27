<?php

require_once __DIR__ . '/../vendor/autoload.php';

use DesignPatterns\Behavioral\Strategy\CheckoutService;
use DesignPatterns\Behavioral\Strategy\ExpressDelivery;
use DesignPatterns\Behavioral\Strategy\StandardDelivery;
use DesignPatterns\Behavioral\Strategy\StorePickup;

class StrategyDemo
{
    /**
     * Run the complete Strategy pattern demonstration.
     *
     * @return void
     */
    public function run(): void
    {
        $this->showHeader();

        $this->demonstrateStandardDelivery();
        $this->demonstrateExpressDelivery();
        $this->demonstrateStorePickup();
        $this->demonstrateStrategySwapping();

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
        echo "       STRATEGY PATTERN DEMONSTRATION       \n";
        echo "============================================\n\n";
    }

    /**
     * Demonstrate standard delivery fee calculation.
     *
     * @return void
     */
    private function demonstrateStandardDelivery(): void
    {
        echo "1. Standard Delivery:\n";
        echo "=====================\n";

        $checkout = new CheckoutService(new StandardDelivery());

        echo "Order \$80,  dist 4 km → fee: " . $checkout->calculateDeliveryFee(80, 4) . "\n";  // 5
        echo "Order \$120, dist 4 km → fee: " . $checkout->calculateDeliveryFee(120, 4) . "\n"; // 0 (free above threshold)

        echo "\n";
    }

    /**
     * Demonstrate express delivery fee calculation.
     *
     * @return void
     */
    private function demonstrateExpressDelivery(): void
    {
        echo "2. Express Delivery:\n";
        echo "====================\n";

        $checkout = new CheckoutService(new ExpressDelivery());

        echo "Order \$80,  dist 4 km → fee: " . $checkout->calculateDeliveryFee(80, 4) . "\n";  // 16
        echo "Order \$120, dist 6 km → fee: " . $checkout->calculateDeliveryFee(120, 6) . "\n"; // 20

        echo "\n";
    }

    /**
     * Demonstrate store pickup (always free).
     *
     * @return void
     */
    private function demonstrateStorePickup(): void
    {
        echo "3. Store Pickup:\n";
        echo "================\n";

        $checkout = new CheckoutService(new StorePickup());

        echo "Order \$80,  dist 4 km → fee: " . $checkout->calculateDeliveryFee(80, 4) . "\n";  // 0
        echo "Order \$200, dist 0 km → fee: " . $checkout->calculateDeliveryFee(200, 0) . "\n"; // 0

        echo "\n";
    }

    /**
     * Demonstrate swapping strategies at runtime.
     *
     * @return void
     */
    private function demonstrateStrategySwapping(): void
    {
        echo "4. Runtime Strategy Swapping:\n";
        echo "==============================\n";

        $checkout = new CheckoutService(new StandardDelivery());
        echo "Standard → fee: " . $checkout->calculateDeliveryFee(80, 4) . "\n";

        $checkout->setDeliveryFeeStrategy(new ExpressDelivery());
        echo "Express  → fee: " . $checkout->calculateDeliveryFee(80, 4) . "\n";

        $checkout->setDeliveryFeeStrategy(new StorePickup());
        echo "Pickup   → fee: " . $checkout->calculateDeliveryFee(80, 4) . "\n";

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
        echo "✅ Strategy pattern demo completed! ✅\n";
        echo "============================================\n";
    }
}

// Run demonstration
$demo = new StrategyDemo();
$demo->run();
