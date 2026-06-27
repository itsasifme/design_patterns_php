<?php

namespace DesignPatterns\Creational\Builder;

/**
 * Builder interface defining the steps to build a pizza.
 * Follows Interface Segregation Principle.
 */
interface PizzaBuilderInterface
{
    /**
     * Set the size of the pizza.
     *
     * @param PizzaSize $size The pizza size
     * @return self Returns the builder instance for method chaining
     */
    public function setSize(PizzaSize $size): self;
    
    /**
     * Add a topping to the pizza.
     *
     * @param Topping $topping The topping to add
     * @return self Returns the builder instance for method chaining
     */
    public function addTopping(Topping $topping): self;
    
    /**
     * Remove a topping from the pizza.
     *
     * @param Topping $topping The topping to remove
     * @return self Returns the builder instance for method chaining
     */
    public function removeTopping(Topping $topping): self;
    
    /**
     * Build the final pizza product.
     *
     * @return Pizza The constructed pizza instance
     */
    public function build(): Pizza;
    
    /**
     * Reset the builder to its initial state.
     *
     * @return void
     */
    public function reset(): void;
}