<?php

require_once __DIR__ . '/../vendor/autoload.php';

use DesignPatterns\Structural\Proxy\CachedReportProxy;
use DesignPatterns\Structural\Proxy\RealReportService;

class ProxyDemo
{
    /**
     * Run the complete Proxy pattern demonstration.
     *
     * @return void
     */
    public function run(): void
    {
        $this->showHeader();

        $this->demonstrateCaching();
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
        echo "============================================\n";
        echo "        PROXY PATTERN DEMONSTRATION         \n";
        echo "============================================\n\n";
    }

    /**
     * Demonstrate permission check and result caching.
     *
     * @return void
     */
    private function demonstrateCaching(): void
    {
        echo "1. Caching Proxy (user 10, report 501):\n";
        echo "========================================\n";

        $proxy = new CachedReportProxy(10, new RealReportService());

        echo "First call (generates report):\n";
        echo $proxy->generateReport(501) . "\n";

        echo "\nSecond call (served from cache):\n";
        echo $proxy->generateReport(501) . "\n";

        echo "\n";
    }

    /**
     * Demonstrate access denial for an unauthorised user.
     *
     * @return void
     */
    private function demonstrateAccessDenied(): void
    {
        echo "2. Access Denied (user 99, report 501):\n";
        echo "========================================\n";

        $proxy = new CachedReportProxy(99, new RealReportService());
        echo $proxy->generateReport(501) . "\n";

        echo "\n";
    }

    /**
     * Display demonstration footer.
     *
     * @return void
     */
    private function showFooter(): void
    {
        echo "============================================\n";
        echo "✅ Proxy pattern demo completed! ✅\n";
        echo "============================================\n";
    }
}

// Run demonstration
$demo = new ProxyDemo();
$demo->run();
