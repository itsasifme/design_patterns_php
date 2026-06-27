<?php

namespace DesignPatterns\Behavioral\Command;

/**
 * Concrete command: encapsulates a refund-order action.
 */
class RefundOrderCommand implements CommandInterface
{
    /**
     * @param OrderService $orderService Receiver that performs the refund.
     * @param int          $orderId      The ID of the order to refund.
     */
    public function __construct(
        private readonly OrderService $orderService,
        private readonly int $orderId,
    ) {
    }

    /**
     * Execute the refund-order action on the receiver.
     *
     * @return void
     */
    public function execute(): void
    {
        $this->orderService->refundOrder($this->orderId);
    }
}
