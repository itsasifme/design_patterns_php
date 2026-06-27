<?php

namespace DesignPatterns\Behavioral\ChainOfResponsibility;

/**
 * Concrete handler: returns a cached response if one exists for this request.
 */
class CacheHandler extends AbstractHandler
{
    /**
     * @param array<string, string> $cache Map of "username:orderId" => cached response.
     */
    public function __construct(
        private readonly array $cache,
    ) {
    }

    /**
     * Serve the cached response and stop the chain, or continue if no cache hit.
     *
     * @param OrderRequest $request The incoming order request.
     *
     * @return bool False (stop) when a cached response is served, true otherwise.
     */
    protected function check(OrderRequest $request): bool
    {
        $cacheKey = $request->username . ':' . $request->orderId;

        if (isset($this->cache[$cacheKey])) {
            echo $this->cache[$cacheKey] . "\n";

            return false;
        }

        echo "No cached response found.\n";

        return true;
    }
}
