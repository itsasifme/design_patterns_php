<?php

namespace DesignPatterns\Behavioral\ChainOfResponsibility;

/**
 * Request object passed along the handler chain.
 *
 * Carries all data that handlers need to inspect or mutate during processing.
 */
class OrderRequest
{
    /** @var bool Set to true by AuthHandler upon successful authentication. */
    public bool $isAuthenticated = false;

    /** @var bool Set to true by AuthHandler when the user has admin privileges. */
    public bool $isAdmin = false;

    /**
     * @param string $username   The username attempting to access the order.
     * @param string $password   The plaintext password for authentication.
     * @param string $ipAddress  The client IP address (checked against block list).
     * @param int    $orderId    The ID of the order being requested.
     * @param string $orderOwner The username of the order's owner.
     * @param string $note       An optional note submitted with the request.
     */
    public function __construct(
        public string $username,
        public string $password,
        public string $ipAddress,
        public int $orderId,
        public string $orderOwner,
        public string $note,
    ) {
    }
}
