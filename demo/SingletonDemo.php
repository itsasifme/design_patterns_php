<?php

require_once __DIR__ . '/../vendor/autoload.php';

use DesignPatterns\Creational\Singleton\Singleton;



/**
 * Singleton Pattern Demonstration Class
 * 
 * Demonstrates the Singleton design pattern implementation with comprehensive testing.
 */
class SingletonDemo
{
    private Singleton $singleton1;
    private Singleton $singleton2;

    /**
     * Run the complete Singleton pattern demonstration.
     *
     * @return void
     */
    public function run(): void
    {
        $this->showHeader();
        
        $this->demonstrateInstanceCreation();
        $this->demonstrateInstanceComparison();
        $this->demonstrateMethodUsage();
        $this->demonstrateErrorPrevention();
        
        $this->showFooter();
    }

    /**
     * Display demonstration header.
     *
     * @return void
     */
    private function showHeader(): void
    {
        echo "=========================================\n";
        echo "      SINGLETON PATTERN DEMONSTRATION    \n";
        echo "=========================================\n\n";
    }

    /**
     * Demonstrate Singleton instance creation.
     *
     * @return void
     */
    private function demonstrateInstanceCreation(): void
    {
        echo "1. Instance Creation:\n";
        echo "=====================\n";

        // Get the first singleton instance
        echo "Getting first instance:\n";
        $this->singleton1 = Singleton::getInstance();
        echo "   " . $this->singleton1->doSomething() . "\n\n";

        // Get another reference to the same instance
        echo "Getting second instance:\n";
        $this->singleton2 = Singleton::getInstance();
        echo "   " . $this->singleton2->doSomething() . "\n\n";
    }

    /**
     * Demonstrate that both references point to the same instance.
     *
     * @return void
     */
    private function demonstrateInstanceComparison(): void
    {
        echo "2. Instance Comparison:\n";
        echo "=======================\n";

        echo "Are both variables the same instance? ";
        echo ($this->singleton1 === $this->singleton2) ? "YES ✓\n" : "NO ✗\n";
        
        echo "Object ID of singleton1: " . spl_object_id($this->singleton1) . "\n";
        echo "Object ID of singleton2: " . spl_object_id($this->singleton2) . "\n\n";
    }

    /**
     * Demonstrate Singleton method usage with parameters.
     *
     * @return void
     */
    private function demonstrateMethodUsage(): void
    {
        echo "3. Method Usage:\n";
        echo "================\n";

        echo "Using method with parameter:\n";
        echo "   " . $this->singleton1->showMessage("Hello from Singleton!") . "\n\n";

        // Demonstrate additional method usage
        echo "Additional method demonstrations:\n";
        echo "   " . $this->singleton1->showMessage("Testing parameterized method") . "\n";
        echo "   " . $this->singleton2->showMessage("Another test message") . "\n\n";
    }

    /**
     * Demonstrate error prevention mechanisms.
     *
     * @return void
     */
    private function demonstrateErrorPrevention(): void
    {
        echo "4. Error Prevention Mechanisms:\n";
        echo "===============================\n";

        $this->testCloningPrevention();
        $this->testConstructorPrevention();
        $this->testSerializationPrevention();
        // $this->testUnserializationPrevention();
    }

    /**
     * Test cloning prevention.
     *
     * @return void
     */
    private function testCloningPrevention(): void
    {
        echo "   Attempting to clone... ";
        
        try {
            $clone = clone $this->singleton1;
            echo "Unexpected success ✗\n";
        } catch (RuntimeException $e) {
            echo "Caught exception: " . $e->getMessage() . " ✓\n";
        }
    }

    /**
     * Test constructor prevention.
     *
     * @return void
     */
    private function testConstructorPrevention(): void
    {
        echo "   Attempting direct constructor call... ";
        
        try {
            $newInstance = new Singleton();
            echo "Unexpected success ✗\n";
        } catch (Error $e) {
            echo "Caught exception: " . $e->getMessage() . " ✓\n";
        }
    }

    /**
     * Test serialization prevention.
     *
     * @return void
     */
    private function testSerializationPrevention(): void
    {
        echo "   Attempting to serialize... ";
        
        try {
            $serialized = serialize($this->singleton1);
            echo "Unexpected success ✗\n";
        } catch (RuntimeException $e) {
            echo "Caught exception: " . $e->getMessage() . " ✓\n";
        }
    }

    /**
     * Test unserialization prevention.
     *
     * @return void
     */
    private function testUnserializationPrevention(): void
    {
        echo "   Attempting to unserialize... ";
        
        try {
            // Create a serialized string manually to test unserialize prevention
            $fakeSerialized = 'O:38:"DesignPatterns\Creational\Singleton\Singleton":0:{}';
            $unserialized = unserialize($fakeSerialized);
            
            if ($unserialized instanceof Singleton) {
                echo "Unexpected success ✗\n";
            } else {
                echo "Failed to unserialize (as expected) ✓\n";
            }
        } catch (RuntimeException $e) {
            echo "Caught exception: " . $e->getMessage() . " ✓\n";
        } catch (Exception $e) {
            echo "Caught exception: " . $e->getMessage() . " ✓\n";
        }
    }

    /**
     * Display demonstration footer.
     *
     * @return void
     */
    private function showFooter(): void
    {
        echo "\n✅ Singleton pattern demonstration completed successfully!\n";
    }
}

// Run the demonstration
$demo = new SingletonDemo();
$demo->run();