<?php

namespace DesignPatterns\Creational\Builder;

/**
 * Pizza product class representing the complex object to build.
 * This class is immutable following SOLID principles.
 */
final class Pizza
{
    /**
     * @param PizzaSize $size The size of the pizza
     * @param array<Topping> $toppings The toppings on the pizza
     */
    public function __construct(
        private readonly PizzaSize $size,
        private readonly array $toppings = []
    ) {
        $this->validateToppings();
    }

    private function validateToppings(): void
    {
        foreach ($this->toppings as $topping) {
            if (!$topping instanceof Topping) {
                throw new \InvalidArgumentException('All toppings must be Topping enum instances');
            }
        }
    }

    public function getSize(): PizzaSize
    {
        return $this->size;
    }

    /**
     * @return array<Topping>
     */
    public function getToppings(): array
    {
        return $this->toppings;
    }

    public function hasTopping(Topping $topping): bool
    {
        return in_array($topping, $this->toppings, true);
    }

    public function getDescription(): string
    {
        $description = "{$this->size->value} pizza";

        if (empty($this->toppings)) {
            return $description . ' with no toppings';
        }

        $toppingNames = array_map(fn(Topping $t) => $t->value, $this->toppings);
        return $description . ' with ' . implode(', ', $toppingNames);
    }

    public function getPrice(): float
    {
        $basePrice = $this->size->basePrice();
        $toppingsPrice = count($this->toppings) * Topping::CHEESE->price();
        
        return round($basePrice + $toppingsPrice, 2);
    }

    public function withTopping(Topping $topping): self
    {
        if ($this->hasTopping($topping)) {
            return $this;
        }

        return new self($this->size, [...$this->toppings, $topping]);
    }

    public function withoutTopping(Topping $topping): self
    {
        $newToppings = array_filter(
            $this->toppings,
            fn(Topping $t) => $t !== $topping
        );

        return new self($this->size, array_values($newToppings));
    }
}