# 🧩 Facade Design Pattern

> **The Simplified Interface** • Provide a unified interface to a set of interfaces

![Design Pattern](https://img.shields.io/badge/Pattern-Structural-4ECDC4?style=for-the-badge)
![PHP Compatible](https://img.shields.io/badge/PHP-8.4+-purple?style=for-the-badge)
![License](https://img.shields.io/badge/License-MIT-blue?style=for-the-badge)

## 🌟 Overview

| **Aspect**       | **Description**                                          |
|------------------|----------------------------------------------------------|
| **Pattern Type** | Structural                                               |
| **Purpose**      | Provide a simplified interface to a complex subsystem    |
| **Complexity**   | ⭐⭐☆☆☆                                                   |
| **Popularity**   | ⭐⭐⭐⭐☆                                                  |

## 📖 Definition

> **"The Car Starter"** 🚗
>
> The **Facade** pattern provides a single simplified interface to a complex subsystem, shielding clients from subsystem complexity and promoting loose coupling.

## 🎯 Overall Concept

### 🎨 Visual Metaphor
> Think of a **car starter** 🚗. Turning the key is one simple action, but behind it the ignition fires, the fuel pump activates, and the starter motor engages — all coordinated without the driver knowing the details.

### ⚡ How It Works
- **Single Entry Point**: One facade method replaces many subsystem calls
- **Delegation**: Facade delegates each request to the right subsystem object
- **Subsystem Independence**: Subsystem classes know nothing about the facade
- **Optional Direct Access**: Advanced clients may still use subsystems directly

## 🔨 GoF Implementation Steps

### 📋 Step-by-Step Implementation Guide

#### **Step 1: Create the Subsystem Classes**
Implement individual, focused classes that each handle one area of functionality (`PaymentValidation`, `GatewayConnector`, `TransactionLogger`). They must have no reference to or knowledge of the Facade.

#### **Step 2: Create the Facade Class**
Create `PaymentFacade` that holds references to all subsystem objects. Its methods represent coarse-grained use cases meaningful to clients.

#### **Step 3: Delegate Requests to Subsystems**
Each Facade method delegates work to the appropriate subsystem object(s) in the correct sequence — the Facade itself contains no business logic.

#### **Step 4: Program Clients to the Facade**
Client code interacts only with `PaymentFacade`. It never instantiates or calls subsystem classes directly.

### ⚙️ Core Rules

- **Facade**: Delegates client requests to the appropriate subsystem objects.
- **Subsystem Classes**: Implement specific functionality; handle the actual work. They have no knowledge of or reference to the Facade.
- **Client**: Communicates *only* with the Facade to accomplish tasks.

### 🎯 Key Implementation Principles

| **Principle**             | **Description**                                  | **Benefit**                     |
|---------------------------|--------------------------------------------------|---------------------------------|
| **Single Entry Point**    | One facade method per use case                   | Easy to use and understand      |
| **Delegation Only**       | Facade coordinates; subsystems execute           | Subsystems stay maintainable    |
| **Subsystem Ignorance**   | Subsystems have no facade reference              | Safe, independent refactoring   |
| **Open/Closed**           | New subsystems added without changing clients    | Stable public API               |

---

## 📊 When to Use Facade

### ✅ Ideal Use Cases
| **Scenario**                     | **Why Facade?**                                  |
|----------------------------------|--------------------------------------------------|
| **Complex subsystems**           | Hide complexity behind a simple API              |
| **Legacy integration**           | Provide a modern interface over legacy parts     |
| **Layer boundaries**             | Expose a clean API between architectural layers  |
| **Simplify third-party libs**    | Wrap complex external SDK behind one class       |

## ⚠️ When to Avoid

### 🚫 Anti-Pattern Scenarios
- ❌ **Need full subsystem control** — clients that require low-level access should use subsystems directly
- ❌ **God object risk** — facade accumulating business logic becomes an anti-pattern
- ❌ **Simple codebases** — a single helper function is clearer than a full facade

---

## 🚨 Real-world Example: Payment Processing

### 🎯 Problem Statement

Your application processes card payments. The operation involves three independent subsystems:
- **Validation** — verify card details and amount
- **Gateway** — connect to an external bank API and submit the request
- **Logging** — record the transaction outcome

Every call site must orchestrate all three manually, scattering the same logic everywhere and coupling clients to implementation details.

---

### ⚠️ The Problem Without Facade

Without the Facade, every controller that processes a payment must instantiate and orchestrate all three subsystems itself:

```php
// ❌ BAD: No facade — client must know about and orchestrate every subsystem manually

class CheckoutController
{
    public function checkout(string $cardDetails, float $amount): void
    {
        // ❌ Client must know about — and instantiate — every subsystem
        $validator = new PaymentValidation();
        $gateway   = new GatewayConnector();
        $logger    = new TransactionLogger();

        // ❌ Orchestration logic hardcoded here
        if ($validator->validate($cardDetails, $amount)) {
            $gateway->sendToBank($cardDetails, $amount);
            $logger->logTransaction('SUCCESS');
            echo 'Payment completed successfully!' . PHP_EOL;
        } else {
            $logger->logTransaction('FAILED');
            echo 'Payment failed!' . PHP_EOL;
        }
    }
}
```

**The Real Problems:**
- 📌 **Scattered orchestration** — the same 3-subsystem sequence is copy-pasted into every controller
- 📌 **Tight coupling** — every controller imports and instantiates all three concrete subsystem classes
- 📌 **Brittle** — adding a fraud-check step means editing `CheckoutController`, `ApiController`, `MobileController`, and every future controller individually
- 📌 **Violates Single Responsibility** — controllers own both their own logic and the entire payment coordination flow
- 📌 **Hard to test** — you cannot test the payment flow without also testing every controller that embeds it

---

### ✅ The Solution: Facade Pattern Implementation

See the actual working implementation in this repository:

**Components** (`src/Structural/Facade/`)
- [PaymentValidation.php](PaymentValidation.php) — Subsystem: validates card and amount
- [GatewayConnector.php](GatewayConnector.php) — Subsystem: connects to bank API
- [TransactionLogger.php](TransactionLogger.php) — Subsystem: logs transaction outcome
- [PaymentFacade.php](PaymentFacade.php) — Facade that composes the subsystems

**Demo**
- [demo/FacadeDemo.php](../../../demo/FacadeDemo.php) — See the scenario working

**Key Benefits of This Implementation:**
- ✅ **One method call** replaces orchestrating three subsystems
- ✅ **Subsystems are completely decoupled** from clients
- ✅ **Adding a step** (e.g. fraud check) only changes `PaymentFacade`, not every call site
- ✅ **Each subsystem** is independently testable
- ✅ **Readable client code** — `$facade->processPayment(...)` expresses intent

---

### 🏁 Conclusion

The **Facade Pattern** is like a **car starter** — one simple action hides a coordinated sequence of complex subsystem operations. It is the go-to pattern when you need to provide a clean, stable API over a complex or legacy subsystem.

---

<div align="center">

**⭐ If this documentation helped you, please give it a star!**

*"Simplify the interface, master the complexity."* 🚀

</div>
