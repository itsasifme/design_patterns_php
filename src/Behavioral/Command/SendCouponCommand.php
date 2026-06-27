<?php

namespace DesignPatterns\Behavioral\Command;

/**
 * Concrete command: encapsulates a send-coupon action.
 */
class SendCouponCommand implements CommandInterface
{
    /**
     * @param MarketingService $marketingService Receiver that sends the coupon.
     * @param int              $userId           The ID of the user to receive the coupon.
     */
    public function __construct(
        private readonly MarketingService $marketingService,
        private readonly int $userId,
    ) {
    }

    /**
     * Execute the send-coupon action on the receiver.
     *
     * @return void
     */
    public function execute(): void
    {
        $this->marketingService->sendCoupon($this->userId);
    }
}
