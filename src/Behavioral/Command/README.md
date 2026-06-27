# 📦 Command Design Pattern

> **The Encapsulated Request** • Turn Actions into Objects That Can Be Queued, Retried, or Undone

![Design Pattern](https://img.shields.io/badge/Pattern-Behavioral-9B59B6?style=for-the-badge)
![PHP Compatible](https://img.shields.io/badge/PHP-8.4+-purple?style=for-the-badge)
![License](https://img.shields.io/badge/License-MIT-blue?style=for-the-badge)

## 🌟 Overview

| **Aspect**       | **Description**                                                              |
|------------------|------------------------------------------------------------------------------|
| **Pattern Type** | Behavioral                                                                   |
| **Purpose**      | Encapsulate a request as an object, allowing requests to be queued, retried, logged, or undone |
| **Complexity**   | ⭐⭐☆☆☆                                                                      |
| **Popularity**   | ⭐⭐⭐⭐☆                                                                     |

## 📖 Definition

> **"The Food Delivery Order"** 🛒
>
> The **Command** pattern encapsulates a request as a standalone object. You tap “Order” and the app creates an order object. The restaurant (receiver) prepares the food. The order can be queued, tracked, cancelled, or retried — without the client knowing how the restaurant operates.

## 🎯 Overall Concept

### 🎨 Visual Metaphor
> Think of a **food delivery app order** 🛒. You tap “Order,” and the app creates an order request. The restaurant receives it and prepares the food. The order can be queued, tracked, cancelled, or repeated.

### ⚡ How It Works
- **Encapsulation**: Each action (block user, refund order) is wrapped in its own command object
- **Invoker Independence**: The `CommandBus` dispatches commands without knowing their business logic
- **Deferred Execution**: Commands can be queued and executed at a later time
- **Retry Logic**: The invoker can retry failed commands without duplicating that logic in receivers

## 🔨 GoF Implementation Steps

### 📋 Step-by-Step Implementation Guide

#### **Step 1: Create the Receivers / Services**
Implement the classes that contain the actual business logic (`UserService`, `OrderService`, `MarketingService`). They know nothing about commands.

#### **Step 2: Define the Command Interface**
Declare the `Command` interface with a single `execute()` method. This is the contract the invoker uses.

#### **Step 3: Create Concrete Commands**
Implement one command class per action (`BlockUserCommand`, `RefundOrderCommand`, `SendCouponCommand`). Each wraps a receiver reference and the action parameters, and calls the receiver in `execute()`.

#### **Step 4: Build the Invoker**
Create `CommandBus`. It accepts `Command` objects through `dispatch()` (immediate) and `dispatchLater()` (queued). All retry logic lives here, not in the receivers.

#### **Step 5: Wire It Together in Client Code**
The client creates receivers, wraps them in commands, and hands commands to the `CommandBus`. It never calls receiver methods directly.

### ⚙️ Core Rules

- **Receiver / Service**: Contains the actual business logic; knows nothing about commands.
- **Command Interface**: Declares the `execute()` contract.
- **Concrete Command**: Implements the interface and calls the receiver.
- **Invoker / Command Bus**: Stores, queues, retries, or executes commands without knowing their logic.
- **Client**: Creates receivers, commands, and the invoker, then wires them together.

### 🎯 Key Implementation Principles

| **Principle**             | **Description**                                        | **Benefit**                          |
|---------------------------|--------------------------------------------------------|--------------------------------------|
| **Encapsulation**         | Each action is a self-contained object                 | Actions are portable and storable    |
| **Invoker Agnosticism**   | CommandBus never imports business logic classes        | Add new commands without touching it |
| **Single Responsibility** | Retry/queue logic in invoker; business logic in receiver | Each class has one reason to change |
| **Open/Closed**           | New action = new command class; invoker unchanged      | Safe, non-breaking extension         |

---

## 📊 When to Use Command

### ✅ Ideal Use Cases
| **Scenario**               | **Why Command?**                                           |
|----------------------------|------------------------------------------------------------|
| **Task queues**            | Commands are first-class objects that can be serialized    |
| **Retry / resilience**     | Invoker retries failed commands without receiver changes   |
| **Undo / redo**            | Store executed commands and reverse them                   |
| **Audit logging**          | Log every command object before or after execution         |
| **Deferred execution**     | Queue commands and run them later via a cron job           |

## ⚠️ When to Avoid

### 🚫 Anti-Pattern Scenarios
- ❌ **Simple direct calls** — wrapping a one-liner in a command class is over-engineering
- ❌ **No queuing or retry needed** — the pattern's value is in deferred/reliable execution
- ❌ **Performance-critical loops** — object allocation per action adds overhead

---

## 🚨 Real-world Example: Admin Panel Actions

### 🎯 Problem Statement

An admin panel can block users, refund orders, and send coupons. Some actions run immediately; others (refunds) must be queued and retried up to 3 times if they fail temporarily. Every action needs consistent retry logic.

---

### ⚠️ The Problem Without Command

```php
// ❌ BAD: AdminPanel owns all receivers and duplicates retry logic per action

class AdminPanel
{
    private array $queue = [];

    public function __construct(
        private UserService $userService,
        private OrderService $orderService,
        private MarketingService $marketingService
    ) {}

    public function blockUser(int $userId): void
    {
        // ❌ Retry logic duplicated for every action
        $this->runWithRetry(function () use ($userId) {
            $this->userService->blockUser($userId);
        });
    }

    public function refundOrderLater(int $orderId): void
    {
        // ❌ Queue tied to a closure, not a portable object
        $this->queue[] = function () use ($orderId) {
            $this->orderService->refundOrder($orderId);
        };
    }

    // ... runWithRetry duplicated, processQueue, sendCoupon ...
}
```

**The Real Problems:**
- 📌 **Tight coupling** — `AdminPanel` must import and instantiate every service class
- 📌 **Duplicate retry logic** — `runWithRetry` is copy-pasted around every action
- 📌 **Adding a new action** requires modifying `AdminPanel` directly (violates Open/Closed)
- 📌 **Closures in queue** — not serialisable, cannot be persisted or sent to a worker

---

### ✅ The Solution: Command Pattern Implementation

See the actual working implementation in this repository:

**Components** (`src/Behavioral/Command/`)
- [CommandInterface.php](CommandInterface.php) — Command interface
- [UserService.php](UserService.php), [OrderService.php](OrderService.php), [MarketingService.php](MarketingService.php) — Receivers
- [BlockUserCommand.php](BlockUserCommand.php), [RefundOrderCommand.php](RefundOrderCommand.php), [SendCouponCommand.php](SendCouponCommand.php) — Concrete Commands
- [CommandBus.php](CommandBus.php) — Invoker

**Demo**
- [demo/CommandDemo.php](../../../demo/CommandDemo.php) — See all scenarios working

**Key Benefits of This Implementation:**
- ✅ `CommandBus` never imports a service class — it only sees `Command`
- ✅ Retry logic lives in one place: `CommandBus::runWithRetry()`
- ✅ Adding `BanIpCommand` means one new class — `CommandBus` is untouched
- ✅ Commands are plain objects — serialisable and worker-friendly

### 🏁 Conclusion

The **Command Pattern** is like a **food delivery order** — the order object travels independently through the system, can be queued, retried, or cancelled, without the restaurant (receiver) or the app (invoker) needing to know each other's internals.

---

<div align="center">

**⭐ If this documentation helped you, please give it a star!**

*"Encapsulate requests as objects, master deferred execution."* 🚀

</div>
