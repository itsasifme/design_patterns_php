<?php

namespace DesignPatterns\Behavioral\Command;

/**
 * Receiver: contains the actual marketing business logic.
 */
class MarketingService
{
    /**
     * Send a discount coupon to the specified user.
     *
     * @param int $userId The ID of the user to send the coupon to.
     *
     * @return void
     */
    public function sendCoupon(int $userId): void
    {
        echo "Coupon sent to user {$userId}.\n";
    }
}
