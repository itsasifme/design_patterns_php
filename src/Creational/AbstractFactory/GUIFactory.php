<?php

namespace DesignPatterns\Creational\AbstractFactory;

// Abstract Factory interface
interface GUIFactory {
    public function createButton(): ButtonInterface;
    public function createCheckbox(): CheckboxInterface;
}