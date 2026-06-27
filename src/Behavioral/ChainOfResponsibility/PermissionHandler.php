<?php

namespace DesignPatterns\Behavioral\ChainOfResponsibility;

/**
 * Concrete handler: verifies that the requester has permission to access the order.
 */
class PermissionHandler extends AbstractHandler
{
    /**
     * Allow admins and the order owner; reject everyone else.
     *
     * @param OrderRequest $request The incoming order request.
     *
     * @return bool False if access is denied, true otherwise.
     */
    protected function check(OrderRequest $request): bool
    {
        if ($request->isAdmin) {
            echo "Admin access granted.\n";

            return true;
        }

        if ($request->username === $request->orderOwner) {
            echo "Owner access granted.\n";

            return true;
        }

        echo "Request rejected: You cannot access this order.\n";

        return false;
    }
}
