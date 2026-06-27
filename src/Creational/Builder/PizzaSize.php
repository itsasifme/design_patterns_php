<?php

namespace DesignPatterns\Creational\Builder;

enum PizzaSize: string
{
    case SMALL = 'small';
    case MEDIUM = 'medium';
    case LARGE = 'large';
    case EXTRA_LARGE = 'x-large';

    public function basePrice(): float
    {
        return match ($this) {
            self::SMALL => 8.99,
            self::MEDIUM => 12.99,
            self::LARGE => 16.99,
            self::EXTRA_LARGE => 20.99,
        };
    }
}