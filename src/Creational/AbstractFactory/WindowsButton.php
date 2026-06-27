<?php

namespace DesignPatterns\Creational\AbstractFactory;

// Concrete product implementations (Windows)
class WindowsButton implements ButtonInterface {
    public function render(): void {
        echo "Rendering Windows Button\n";
    }
}