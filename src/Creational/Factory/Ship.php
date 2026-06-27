<?php

namespace DesignPatterns\Creational\Factory;

/**
 * Concrete transport product - Ship for sea deliveries.
 */
class Ship implements TransportInterface
{
    private const CAPACITY = 500000.0; // 500 tons
    private const SPEED = 25.0; // 25 knots average speed

    /**
     * {@inheritDoc}
     */
    public function deliver(string $destination): string
    {
        $time = $this->getEstimatedTime($destination);
        
        return sprintf(
            "🚢 Ship delivering to %s. Estimated time: %.1f hours. Capacity: %.0f kg",
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
        return 'ship';
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
        // Sea delivery: 1 hour per 25 nautical miles + 8 hours port operations
        $distance = $this->calculateDistance($destination);
        return ($distance / self::SPEED) + 8.0;
    }

    /**
     * Calculate distance to destination (simplified).
     *
     * @param string $destination The destination port
     * @return float Distance in nautical miles
     */
    private function calculateDistance(string $destination): float
    {
        // Simplified distance calculation based on destination length
        return strlen($destination) * 50.0;
    }
}