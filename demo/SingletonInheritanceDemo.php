<?php

require_once __DIR__ . '/../vendor/autoload.php';

use DesignPatterns\Creational\Singleton\Trait\Logger;
use DesignPatterns\Creational\Singleton\Trait\Database;

/**
 * Demonstration class for Singleton Inheritance pattern.
 * Shows Database and Logger working together with proper error handling.
 */
class SingletonInheritanceDemo
{
    private Database $db;
    private Logger $logger;

    /**
     * Run the complete demonstration.
     *
     * @return void
     */
    public function run(): void
    {
        $this->initialize();
        $this->showHeader();
        
        $this->demonstrateDatabaseOperations();
        $this->demonstrateLoggerOperations();
        $this->demonstrateSingletonBehavior();
        $this->demonstrateConstructorProtection();
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
        echo "    Singleton Inheritance Demonstratio   \n";
        echo "=========================================\n\n";
    }

    /**
     * Demonstrate database operations.
     *
     * @return void
     */
    private function demonstrateDatabaseOperations(): void
    {
        echo "1. Database Operations:\n";
        echo "=======================\n";

        // Insert sample users
        $this->insertSampleUsers();
        
        // Display all users
        $this->displayAllUsers();

        $this->logger->log('Database operations completed');
    }

    /**
     * Insert sample users into the database.
     *
     * @return void
     */
    private function insertSampleUsers(): void
    {
        $users = [
            ['John Doe', 'john@example.com'],
            ['Jane Smith', 'jane@example.com']
        ];

        foreach ($users as $user) {
            $this->db->insertUser($user[0], $user[1]);
        }

        $this->logger->log('Inserted ' . count($users) . ' users into database');
    }

    /**
     * Display all users from the database.
     *
     * @return void
     */
    private function displayAllUsers(): void
    {
        $users = $this->db->getUsers();
        
        echo "Users in database:\n";
        foreach ($users as $user) {
            echo " - {$user['name']} ({$user['email']})\n";
        }

        $this->logger->log('Retrieved ' . count($users) . ' users from database');
    }

    /**
     * Demonstrate logger operations.
     *
     * @return void
     */
    private function demonstrateLoggerOperations(): void
    {
        echo "\n2. Logger Operations:\n";
        echo "=====================\n";

        $this->logVariousLevels();
        $this->displayLogEntries();

        $this->logger->log('Logger operations completed');
    }

    /**
     * Log messages at various levels.
     *
     * @return void
     */
    private function logVariousLevels(): void
    {
        $this->logger->log('This is an info message', 'INFO');
        $this->logger->log('This is a warning', 'WARN');
        $this->logger->log('This is an error', 'ERROR');
        $this->logger->info('Info message using shortcut');
        $this->logger->warn('Warning message using shortcut');
    }

    /**
     * Display all log entries.
     *
     * @return void
     */
    private function displayLogEntries(): void
    {
        $logs = $this->logger->getLogs();
        
        echo "Log entries:\n";
        foreach ($logs as $log) {
            if (!empty(trim($log))) {
                echo " - $log\n";
            }
        }
    }

    /**
     * Demonstrate singleton behavior.
     *
     * @return void
     */
    private function demonstrateSingletonBehavior(): void
    {
        echo "\n3. Singleton Verification:\n";
        echo "==========================\n";

        $this->verifySingletonInstances();
        $this->logger->log('Singleton verification completed');
    }

    /**
     * Verify that singleton instances are identical.
     *
     * @return void
     */
    private function verifySingletonInstances(): void
    {
        $db2 = Database::getInstance();
        $logger2 = Logger::getInstance();

        echo "Database instances same: " . ($this->db === $db2 ? 'YES ✅' : 'NO ❌') . "\n";
        echo "Logger instances same: " . ($this->logger === $logger2 ? 'YES ✅' : 'NO ❌') . "\n";
    }

    /**
     * Demonstrate constructor protection.
     *
     * @return void
     */
    private function demonstrateConstructorProtection(): void
    {
        echo "\n4. Constructor Protection:\n";
        echo "==========================\n";

        $this->testDatabaseConstructor();
        $this->testLoggerConstructor();

        $this->logger->log('Constructor protection test completed');
    }

    /**
     * Test Database constructor protection.
     *
     * @return void
     */
    private function testDatabaseConstructor(): void
    {
        echo "Attempting direct constructor call for Database:\n";
        
        try {
            new Database();
            echo "❌ Unexpected success - constructor should be protected\n";
        } catch (Error $e) {
            echo "✅ Caught exception: " . $e->getMessage() . "\n";
        }
    }

    /**
     * Test Logger constructor protection.
     *
     * @return void
     */
    private function testLoggerConstructor(): void
    {
        echo "Attempting direct constructor call for Logger:\n";
        
        try {
            new Logger();
            echo "❌ Unexpected success - constructor should be protected\n";
        } catch (Error $e) {
            echo "✅ Caught exception: " . $e->getMessage() . "\n";
        }
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
        echo "\n✅ Singleton Inheritance demo completed successfully!\n";
    }
}

// Run the demonstration
$demo = new SingletonInheritanceDemo();
$demo->run();
    