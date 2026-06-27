# 🏗️ Builder Design Pattern

> **The Master Craftsman of Object Creation** • Construct Complex Objects Step by Step

![Design Pattern](https://img.shields.io/badge/Pattern-Creational-FF6B6B?style=for-the-badge)
![PHP Compatible](https://img.shields.io/badge/PHP-8.4+-purple?style=for-the-badge)
![License](https://img.shields.io/badge/License-MIT-blue?style=for-the-badge)

## 🌟 Overview

| **Aspect**       | **Description**                                                              |
|------------------|------------------------------------------------------------------------------|
| **Pattern Type** | Creational                                                                   |
| **Purpose**      | Separate the construction of a complex object from its representation        |
| **Complexity**   | ⭐⭐☆☆☆                                                                      |
| **Popularity**   | ⭐⭐⭐⭐☆                                                                     |

## 📖 Definition

> **"The Architectural Director of Object Construction"** 🎬
>
> The **Builder** pattern separates the construction of a complex object from its representation, so the same construction process can create different representations.

## 🎯 Overall Concept

### 🎨 Visual Metaphor
> Think of a **custom pizza chef** 🍕. You specify each ingredient step by step (crust → sauce → cheese → toppings), and the chef assembles your perfect pizza exactly as ordered. The same chef (builder) can produce a different pizza by varying the steps.

### ⚡ How It Works
- **Step-by-Step Construction**: Product is assembled through a series of discrete method calls
- **Same Process, Different Results**: Concrete builders follow the same interface but produce different products
- **Director (Optional)**: A Director class encodes predefined construction recipes
- **Separation of Concerns**: Construction logic lives in the builder, not in the product or client

## 🔨 GoF Implementation Steps

### 📋 Step-by-Step Implementation Guide

#### **Step 1: Define the Builder Interface**
Declare an interface listing all the construction steps available. Every step builds one part of the product.

#### **Step 2: Create Concrete Builders**
Implement one ConcreteBuilder per product variant. Each provides its own version of every step and exposes a `getResult()` method to retrieve the finished product.

#### **Step 3: Define the Product**
Products built by different builders do not need a common interface — each ConcreteBuilder returns its own product type from `getResult()`.

#### **Step 4: Create the Director (Optional)**
Create a Director that takes a builder and calls its steps in a specific order to produce a predefined product configuration. The Director hides construction details from clients.

#### **Step 5: Use the Builder**
Client code creates a ConcreteBuilder, optionally passes it to a Director, then calls `getResult()` on the builder to obtain the assembled product.

### ⚙️ Core Rules

- **Builder Interface**: Declares all construction steps.
- **ConcreteBuilder**: Implements the steps; tracks the product; provides `getResult()`.
- **Product**: The complex object being assembled; may vary per ConcreteBuilder.
- **Director**: Knows the order of steps; works with any builder through the Builder interface.
- **Client**: Creates a ConcreteBuilder, optionally uses a Director, and retrieves the product from the builder.

### 🎯 Key Implementation Principles

| **Principle**               | **Description**                                           | **Benefit**                         |
|-----------------------------|-----------------------------------------------------------|-------------------------------------|
| **Separation of Concerns**  | Construction logic in builder, not in product or client   | Clean, maintainable code            |
| **Same Interface**          | All builders share one interface                          | Director is decoupled from product  |
| **Step Isolation**          | Each step builds exactly one part                         | Easy to vary individual steps       |
| **Reusable Recipes**        | Director encodes construction recipes independently       | Consistent, repeatable builds       |

---

## 📊 When to Use Builder

### ✅ Ideal Use Cases
| **Scenario**                   | **Why Builder?**                                              |
|--------------------------------|---------------------------------------------------------------|
| **Complex Objects**            | Objects with many optional or ordered construction steps      |
| **Multiple Representations**   | Same construction process, different product types            |
| **Immutable Products**         | Build all parts before sealing the object                     |
| **Telescoping Constructors**   | Replace a constructor with 10+ parameters with fluent steps   |
| **Reusable Construction Flows**| Director encodes standard configurations                      |

## ⚠️ When to Avoid

### 🚫 Anti-Pattern Scenarios
- ❌ **Simple objects** — objects with one or two required parameters do not need a builder
- ❌ **No variation needed** — if only one representation exists, the pattern adds overhead
- ❌ **Performance-critical creation** — builder overhead is measurable in tight loops
- ❌ **Over-engineering** — do not add a Director for simple construction flows

---

## 🚨 Real-world Example: Pizza Order System

### 🎯 Problem Statement

Your application builds customisable pizzas. A pizza has a size, crust, sauce, and up to a dozen optional toppings. The naive approach is a single constructor with a parameter for every option — the classic **telescoping constructor** anti-pattern.

---

### ⚠️ The Problem Without Builder

```php
// ❌ BAD: Telescoping constructor — every option is a positional parameter

class Pizza
{
    public function __construct(
        string $size = 'medium',
        bool $cheese = false,
        bool $pepperoni = false,
        bool $bacon = false,
        bool $mushrooms = false,
        bool $pineapple = false,
        bool $jalapenos = false,
        array $extraToppings = []
    ) { /* ... */ }
}

// ❌ Can you tell what toppings this pizza has?
$pizza = new Pizza('large', true, false, true, false, true, false, ['olives']);
```

**The Real Problems:**
- 📌 **Unreadable call sites** — `new Pizza('large', true, false, true, false, true, false, [])` is impossible to read without counting parameters
- 📌 **Easy to swap booleans** — mixing up pepperoni and bacon positions causes silent bugs
- 📌 **Cannot add options later** — every new topping extends the constructor and breaks every existing call
- 📌 **No partial construction** — you must pass all values at once even when building the order step by step

---

### ✅ The Solution: Builder Pattern Implementation

See the actual working implementation in this repository:

**Components** (`src/Creational/Builder/`)
- [PizzaBuilderInterface.php](PizzaBuilderInterface.php) — Builder interface listing all construction steps
- [PizzaBuilder.php](PizzaBuilder.php) — Concrete Builder (custom pizza)
- [HawaiianPizzaBuilder.php](HawaiianPizzaBuilder.php) — Concrete Builder (Hawaiian preset)
- [SpicyPizzaBuilder.php](SpicyPizzaBuilder.php) — Concrete Builder (spicy preset)
- [Pizza.php](Pizza.php) — Product assembled by the builders
- [Director.php](Director.php) — Director encoding preset pizza recipes
- [PizzaSize.php](PizzaSize.php), [Topping.php](Topping.php) — Enums

**Demo**
- [demo/BuilderDemo.php](../../../demo/BuilderDemo.php) — See all scenarios working

**Key Benefits of This Implementation:**
- ✅ Fluent, readable construction — `setSize()->addTopping()->addTopping()` is self-documenting
- ✅ No invalid intermediate states — `Pizza` only returned from `getResult()` after all steps
- ✅ Director reuse — `makeHawaiianPizza()` and `makeSpicyPizza()` work with any compatible builder
- ✅ Easy to extend — add a new topping step without touching existing clients
- ✅ Swappable builders — Director works with any `PizzaBuilderInterface` implementation

### 🏁 Conclusion

The **Builder Pattern** is like a **precision toolkit** for object assembly — indispensable when a complex object must be constructed in steps and the same process should support multiple representations without polluting the client with a wall of positional parameters.

---

<div align="center">

**⭐ If this documentation helped you, please give it a star!**

*"Separate construction from representation, master complex creation."* 🚀

</div>
