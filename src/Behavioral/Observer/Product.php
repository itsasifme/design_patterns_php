<?php

namespace DesignPatterns\Behavioral\Observer;

/**
 * Subject / Publisher: notifies all registered observers when state changes.
 *
 * Maintains a list of observers and broadcasts a message to each one
 * whenever a relevant event occurs (e.g. a product comes back in stock).
 */
class Product
{
    /** @var ObserverInterface[] List of currently subscribed observers. */
    private array $observers = [];

    /** @var string The last notification message broadcast to observers. */
    private string $notificationMessage = '';

    /**
     * Register an observer. Duplicates are silently ignored.
     *
    * @param ObserverInterface $observer The observer to subscribe.
     *
     * @return void
     */
    public function subscribe(ObserverInterface $observer): void
    {
        if (in_array($observer, $this->observers, true)) {
            return;
        }

        $this->observers[] = $observer;
    }

    /**
     * Remove a previously registered observer.
     *
    * @param ObserverInterface $observer The observer to unsubscribe.
     *
     * @return void
     */
    public function unsubscribe(ObserverInterface $observer): void
    {
        $this->observers = array_values(
            array_filter(
                $this->observers,
                static fn(ObserverInterface $item): bool => $item !== $observer,
            )
        );
    }

    /**
     * Mark the product as back in stock and notify all observers.
     *
     * @param string $productName The name of the product now available.
     *
     * @return void
     */
    public function backInStock(string $productName): void
    {
        $this->notificationMessage = "{$productName} is available now.";

        echo "{$productName} is back in stock.\n";

        $this->notify();
    }

    /**
     * Broadcast the current notification message to every subscriber.
     *
     * Failures in individual observers are caught and logged so that
     * one broken observer cannot block the rest.
     *
     * @return void
     */
    private function notify(): void
    {
        foreach ($this->observers as $observer) {
            try {
                $observer->update($this->notificationMessage);
            } catch (\Throwable $exception) {
                echo "Observer failed: " . get_class($observer) . "\n";
            }
        }
    }
}
