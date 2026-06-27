<?php

namespace DesignPatterns\Behavioral\ChainOfResponsibility;

/**
 * Concrete handler: final handler that processes the order request.
 *
 * Reached only when all preceding checks have passed.
 */
class OrderSystemHandler extends AbstractHandler
{
    /**
     * Process the order and halt the chain.
     *
     * @param OrderRequest $request The incoming order request.
     *
     * @return bool Always false — this is the terminal handler.
     */
    protected function check(OrderRequest $request): bool
    {
        echo "Order #{$request->orderId} handled successfully.\n";
        echo "Note: {$request->note}\n";

        return false;
    }
}
