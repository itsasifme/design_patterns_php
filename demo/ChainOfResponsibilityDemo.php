<?php

require_once __DIR__ . '/../vendor/autoload.php';

use DesignPatterns\Behavioral\ChainOfResponsibility\AuthHandler;
use DesignPatterns\Behavioral\ChainOfResponsibility\CacheHandler;
use DesignPatterns\Behavioral\ChainOfResponsibility\IpBlockHandler;
use DesignPatterns\Behavioral\ChainOfResponsibility\OrderRequest;
use DesignPatterns\Behavioral\ChainOfResponsibility\OrderSystemHandler;
use DesignPatterns\Behavioral\ChainOfResponsibility\PermissionHandler;
use DesignPatterns\Behavioral\ChainOfResponsibility\SanitizeHandler;

class ChainOfResponsibilityDemo
{
    private array $users         = [
        'john'  => ['password' => '1234',     'is_admin' => false],
        'admin' => ['password' => 'admin123', 'is_admin' => true],
    ];
    private array $failedAttempts = ['192.168.1.50' => 5];
    private array $cache          = ['john:101' => 'Cached response for order #101'];

    /**
     * Run the complete Chain of Responsibility pattern demonstration.
     *
     * @return void
     */
    public function run(): void
    {
        $this->showHeader();

        $this->demonstrateNormalRequest();
        $this->demonstrateCachedRequest();
        $this->demonstrateBlockedIp();
        $this->demonstrateWrongPassword();
        $this->demonstrateAccessDenied();

        $this->showFooter();
    }

    /**
     * Display demonstration header.
     *
     * @return void
     */
    private function showHeader(): void
    {
        echo "=====================================================\n";
        echo "  CHAIN OF RESPONSIBILITY PATTERN DEMONSTRATION     \n";
        echo "=====================================================\n\n";
    }

    /**
     * Build and return a fresh handler chain.
     *
     * @return IpBlockHandler
     */
    private function buildChain(): IpBlockHandler
    {
        $handler = new IpBlockHandler($this->failedAttempts);
        $handler
            ->setNext(new AuthHandler($this->users))
            ->setNext(new SanitizeHandler())
            ->setNext(new PermissionHandler())
            ->setNext(new CacheHandler($this->cache))
            ->setNext(new OrderSystemHandler());

        return $handler;
    }

    /**
     * Demonstrate a normal request that passes all handlers.
     *
     * @return void
     */
    private function demonstrateNormalRequest(): void
    {
        echo "1. Normal request (john, order 102):\n";
        echo "=====================================\n";
        $this->buildChain()->handle(
            new OrderRequest('john', '1234', '10.0.0.5', 102, 'john', '<b>Deliver fast</b>')
        );
        echo "\n";
    }

    /**
     * Demonstrate a request served from the cache handler.
     *
     * @return void
     */
    private function demonstrateCachedRequest(): void
    {
        echo "2. Cached request (john, order 101):\n";
        echo "=====================================\n";
        $this->buildChain()->handle(
            new OrderRequest('john', '1234', '10.0.0.5', 101, 'john', 'Normal')
        );
        echo "\n";
    }

    /**
     * Demonstrate a request blocked at the IP handler.
     *
     * @return void
     */
    private function demonstrateBlockedIp(): void
    {
        echo "3. Blocked IP (192.168.1.50):\n";
        echo "==============================\n";
        $this->buildChain()->handle(
            new OrderRequest('john', '1234', '192.168.1.50', 102, 'john', 'Normal')
        );
        echo "\n";
    }

    /**
     * Demonstrate a request rejected by the auth handler.
     *
     * @return void
     */
    private function demonstrateWrongPassword(): void
    {
        echo "4. Wrong password:\n";
        echo "==================\n";
        $this->buildChain()->handle(
            new OrderRequest('john', 'wrong', '10.0.0.5', 102, 'john', 'Normal')
        );
        echo "\n";
    }

    /**
     * Demonstrate a request blocked by the permission handler.
     *
     * @return void
     */
    private function demonstrateAccessDenied(): void
    {
        echo "5. Access denied (john accessing admin's order):\n";
        echo "=================================================\n";
        $this->buildChain()->handle(
            new OrderRequest('john', '1234', '10.0.0.5', 200, 'admin', 'Normal')
        );
        echo "\n";
    }

    /**
     * Display demonstration footer.
     *
     * @return void
     */
    private function showFooter(): void
    {
        echo "=====================================================\n";
        echo "✅ Chain of Responsibility pattern demo completed! ✅\n";
        echo "=====================================================\n";
    }
}

// Run demonstration
$demo = new ChainOfResponsibilityDemo();
$demo->run();
