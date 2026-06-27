<?php

namespace DesignPatterns\Creational\AbstractFactory;

class MacCheckbox implements CheckboxInterface {
    public function render(): void {
        echo "Rendering Mac Checkbox\n";
    }
}
