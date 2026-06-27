<?php
namespace DesignPatterns\Structural\Facade;

/**
 * Validates payment details and amount before processing.
 */
class PaymentValidation
{
    /**
     * Validate card details and amount.
     *
     * @param string $cardDetails
     * @param float  $amount
     * @return bool
     */
    public function validate(string $cardDetails, float $amount): bool
    {
        echo "Validating card and amount: {$amount}" . PHP_EOL;

        return true;
    }
}
