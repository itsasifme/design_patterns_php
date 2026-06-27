<?php

namespace DesignPatterns\Behavioral\ChainOfResponsibility;

/**
 * Concrete handler: blocks requests from IP addresses with too many failed attempts.
 */
class IpBlockHandler extends AbstractHandler
{
    /**
     * @param array<string, int> $failedAttempts Map of IP address => failed attempt count.
     */
    public function __construct(
        private readonly array $failedAttempts,
    ) {
    }

    /**
     * Block the request if the client IP has 3 or more failed attempts.
     *
     * @param OrderRequest $request The incoming order request.
     *
     * @return bool False if the IP is blocked, true otherwise.
     */
    protected function check(OrderRequest $request): bool
    {
        if (($this->failedAttempts[$request->ipAddress] ?? 0) >= 3) {
            echo "Request blocked: Too many failed attempts.\n";

            return false;
        }

        echo "IP check passed.\n";

        return true;
    }
}
