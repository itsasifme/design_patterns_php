<?php

namespace DesignPatterns\Creational\Factory;

/**
 * Concrete transport product - Truck for road deliveries.
 */
class Truck implements TransportInterface
{
    private const CAPACITY = 10000.0; // 10 tons
    private const SPEED = 60.0; // 60 km/h average speed

    /**
     * {@inheritDoc}
     */
    public function deliver(string $destination): string
    {
        $time = $this->getEstimatedTime($destination);
        
        return sprintf(
            "🚚 Truck delivering to %s. Estimated time: %.1f hours. Capacity: %.0f kg",
            $destination,
            $time,
            self::CAPACITY
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getType(): string
    {
        return 'truck';
    }

    /**
     * {@inheritDoc}
     */
    public function getCapacity(): float
    {
        return self::CAPACITY;
    }

    /**
     * {@inheritDoc}
     */
    public function getEstimatedTime(string $destination): float
    {
        // Simple estimation: 1 hour per 60 km + 2 hours loading/unloading
        $distance = $this->calculateDistance($destination);
        return ($distance / self::SPEED) + 2.0;
    }

    /**
     * Calculate distance to destination (simplified).
     *
     * @param string $destination The destination city
     * @return float Distance in kilometers
     */
    private function calculateDistance(string $destination): float
    {
        // Simplified distance calculation based on destination length
        return strlen($destination) * 20.0;
    }
}