<?php

namespace DesignPatterns\Behavioral\Strategy;

/**
 * Store pickup fee strategy.
 *
 * No delivery fee — customer collects in store.
 */
class StorePickup implements DeliveryFeeStrategyInterface
{
    /**
     * Calculate the store-pickup delivery fee (always zero).
     *
     * @param float $orderTotal  Total value of the order (unused).
     * @param float $distanceKm Distance in kilometres (unused).
     *
     * @return float Always 0.0.
     */
    public function calculate(float $orderTotal, float $distanceKm): float
    {
        return 0;
    }
}
