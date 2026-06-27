<?php

namespace DesignPatterns\Creational\AbstractFactory;

class MacFactory implements GUIFactory {
    public function createButton(): ButtonInterface {
        return new MacButton();
    }
    public function createCheckbox(): CheckboxInterface {
        return new MacCheckbox();
    }
}