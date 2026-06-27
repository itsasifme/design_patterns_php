<?php

namespace DesignPatterns\Behavioral\ChainOfResponsibility;

/**
 * Abstract handler providing base chain behaviour.
 *
 * Stores the next handler reference and implements the forwarding logic.
 * Concrete handlers only need to implement the single {@see check()} method.
 */
abstract class AbstractHandler implements HandlerInterface
{
    /** @var HandlerInterface|null The next handler in the chain. */
    private ?HandlerInterface $nextHandler = null;

    /**
     * {@inheritDoc}
     */
    public function setNext(HandlerInterface $handler): HandlerInterface
    {
        $this->nextHandler = $handler;

        return $handler;
    }

    /**
     * Run the concrete check; if it passes, forward to the next handler.
     *
     * @param OrderRequest $request The incoming order request.
     *
     * @return void
     */
    public function handle(OrderRequest $request): void
    {
        if (!$this->check($request)) {
            return;
        }

        if ($this->nextHandler !== null) {
            $this->nextHandler->handle($request);
        }
    }

    /**
     * Perform this handler's specific check or action on the request.
     *
     * Return true to continue the chain, false to stop it.
     *
     * @param OrderRequest $request The incoming order request.
     *
     * @return bool True if the chain should continue, false to halt.
     */
    abstract protected function check(OrderRequest $request): bool;
}
