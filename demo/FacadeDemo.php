<?php

require_once __DIR__ . '/../vendor/autoload.php';

use DesignPatterns\Structural\Facade\PaymentFacade;

class FacadeDemo
{
    /**
     * Run the complete Facade pattern demonstration.
     *
     * @return void
     */
    public function run(): void
    {
        $this->showHeader();

        $this->demonstrateStandardPayment();
        $this->demonstrateLargePayment();

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
        echo "       FACADE PATTERN DEMONSTRATION         \n";
        echo "============================================\n\n";
    }

    /**
     * Demonstrate a standard payment transaction.
     *
     * @return void
     */
    private function demonstrateStandardPayment(): void
    {
        echo "1. Standard Payment (\$250.00):\n";
        echo "================================\n";

        $payment = new PaymentFacade();
        $payment->processPayment('1234-5678-9012-3456', 250.00);

        echo "\n";
    }

    /**
     * Demonstrate a large payment transaction.
     *
     * @return void
     */
    private function demonstrateLargePayment(): void
    {
        echo "2. Large Payment (\$5,000.00):\n";
        echo "================================\n";

        $payment = new PaymentFacade();
        $payment->processPayment('9876-5432-1098-7654', 5000.00);

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
        echo "✅ Facade pattern demo completed! ✅\n";
        echo "============================================\n";
    }
}

// Run demonstration
$demo = new FacadeDemo();
$demo->run();
