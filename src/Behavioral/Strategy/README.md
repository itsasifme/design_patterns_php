# 🎯 Strategy Design Pattern

> **The Interchangeable Algorithm** • Define a Family of Algorithms and Make Them Swappable at Runtime

![Design Pattern](https://img.shields.io/badge/Pattern-Behavioral-9B59B6?style=for-the-badge)
![PHP Compatible](https://img.shields.io/badge/PHP-8.4+-purple?style=for-the-badge)
![License](https://img.shields.io/badge/License-MIT-blue?style=for-the-badge)

## 🌟 Overview

| **Aspect**       | **Description**                                                              |
|------------------|------------------------------------------------------------------------------|
| **Pattern Type** | Behavioral                                                                   |
| **Purpose**      | Define a family of algorithms, encapsulate each one, and make them interchangeable at runtime |
| **Complexity**   | ⭐☆☆☆☆                                                                      |
| **Popularity**   | ⭐⭐⭐⭐⭐                                                                     |

## 📖 Definition

> **"The Washing Machine"** 🧺
>
> The **Strategy** pattern defines a family of algorithms, encapsulates each one in its own class, and makes them interchangeable. The context delegates the algorithm to whichever strategy object is currently set.

## 🎯 Overall Concept

### 🎨 Visual Metaphor
> Think of a **washing machine** 🧺. Same machine, same goal: wash clothes. But you can choose Quick Wash, Delicate Wash, Heavy Wash, or Normal Wash. The selected mode changes the washing behaviour without changing the machine itself.

### ⚡ How It Works
- **Strategy Interface**: Declares the common method all algorithms must implement
- **Concrete Strategies**: Each encapsulates one specific algorithm
- **Context**: Holds a reference to a strategy and delegates the algorithm call to it
- **Runtime Swap**: The context exposes a setter so the strategy can be changed at any point

## 🔨 GoF Implementation Steps

### 📋 Step-by-Step Implementation Guide

#### **Step 1: Define the Strategy Interface**
Declare the common contract (`DeliveryFeeStrategy`) that every concrete algorithm must implement.

#### **Step 2: Create Concrete Strategies**
Implement one class per algorithm (`StandardDelivery`, `ExpressDelivery`, `StorePickup`). Each encapsulates its own calculation logic.

#### **Step 3: Create the Context**
Build the `CheckoutService` context class. It holds a `DeliveryFeeStrategy` reference and delegates `calculateDeliveryFee()` to it. It also exposes `setDeliveryFeeStrategy()` for runtime swapping.

#### **Step 4: Use the Context**
Client code creates a `CheckoutService` with an initial strategy. It calls `calculateDeliveryFee()` without knowing which algorithm runs, and swaps the strategy freely at runtime.

### ⚙️ Core Rules

- **Strategy Interface**: Defines the common contract for all algorithms.
- **Concrete Strategies**: Implement different versions of the algorithm.
- **Context**: Uses a strategy object and provides a way to swap strategies dynamically.
- **Client**: Creates the context, selects a strategy, and may change the strategy at runtime.

### 🎯 Key Implementation Principles

| **Principle**             | **Description**                                      | **Benefit**                        |
|---------------------------|------------------------------------------------------|------------------------------------||
| **Open/Closed**           | Add a new algorithm by adding one new class          | No changes to context or client    |
| **Single Responsibility** | Each strategy owns exactly one algorithm             | Easy to test in isolation          |
| **Runtime Flexibility**   | Strategy can be swapped while the context is live    | No recompilation or restart needed |
| **Loose Coupling**        | Context depends on the interface, not concrete class | Easy to mock in tests              |

---

## 📊 When to Use Strategy

### ✅ Ideal Use Cases
| **Scenario**                     | **Why Strategy?**                                       |
|----------------------------------|----------------------------------------------------------|
| **Multiple algorithm variants**  | Replace if/elseif chains with interchangeable classes   |
| **Runtime behaviour change**     | Swap the algorithm without touching client code         |
| **A/B testing**                  | Inject a different strategy per user cohort             |
| **Payment / shipping methods**   | Each method is an independent strategy                  |

## ⚠️ When to Avoid

### 🚫 Anti-Pattern Scenarios
- ❌ **Only one algorithm** — no variation means no benefit from the extra abstraction
- ❌ **Simple condition** — two branches rarely justify a full strategy hierarchy
- ❌ **Stateless one-liners** — a plain callable or closure is simpler and clearer

---

## 🚨 Real-world Example: E-commerce Delivery Fee

### 🎯 Problem Statement

An e-commerce website calculates delivery fees differently for Standard, Express, and Store Pickup. A growing number of options (Same Day, International) keeps extending the same conditional block inside `CheckoutService`.

---

### ⚠️ The Problem Without Strategy

```php
// ❌ BAD: Every new delivery option requires editing this method

class CheckoutService
{
    public function calculateDeliveryFee(
        float $orderTotal,
        float $distanceKm,
        string $deliveryType
    ): float {
        if ($deliveryType === 'standard') {
            return $orderTotal >= 100 ? 0 : 5;
        }

        if ($deliveryType === 'express') {
            return 10 + ($distanceKm * 1.5);
        }

        if ($deliveryType === 'pickup') {
            return 0;
        }

        throw new InvalidArgumentException("Unknown delivery type.");
    }
}
```

**The Real Problems:**
- 📌 **Violates Open/Closed** — adding Same Day Delivery requires editing `CheckoutService` directly
- 📌 **Conditional explosion** — each new option adds another branch to maintain and test
- 📌 **Hard to test** — cannot test one algorithm without instantiating the full service
- 📌 **Runtime change impossible** — cannot swap the delivery algorithm while a checkout session is live

---

### ✅ The Solution: Strategy Pattern Implementation

See the actual working implementation in this repository:

**Components** (`src/Behavioral/Strategy/`)
- [DeliveryFeeStrategyInterface.php](DeliveryFeeStrategyInterface.php) — Strategy interface
- [StandardDelivery.php](StandardDelivery.php) — Concrete Strategy
- [ExpressDelivery.php](ExpressDelivery.php) — Concrete Strategy
- [StorePickup.php](StorePickup.php) — Concrete Strategy
- [CheckoutService.php](CheckoutService.php) — Context

**Demo**
- [demo/StrategyDemo.php](../../../demo/StrategyDemo.php) — See all scenarios working

**Key Benefits of This Implementation:**
- ✅ Adding Same Day Delivery means one new class — `CheckoutService` is untouched
- ✅ Each algorithm is independently testable with a plain `new StandardDelivery()` call
- ✅ Strategy can be swapped mid-session when a customer changes their delivery option
- ✅ Client code reads like a sentence: `$checkout->setDeliveryFeeStrategy(new ExpressDelivery())`

### 🏁 Conclusion

The **Strategy Pattern** is like a **washing machine mode selector** — same machine, but the selected mode completely changes the internal behaviour. It is the go-to pattern for replacing conditional logic with clean, swappable algorithm objects.

---

<div align="center">

**⭐ If this documentation helped you, please give it a star!**

*"Encapsulate what varies, make it swappable."* 🚀

</div>
