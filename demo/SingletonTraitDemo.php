<?php

require_once __DIR__ . '/../vendor/autoload.php';

use DesignPatterns\Creational\Singleton\Trait\Logger;
use DesignPatterns\Creational\Singleton\Trait\Database;

/**
 * Demonstration of Database and Logger using SingletonTrait.
 */
class SingletonTraitDemo
{
    private Database $db;
    private Logger $logger;

    public function run(): void
    {
        $this->initialize();
        $this->showHeader();
        
        $this->demonstrateSingletonBehavior();
        $this->demonstrateDatabaseOperations();
        $this->demonstrateLoggerOperations();
        $this->demonstrateIntegration();
        $this->cleanupFiles();

        $this->showFooter();
    }

    /**
     * Initialize singleton instances.
     *
     * @return void
     */
    private function initialize(): void
    {
        $this->db = Database::getInstance();
        $this->logger = Logger::getInstance();
        $this->logger->log('Application started');
    }

    /**
     * Display demonstration header.
     *
     * @return void
     */
    private function showHeader(): void
    {
        echo "=========================================\n";
        echo "       Singleton Trait Demonstration     \n";
        echo "=========================================\n\n";
    }

    private function demonstrateSingletonBehavior(): void
    {
        echo "1. Singleton Trait Behavior:\n";
        echo "============================\n";

        $db1 = Database::getInstance();
        $db2 = Database::getInstance();
        $logger1 = Logger::getInstance();
        $logger2 = Logger::getInstance();

        echo "Database instances same: " . ($db1 === $db2 ? 'YES ✅' : 'NO ❌') . "\n";
        echo "Logger instances same: " . ($logger1 === $logger2 ? 'YES ✅' : 'NO ❌') . "\n";

        // Show trait functionality
        echo "Registered instances: " . count(Database::getInstances()) . "\n";
        echo "Has Database instance: " . (Database::hasInstance(Database::class) ? 'YES ✅' : 'NO ❌') . "\n";
        echo "Has Logger instance: " . (Logger::hasInstance(Logger::class) ? 'YES ✅' : 'NO ❌') . "\n\n";

        $logger1->info('Singleton trait verification completed');
    }

    private function demonstrateDatabaseOperations(): void
    {
        echo "2. Database Operations:\n";
        echo "=======================\n";

        $db = Database::getInstance();
        $logger = Logger::getInstance();

        $logger->info('Starting database operations');

        // Insert users
        $users = [
            ['John Doe', 'john@example.com'],
            ['Jane Smith', 'jane@example.com']
        ];

        foreach ($users as $user) {
            $id = $db->insertUser($user[0], $user[1]);
            $logger->debug("Inserted user: {$user[0]} (ID: {$id})");
        }

        // Display users
        $allUsers = $db->getUsers();
        echo "Users in database:\n";
        foreach ($allUsers as $user) {
            echo " - {$user['name']} ({$user['email']})\n";
        }

        $logger->info('Database operations completed');
    }

    private function demonstrateLoggerOperations(): void
    {
        echo "\n3. Logger Operations:\n";
        echo "=====================\n";

        $logger = Logger::getInstance();

        $logger->info('Informational message');
        $logger->warn('Warning message');
        $logger->error('Error message');
        $logger->debug('Debug message');

        $logs = $logger->getLogs();
        echo "Recent log entries:\n";
        $recentLogs = array_slice($logs, -5);
        
        foreach ($recentLogs as $log) {
            echo " - {$log}\n";
        }

        echo "Total log entries: " . count($logs) . "\n";
    }

    private function demonstrateIntegration(): void
    {
        echo "\n4. Database + Logger Integration:\n";
        echo "===============================\n";

        $db = Database::getInstance();
        $logger = Logger::getInstance();

        $logger->info('Starting integration test');

        // Simulate business transaction
        try {
            $logger->info('Beginning user registration');
            
            $newId = $db->insertUser('Integration User', 'integration@example.com');
            $logger->info("User registered with ID: {$newId}");
            
            $userCount = count($db->getUsers());
            $logger->info("Total users now: {$userCount}");
            
            $logger->info('Integration test completed successfully');
            
        } catch (Exception $e) {
            $logger->error('Integration test failed: ' . $e->getMessage());
            throw $e;
        }

        echo "Integration test completed successfully ✅\n";
    }

    /**
     * Clean up created files.
     *
     * @return void
     */
    private function cleanupFiles(): void
    {
        echo "\n5. Cleaning Up Files:\n";
        echo "====================\n";

        $this->cleanupDatabaseFile();
        $this->cleanupLogFile();

        echo "Files cleaned up for next demo\n";
    }

    /**
     * Clean up database file.
     *
     * @return void
     */
    private function cleanupDatabaseFile(): void
    {
        echo "Removing database file...\n";
        
        if ($this->db->removeDbFile()) {
            echo "✅ Database file removed successfully\n";
        } else {
            echo "⚠️ Database file could not be removed (may be in use)\n";
        }
    }

    /**
     * Clean up log file.
     *
     * @return void
     */
    private function cleanupLogFile(): void
    {
        echo "Removing log file...\n";
        
        if ($this->logger->removeLogFile()) {
            echo "✅ Log file removed successfully\n";
        } else {
            echo "⚠️ Log file could not be removed (may be in use)\n";
        }
    }

    /**
     * Display demonstration footer.
     *
     * @return void
     */
    private function showFooter(): void
    {
        echo "\n✅ Singleton Trait demonstration completed successfully!\n";
    }
}

// Run the demonstration
$demo = new SingletonTraitDemo();
$demo->run();