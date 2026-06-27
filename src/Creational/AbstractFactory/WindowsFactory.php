<?php

namespace DesignPatterns\Creational\AbstractFactory;

// Concrete factories
class WindowsFactory implements GUIFactory {
    public function createButton(): ButtonInterface {
        return new WindowsButton();
    }
    public function createCheckbox(): CheckboxInterface {
        return new WindowsCheckbox();
    }
}