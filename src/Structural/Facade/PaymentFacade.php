<?php
namespace DesignPatterns\Structural\Facade;

require_once __DIR__ . '/PaymentValidation.php';
require_once __DIR__ . '/GatewayConnector.php';
require_once __DIR__ . '/TransactionLogger.php';

/**
 * Facade providing a simplified API for processing payments.
 */
class PaymentFacade
{
    private PaymentValidation $validator;
    private GatewayConnector $gateway;
    private TransactionLogger $logger;

    /**
     * Initialize the facade and its subsystems.
     */
    public function __construct()
    {
        $this->validator = new PaymentValidation();
        $this->gateway = new GatewayConnector();
        $this->logger = new TransactionLogger();
    }

    /**
     * Process a payment using the composed subsystems.
     *
     * @param string $cardDetails
     * @param float  $amount
     * @return void
     */
    public function processPayment(string $cardDetails, float $amount): void
    {
        if ($this->validator->validate($cardDetails, $amount)) {
            $this->gateway->sendToBank($cardDetails, $amount);
            $this->logger->logTransaction('SUCCESS');

            echo "Payment completed successfully!" . PHP_EOL;

            return;
        }

        $this->logger->logTransaction('FAILED');
        echo "Payment failed!" . PHP_EOL;
    }
}
