<?php

namespace DesignPatterns\Behavioral\ChainOfResponsibility;

/**
 * Handler interface.
 *
 * Defines the contract for all handlers in the chain: each handler can
 * set its successor and process an incoming order request.
 */
interface HandlerInterface
{
    /**
     * Set the next handler in the chain and return it for fluent chaining.
     *
     * @param HandlerInterface $handler The next handler.
     *
     * @return HandlerInterface The handler that was just set as next.
     */
    public function setNext(HandlerInterface $handler): HandlerInterface;

    /**
     * Handle the request or pass it to the next handler.
     *
     * @param OrderRequest $request The incoming order request.
     *
     * @return void
     */
    public function handle(OrderRequest $request): void;
}
