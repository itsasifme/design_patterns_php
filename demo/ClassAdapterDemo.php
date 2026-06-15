<?php

require_once __DIR__ . '/../vendor/autoload.php';

use DesignPatterns\Structural\Adapter\ClassAdapter\AmadeusFareAdapter;
use DesignPatterns\Structural\Adapter\FlightFareProcessor;

class ClassAdapterDemo
{
    /**
     * Run the complete Class Adapter pattern demonstration.
     *
     * @return void
     */
    public function run(): void
    {
        $this->showHeader();

        $this->demonstrateClassAdapter();

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
        echo "     CLASS ADAPTER PATTERN DEMONSTRATION     \n";
        echo "============================================\n\n";
    }

    /**
     * Demonstrate the Class Adapter pattern.
     *
     * @return void
     */
    private function demonstrateClassAdapter(): void
    {
        echo "Amadeus SOAP Service Adaptation (via Inheritance):\n";
        echo "===================================================\n";

        $flightFareProcessor = new FlightFareProcessor();
        $flightFareProcessor->displayFare(new AmadeusFareAdapter());

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
        echo "✅ Class Adapter pattern demo completed! ✅\n";
        echo "============================================\n";
    }
}

// Run demonstration
$demo = new ClassAdapterDemo();
$demo->run();
