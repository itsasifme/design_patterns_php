<?php

require_once __DIR__ . '/../vendor/autoload.php';

use DesignPatterns\Behavioral\Command\BlockUserCommand;
use DesignPatterns\Behavioral\Command\CommandBus;
use DesignPatterns\Behavioral\Command\MarketingService;
use DesignPatterns\Behavioral\Command\OrderService;
use DesignPatterns\Behavioral\Command\RefundOrderCommand;
use DesignPatterns\Behavioral\Command\SendCouponCommand;
use DesignPatterns\Behavioral\Command\UserService;

class CommandDemo
{
    /**
     * Run the complete Command pattern demonstration.
     *
     * @return void
     */
    public function run(): void
    {
        $this->showHeader();

        $this->demonstrateImmediateDispatch();
        $this->demonstrateQueuedDispatch();

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
        echo "       COMMAND PATTERN DEMONSTRATION        \n";
        echo "============================================\n\n";
    }

    /**
     * Demonstrate commands dispatched and executed immediately.
     *
     * @return void
     */
    private function demonstrateImmediateDispatch(): void
    {
        echo "1. Immediate Command Dispatch:\n";
        echo "==============================\n";

        $userService      = new UserService();
        $marketingService = new MarketingService();
        $commandBus       = new CommandBus();

        $commandBus->dispatch(new BlockUserCommand($userService, 10));
        $commandBus->dispatch(new SendCouponCommand($marketingService, 10));

        echo "\n";
    }

    /**
     * Demonstrate commands queued for deferred processing.
     *
     * @return void
     */
    private function demonstrateQueuedDispatch(): void
    {
        echo "2. Queued Command Dispatch:\n";
        echo "===========================\n";

        $orderService = new OrderService();
        $commandBus   = new CommandBus();

        $commandBus->dispatchLater(new RefundOrderCommand($orderService, 501));
        echo "Admin can continue doing other work.\n";
        $commandBus->dispatchLater(new RefundOrderCommand($orderService, 502));

        echo "\nProcessing queue (queue worker / cron job):\n";
        $commandBus->processQueue();

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
        echo "✅ Command pattern demo completed! ✅\n";
        echo "============================================\n";
    }
}

// Run demonstration
$demo = new CommandDemo();
$demo->run();
