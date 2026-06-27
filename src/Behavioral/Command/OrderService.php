<?php

namespace DesignPatterns\Behavioral\Command;

/**
 * Receiver: contains the actual order-management business logic.
 */
class OrderService
{
    /**
     * Refund the specified order.
     *
     * @param int $orderId The ID of the order to refund.
     *
     * @return void
     */
    public function refundOrder(int $orderId): void
    {
        echo "Order {$orderId} refunded.\n";
    }
}
