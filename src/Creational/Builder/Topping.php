<?php

namespace DesignPatterns\Creational\Builder;

enum Topping: string
{
    case CHEESE = 'cheese';
    case PEPPERONI = 'pepperoni';
    case BACON = 'bacon';
    case MUSHROOMS = 'mushrooms';
    case PINEAPPLE = 'pineapple';
    case JALAPENOS = 'jalapenos';
    case BELL_PEPPERS = 'bell peppers';
    case ONIONS = 'onions';
    case OLIVES = 'olives';
    case TOMATOES = 'tomatoes';
    case SAUSAGE = 'sausage';
    case HAM = 'ham';
    case HOT_SAUCE = 'hot sauce';

    public function price(): float
    {
        return 1.50;
    }
}