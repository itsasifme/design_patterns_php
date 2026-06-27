<?php
namespace DesignPatterns\Structural\Facade;

/**
 * Connector responsible for sending payment requests to an external gateway.
 */
class GatewayConnector
{
    /**
     * Send payment details to the bank/gateway.
     *
     * @param string $cardDetails
     * @param float  $amount
     * @return void
     */
    public function sendToBank(string $cardDetails, float $amount): void
    {
        echo "Connecting to external bank API..." . PHP_EOL;
        echo "Sending payment request to bank..." . PHP_EOL;
    }
}
