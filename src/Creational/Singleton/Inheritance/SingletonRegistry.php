<?php

namespace DesignPatterns\Creational\Singleton\Inheritance;

/**
 * Simple Singleton Registry base class.
 *
 * Provides singleton functionality through inheritance.
 * Subclasses will have exactly one instance per class.
 */
abstract class SingletonRegistry
{
    /** @var array<string, object> Registry of singleton instances */
    private static array $instances = [];

    /**
     * Protected constructor to prevent direct instantiation.
     */
    protected function __construct()
    {
        // Initialization logic in subclasses
    }

    /**
     * Get the singleton instance for the called class.
     *
     * @return static
     */
    public static function getInstance(): static
    {
        $class = static::class;

        if (!isset(self::$instances[$class])) {
            self::$instances[$class] = new static();
        }

        return self::$instances[$class];
    }

    /**
     * Prevent cloning of the singleton instance.
     *
     * @return void
     * @throws \RuntimeException When attempting to clone
     */
    public function __clone(): void
    {
        throw new \RuntimeException('Cannot clone singleton instance');
    }

    /**
     * Prevent unserialization of the singleton instance.
     *
     * @return void
     * @throws \RuntimeException When attempting to unserialize
     */
    public function __wakeup(): void
    {
        throw new \RuntimeException('Cannot unserialize singleton instance');
    }
}