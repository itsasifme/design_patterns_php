<?php

namespace DesignPatterns\Creational\Builder;

/**
 * Concrete builder for creating custom pizzas.
 * Follows Open/Closed Principle - open for extension, closed for modification.
 */
class PizzaBuilder implements PizzaBuilderInterface
{
    /** @var PizzaSize The pizza size */
    private PizzaSize $size;
    
    /** @var array<Topping> The pizza toppings */
    private array $toppings;

    /**
     * Constructor initializes the builder with default values.
     */
    public function __construct()
    {
        $this->reset();
    }

    /**
     * {@inheritDoc}
     */
    public function reset(): void
    {
        $this->size = PizzaSize::MEDIUM;
        $this->toppings = [];
    }

    /**
     * {@inheritDoc}
     */
    public function setSize(PizzaSize $size): self
    {
        $this->size = $size;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function addTopping(Topping $topping): self
    {
        if (!in_array($topping, $this->toppings, true)) {
            $this->toppings[] = $topping;
        }
        
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function removeTopping(Topping $topping): self
    {
        $this->toppings = array_filter(
            $this->toppings,
            fn(Topping $t) => $t !== $topping
        );
        
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function build(): Pizza
    {
        $pizza = new Pizza($this->size, $this->toppings);
        $this->reset();
        
        return $pizza;
    }

    /**
     * Add cheese topping to the pizza.
     *
     * @return self Returns the builder instance for method chaining
     */
    public function addCheese(): self
    {
        return $this->addTopping(Topping::CHEESE);
    }

    /**
     * Add pepperoni topping to the pizza.
     *
     * @return self Returns the builder instance for method chaining
     */
    public function addPepperoni(): self
    {
        return $this->addTopping(Topping::PEPPERONI);
    }

    /**
     * Add bacon topping to the pizza.
     *
     * @return self Returns the builder instance for method chaining
     */
    public function addBacon(): self
    {
        return $this->addTopping(Topping::BACON);
    }

    /**
     * Add mushrooms topping to the pizza.
     *
     * @return self Returns the builder instance for method chaining
     */
    public function addMushrooms(): self
    {
        return $this->addTopping(Topping::MUSHROOMS);
    }

    /**
     * Add pineapple topping to the pizza.
     *
     * @return self Returns the builder instance for method chaining
     */
    public function addPineapple(): self
    {
        return $this->addTopping(Topping::PINEAPPLE);
    }

    /**
     * Add jalapenos topping to the pizza.
     *
     * @return self Returns the builder instance for method chaining
     */
    public function addJalapenos(): self
    {
        return $this->addTopping(Topping::JALAPENOS);
    }
}