<?php

require_once __DIR__ . '/../vendor/autoload.php';

use DesignPatterns\Creational\Builder\Director;
use DesignPatterns\Creational\Builder\HawaiianPizzaBuilder;
use DesignPatterns\Creational\Builder\PizzaBuilder;
use DesignPatterns\Creational\Builder\PizzaSize;
use DesignPatterns\Creational\Builder\SpicyPizzaBuilder;
use DesignPatterns\Creational\Builder\Topping;

/**
 * Builder Pattern Demonstration
 */
class BuilderDemo
{
    /**
     * Run the builder pattern demonstration.
     *
     * @return void
     */
    public function run(): void
    {
        echo "=========================================\n";
        echo "        BUILDER PATTERN DEMONSTRATION    \n";
        echo "=========================================\n\n";

        $this->demonstrateCustomBuilder();
        $this->demonstratePreconfiguredBuilders();
        $this->demonstrateDirector();
        $this->demonstrateFluentInterface();
        $this->demonstrateImmutableProduct();
    }

    /**
     * Demonstrate custom pizza building.
     *
     * @return void
     */
    private function demonstrateCustomBuilder(): void
    {
        echo "1. CUSTOM PIZZA BUILDER:\n";
        echo "========================\n";

        $builder = new PizzaBuilder();

        $pizza = $builder
            ->setSize(PizzaSize::LARGE)
            ->addTopping(Topping::CHEESE)
            ->addTopping(Topping::PEPPERONI)
            ->addTopping(Topping::MUSHROOMS)
            ->addTopping(Topping::JALAPENOS)
            ->addTopping(Topping::OLIVES)
            ->build();

        echo "   " . $pizza->getDescription() . "\n";
        echo "   Price: $" . number_format($pizza->getPrice(), 2) . "\n\n";
    }

    /**
     * Demonstrate preconfigured pizza builders.
     *
     * @return void
     */
    private function demonstratePreconfiguredBuilders(): void
    {
        echo "2. PRECONFIGURED PIZZA BUILDERS:\n";
        echo "===============================\n";

        $baseBuilder = new PizzaBuilder();
        
        $hawaiianBuilder = new HawaiianPizzaBuilder($baseBuilder);
        $hawaiianPizza = $hawaiianBuilder->build();
        echo "   Hawaiian: " . $hawaiianPizza->getDescription() . "\n";
        echo "   Price: $" . number_format($hawaiianPizza->getPrice(), 2) . "\n";

        $spicyBuilder = new SpicyPizzaBuilder($baseBuilder);
        $spicyPizza = $spicyBuilder->build();
        echo "   Spicy: " . $spicyPizza->getDescription() . "\n";
        echo "   Price: $" . number_format($spicyPizza->getPrice(), 2) . "\n\n";
    }

    /**
     * Demonstrate director pattern usage.
     *
     * @return void
     */
    private function demonstrateDirector(): void
    {
        echo "3. DIRECTOR PATTERN:\n";
        echo "====================\n";

        $director = new Director();
        $builder = new PizzaBuilder();

        $pizzas = [
            'Margherita' => $director->buildMargherita($builder),
            'Meat Lovers' => $director->buildMeatLovers($builder),
            'Veggie Supreme' => $director->buildVeggieSupreme($builder),
        ];

        foreach ($pizzas as $name => $pizza) {
            echo "   $name: " . $pizza->getDescription() . "\n";
            echo "   Price: $" . number_format($pizza->getPrice(), 2) . "\n";
        }
        echo "\n";
    }

    /**
     * Demonstrate fluent interface usage.
     *
     * @return void
     */
    private function demonstrateFluentInterface(): void
    {
        echo "4. FLUENT INTERFACE DEMONSTRATION:\n";
        echo "==================================\n";

        $builder = new PizzaBuilder();

        $pizza = $builder
            ->setSize(PizzaSize::MEDIUM)
            ->addCheese()
            ->addPepperoni()
            ->addBacon()
            ->addMushrooms()
            ->build();

        echo "   Fluent Built: " . $pizza->getDescription() . "\n";
        echo "   Price: $" . number_format($pizza->getPrice(), 2) . "\n\n";
    }

    /**
     * Demonstrate immutable product behavior.
     *
     * @return void
     */
    private function demonstrateImmutableProduct(): void
    {
        echo "5. IMMUTABLE PRODUCT DEMONSTRATION:\n";
        echo "===================================\n";

        $builder = new PizzaBuilder();
        $originalPizza = $builder
            ->setSize(PizzaSize::SMALL)
            ->addCheese()
            ->build();

        $modifiedPizza = $originalPizza
            ->withTopping(Topping::PEPPERONI)
            ->withTopping(Topping::MUSHROOMS);

        echo "   Original: " . $originalPizza->getDescription() . "\n";
        echo "   Modified: " . $modifiedPizza->getDescription() . "\n";
        echo "   Original unchanged: " . $originalPizza->getDescription() . "\n\n";
    }
}

// Run the demonstration
$demo = new BuilderDemo();
$demo->run();