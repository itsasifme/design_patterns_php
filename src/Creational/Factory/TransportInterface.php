<?php

namespace DesignPatterns\Creational\Factory;

/**
 * Transport interface that all concrete transports must implement.
 * Represents the Product in Factory Method pattern.
 */
interface TransportInterface
{
    /**
     * Deliver goods to the specified destination.
     *
     * @param string $destination The delivery destination
     * @return string The delivery confirmation message
     */
    public function deliver(string $destination): string;

    /**
     * Get the transport type name.
     *
     * @return string
     */
    public function getType(): string;

    /**
     * Get the transport capacity in kilograms.
     *
     * @return float
     */
    public function getCapacity(): float;

    /**
     * Get the estimated delivery time in hours.
     *
     * @param string $destination The delivery destination
     * @return float
     */
    public function getEstimatedTime(string $destination): float;
}