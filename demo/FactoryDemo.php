<?php

require_once __DIR__ . '/../vendor/autoload.php';

use DesignPatterns\Creational\Factory\RoadLogistics;
use DesignPatterns\Creational\Factory\SeaLogistics;

/**
 * Factory Method Pattern Demonstration - Logistics Example
 */
class FactoryDemo
{
    /**
     * Run the logistics demonstration.
     *
     * @return void
     */
    public function run(): void
    {
        echo "=========================================\n";
        echo "   FACTORY METHOD PATTERN - LOGISTICS    \n";
        echo "=========================================\n\n";

        $this->demonstrateRoadLogistics();
        $this->demonstrateSeaLogistics();
        $this->demonstratePolymorphicUsage();
    }

    /**
     * Demonstrate road logistics with truck transport.
     *
     * @return void
     */
    private function demonstrateRoadLogistics(): void
    {
        echo "1. ROAD LOGISTICS:\n";
        echo "==================\n";

        $roadLogistics = new RoadLogistics();
        $deliveryPlan = $roadLogistics->planDelivery('New York');
        
        echo $deliveryPlan . "\n";
        echo $roadLogistics->getRoadInfo() . "\n\n";
    }

    /**
     * Demonstrate sea logistics with ship transport.
     *
     * @return void
     */
    private function demonstrateSeaLogistics(): void
    {
        echo "2. SEA LOGISTICS:\n";
        echo "=================\n";

        $seaLogistics = new SeaLogistics();
        $deliveryPlan = $seaLogistics->planDelivery('Shanghai');
        
        echo $deliveryPlan . "\n";
        echo $seaLogistics->getSeaInfo() . "\n\n";
    }

    /**
     * Demonstrate polymorphic usage of logistics creators.
     *
     * @return void
     */
    private function demonstratePolymorphicUsage(): void
    {
        echo "3. POLYMORPHIC USAGE:\n";
        echo "=====================\n";

        $logisticsTypes = [
            new RoadLogistics(),
            new SeaLogistics()
        ];

        $destinations = ['London', 'Tokyo', 'Los Angeles'];

        foreach ($logisticsTypes as $index => $logistics) {
            $destination = $destinations[$index] ?? 'Default City';
            
            echo "--- {$logistics->getLogisticsType()} Logistics ---\n";
            
            // Create transport using factory method
            $transport = $logistics->createTransport();
            echo "Created transport: " . $transport->getType() . "\n";
            echo "Capacity: " . $transport->getCapacity() . " kg\n";
            
            // Use the transport
            echo $transport->deliver($destination) . "\n\n";
        }
    }
}

// Run the demonstration
$demo = new FactoryDemo();
$demo->run();