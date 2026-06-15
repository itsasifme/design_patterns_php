<?php

require_once __DIR__ . '/../vendor/autoload.php';

use DesignPatterns\Structural\Adapter\ObjectAdapter\AmadeusFareAdapter;
use DesignPatterns\Structural\Adapter\AmadeusSoapService;
use DesignPatterns\Structural\Adapter\FlightFareProcessor;

class ObjectAdapterDemo
{
    /**
     * Run the complete Object Adapter pattern demonstration.
     *
     * @return void
     */
    public function run(): void
    {
        $this->showHeader();

        $this->demonstrateObjectAdapter();

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
        echo "    OBJECT ADAPTER PATTERN DEMONSTRATION    \n";
        echo "============================================\n\n";
    }

    /**
     * Demonstrate the Object Adapter pattern.
     *
     * @return void
     */
    private function demonstrateObjectAdapter(): void
    {
        echo "Amadeus SOAP Service Adaptation (via Object Composition)\n";
        echo "=====================================================\n";

        $flightFareProcessor = new FlightFareProcessor();
        $flightFareProcessor->displayFare(new AmadeusFareAdapter(new AmadeusSoapService()));

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
        echo "✅ Object Adapter pattern demo completed! ✅\n";
        echo "============================================\n";
    }
}

// Run demonstration
$demo = new ObjectAdapterDemo();
$demo->run();