<?php

namespace DesignPatterns\Creational\AbstractFactory;

class WindowsCheckbox implements CheckboxInterface {
    public function render(): void {
        echo "Rendering Windows Checkbox\n";
    }
}