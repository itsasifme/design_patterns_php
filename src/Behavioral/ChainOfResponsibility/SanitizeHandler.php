<?php

namespace DesignPatterns\Behavioral\ChainOfResponsibility;

/**
 * Concrete handler: sanitizes user-submitted fields on the request.
 */
class SanitizeHandler extends AbstractHandler
{
    /**
     * Strip HTML tags from the request note and continue the chain.
     *
     * @param OrderRequest $request The incoming order request.
     *
     * @return bool Always true — sanitization never stops the chain.
     */
    protected function check(OrderRequest $request): bool
    {
        $request->note = strip_tags($request->note);

        echo "Request data sanitized.\n";

        return true;
    }
}
