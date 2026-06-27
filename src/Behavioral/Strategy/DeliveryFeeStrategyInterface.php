<?php

namespace DesignPatterns\Behavioral\Strategy;

/**
 * Strategy interface for delivery fee calculation.
 *
 * Defines the common contract that all concrete delivery
 * fee strategies must implement.
 */
interface DeliveryFeeStrategyInterface
{
    /**
     * Calculate the delivery fee for a given order.
     *
     * @param float $orderTotal  Total value of the order in currency units.
     * @param float $distanceKm Distance to the delivery address in kilometres.
     *
     * @return float The calculated delivery fee.
     */
    public function calculate(float $orderTotal, float $distanceKm): float;
}
