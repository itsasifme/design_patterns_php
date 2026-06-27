<?php

namespace DesignPatterns\Creational\AbstractFactory;

// Concrete product implementations (Mac)
class MacButton implements ButtonInterface {
    public function render(): void {
        echo "Rendering Mac Button\n";
    }
}