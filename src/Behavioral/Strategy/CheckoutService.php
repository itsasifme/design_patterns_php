<?php

namespace DesignPatterns\Behavioral\Strategy;

/**
 * Context that delegates delivery fee calculation to the active strategy.
 *
 * Clients select a strategy at construction time and may swap it at any
 * point to change the delivery fee algorithm at runtime.
 */
class CheckoutService
{
    /**
     * @param DeliveryFeeStrategyInterface $deliveryFeeStrategy The initial fee strategy.
     */
    public function __construct(
        private DeliveryFeeStrategyInterface $deliveryFeeStrategy,
    ) {
    }

    /**
     * Replace the active delivery fee strategy at runtime.
     *
    * @param DeliveryFeeStrategyInterface $deliveryFeeStrategy The new strategy to use.
     *
     * @return void
     */
    public function setDeliveryFeeStrategy(DeliveryFeeStrategyInterface $deliveryFeeStrategy): void
    {
        $this->deliveryFeeStrategy = $deliveryFeeStrategy;
    }

    /**
     * Calculate the delivery fee using the currently active strategy.
     *
     * @param float $orderTotal  Total value of the order.
     * @param float $distanceKm Distance to the delivery address in kilometres.
     *
     * @return float The calculated delivery fee.
     */
    public function calculateDeliveryFee(float $orderTotal, float $distanceKm): float
    {
        return $this->deliveryFeeStrategy->calculate($orderTotal, $distanceKm);
    }
}
