<?php

namespace DesignPatterns\Behavioral\Strategy;

/**
 * Express delivery fee strategy.
 *
 * Base fee of 10 plus 1.5 per kilometre.
 */
class ExpressDelivery implements DeliveryFeeStrategyInterface
{
    /**
     * Calculate the express delivery fee.
     *
     * @param float $orderTotal  Total value of the order (unused for express delivery).
     * @param float $distanceKm Distance in kilometres.
     *
     * @return float 10 + (distanceKm * 1.5).
     */
    public function calculate(float $orderTotal, float $distanceKm): float
    {
        return 10 + ($distanceKm * 1.5);
    }
}
