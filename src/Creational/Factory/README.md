# 🏭 Factory Method Design Pattern

> **The Flexible Object Creator** • Defer Instantiation to Subclasses

![Design Pattern](https://img.shields.io/badge/Pattern-Creational-FF6B6B?style=for-the-badge)
![PHP Compatible](https://img.shields.io/badge/PHP-8.4+-purple?style=for-the-badge)
![License](https://img.shields.io/badge/License-MIT-blue?style=for-the-badge)

## 🌟 Overview

| **Aspect**       | **Description**                                                             |
|------------------|-----------------------------------------------------------------------------|
| **Pattern Type** | Creational                                                                  |
| **Purpose**      | Define an interface for creating objects, letting subclasses decide which class to instantiate |
| **Complexity**   | ⭐⭐☆☆☆                                                                     |
| **Popularity**   | ⭐⭐⭐⭐⭐                                                                    |

## 📖 Definition

> **"The Subclass Director of Object Creation"** 🎬
>
> The **Factory Method** pattern defines an interface (or abstract method) for creating an object in a superclass, but allows subclasses to decide which specific class to instantiate. The creator never knows the concrete type it produced.

## 🎯 Overall Concept

### 🎨 Visual Metaphor
> Think of it as a **global logistics company** 🚚. Headquarters (Creator) defines the delivery process (factory method), but each regional office (ConcreteCreator) chooses the appropriate transport mode (Truck, Ship) based on local infrastructure — headquarters never needs to know which one was used.

### ⚡ How It Works
- **Abstract Creation**: The Creator class declares an abstract factory method instead of calling `new` directly
- **Subclass Control**: Each ConcreteCreator overrides the factory method and returns a specific ConcreteProduct
- **Polymorphic Creation**: The same factory method call produces different objects depending on which creator subclass is in use
- **Loose Coupling**: Client code depends only on the Product interface, never on a concrete class

## 🔨 GoF Implementation Steps

### 📋 Step-by-Step Implementation Guide

#### **Step 1: Define the Product Interface**
Declare an interface (`TransportInterface`) that describes what all products must be able to do. This is the type the factory method returns and that clients program against.

#### **Step 2: Create Concrete Products**
Implement one concrete class per product variant (`Truck`, `Ship`), each satisfying the `TransportInterface` interface.

#### **Step 3: Declare the Creator with an Abstract Factory Method**
Create an abstract Creator class (`LogisticsFactory`) containing the abstract factory method `createTransport(): TransportInterface`. The Creator uses the product returned by the factory method — it never calls `new Truck()` or `new Ship()` itself.

#### **Step 4: Implement Concrete Creators**
Subclass the Creator for each transport variant (`RoadLogistics`, `SeaLogistics`) and override `createTransport()` to return the appropriate ConcreteProduct.

#### **Step 5: Use the Creator**
Client code receives a `LogisticsFactory` reference and calls `planDelivery()`. It interacts with the transport through `TransportInterface` — completely unaware of whether a `Truck` or `Ship` was created.

### ⚙️ Core Rules

- **Creator**: Declares the factory method; uses the product but never instantiates it directly with `new`.
- **ConcreteCreator**: Overrides the factory method and returns a specific ConcreteProduct.
- **Product Interface**: The common contract for all created objects (`TransportInterface`).
- **ConcreteProduct**: The specific implementation produced by a ConcreteCreator (`Truck`, `Ship`).
- **Client**: Works with Creator and Product abstractions only.

### 🎯 Key Implementation Principles

| **Principle**              | **Description**                                          | **Benefit**                        |
|----------------------------|----------------------------------------------------------|------------------------------------||
| **Open/Closed**            | Add new transports by adding new creators — no edits      | Safe, non-breaking extension       |
| **Loose Coupling**         | Client depends only on abstractions                      | Easy to swap implementations       |
| **Single Responsibility**  | Each creator handles one transport type                  | Focused, maintainable classes      |
| **Polymorphic Creation**   | Same method call yields different objects via subclassing| Runtime flexibility                |

---

## 📊 When to Use Factory Method

### ✅ Ideal Use Cases
| **Scenario**               | **Why Factory Method?**                                  |
|----------------------------|----------------------------------------------------------|
| **Frameworks**             | Let consumers extend creation logic without forking code |
| **Plugin Systems**         | Third-party plugins register their own creators          |
| **Cross-Platform**         | Different creators return platform-specific products     |
| **Testing**                | Swap in a test creator that returns mock products        |
| **Complex Creation**       | When object creation involves conditional logic          |

## ⚠️ When to Avoid

### 🚫 Anti-Pattern Scenarios
- ❌ **Simple one-off objects** — direct instantiation is clearer and faster
- ❌ **Only one product variant** — no subclass variation means no benefit
- ❌ **Performance-critical loops** — factory overhead may be unacceptable
- ❌ **Over-engineering** — do not introduce creators for objects that never vary

---

## 🚨 Real-world Example: Logistics Delivery System

### 🎯 Problem Statement

A logistics platform supports multiple transport modes (Road, Sea). The core delivery planner must orchestrate a delivery — check capacity, estimate time, and dispatch — without knowing which transport will be used. Adding a new mode (Air, Rail) must not require modifying the planner.

---

### ⚠️ The Problem Without Factory Method

```php
// ❌ BAD: Creator uses a hard-coded conditional to decide which class to instantiate

class LogisticsService
{
    public function deliverGoods(string $transportType, string $destination): string
    {
        // ❌ Violates Open/Closed — every new transport type requires editing this method
        if ($transportType === 'truck') {
            $transport = new Truck();
        } elseif ($transportType === 'ship') {
            $transport = new Ship();
        } else {
            throw new \InvalidArgumentException("Invalid transport type: $transportType");
        }

        // ... use $transport to plan delivery
    }
}
```

**The Real Problems:**
- 📌 **Violates Open/Closed Principle** — adding `AirTransport` means editing `LogisticsService` directly
- 📌 **Tight coupling** — `LogisticsService` depends on every concrete transport class
- 📌 **Conditional explosion** — each new transport type adds another branch to maintain
- 📌 **Hard to test** — cannot inject a mock transport without changing the service itself

---

### ✅ The Solution: Factory Method Implementation

See the actual working implementation in this repository:

**Shared Components** (`src/Creational/Factory/`)
- [TransportInterface.php](TransportInterface.php) — Product interface (all transports implement this)
- [Truck.php](Truck.php), [Ship.php](Ship.php) — Concrete Products

**Factory Implementation** (`src/Creational/Factory/`)
- [LogisticsFactory.php](LogisticsFactory.php) — Abstract Creator (declares `createTransport()`)
- [RoadLogistics.php](RoadLogistics.php) — Concrete Creator (returns `Truck`)
- [SeaLogistics.php](SeaLogistics.php) — Concrete Creator (returns `Ship`)

**Demo**
- [demo/FactoryDemo.php](../../../demo/FactoryDemo.php) — See all scenarios working

**Key Benefits of This Implementation:**
- ✅ Adding `AirLogistics` means one new class — `LogisticsFactory` is untouched
- ✅ Clients depend only on `TransportInterface` — zero awareness of concrete types
- ✅ `LogisticsFactory::planDelivery()` works identically for road or sea
- ✅ Test creators can return mocks without any production code changes

### 🏁 Conclusion

The **Factory Method Pattern** is like a **flexible manufacturing blueprint** — it provides the structure for object creation while delegating the actual class choice to subclasses, keeping the core logic decoupled and extensible.

---

<div align="center">

**⭐ If this documentation helped you, please give it a star!**

*"Define the process, let subclasses decide the product."* 🚀

</div>
