<?php

namespace DesignPatterns\Behavioral\Strategy;

/**
 * Standard delivery fee strategy.
 *
 * Free shipping for orders of 100 or more; otherwise a flat fee of 5.
 */
class StandardDelivery implements DeliveryFeeStrategyInterface
{
    /**
     * Calculate the standard delivery fee.
     *
     * @param float $orderTotal  Total value of the order.
     * @param float $distanceKm Distance in kilometres (unused for standard delivery).
     *
     * @return float 0.0 for orders >= 100, otherwise 5.0.
     */
    public function calculate(float $orderTotal, float $distanceKm): float
    {
        return $orderTotal >= 100 ? 0 : 5;
    }
}
