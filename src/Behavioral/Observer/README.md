# 👀 Observer Design Pattern

> **The Event Broadcaster** • Notify All Interested Parties Automatically When State Changes

![Design Pattern](https://img.shields.io/badge/Pattern-Behavioral-9B59B6?style=for-the-badge)
![PHP Compatible](https://img.shields.io/badge/PHP-8.4+-purple?style=for-the-badge)
![License](https://img.shields.io/badge/License-MIT-blue?style=for-the-badge)

## 🌟 Overview

| **Aspect**       | **Description**                                                              |
|------------------|------------------------------------------------------------------------------|
| **Pattern Type** | Behavioral                                                                   |
| **Purpose**      | Define a one-to-many dependency so observers are notified automatically when the subject changes state |
| **Complexity**   | ⭐⭐☆☆☆                                                                      |
| **Popularity**   | ⭐⭐⭐⭐⭐                                                                     |

## 📖 Definition

> **"The YouTube Channel"** 📺
>
> The **Observer** pattern defines a one-to-many dependency between objects. When one object (the subject) changes state, all its registered observers are notified and updated automatically — just like YouTube subscribers getting notified when a channel uploads a new video.

## 🎯 Overall Concept

### 🎨 Visual Metaphor
> Think of **YouTube channel subscribers** 📺. When a channel uploads a new video, all subscribers get notified automatically. Subscribers can join or leave at any time, and the channel doesn't need to know anything about them.

### ⚡ How It Works
- **One-to-Many**: One subject notifies many observers in a single broadcast
- **Loose Coupling**: The subject only knows the `Observer` interface — never the concrete subscriber classes
- **Dynamic Subscription**: Observers can subscribe and unsubscribe at runtime
- **Fault Isolation**: A failing observer does not break the notification chain

## 🔨 GoF Implementation Steps

### 📋 Step-by-Step Implementation Guide

#### **Step 1: Define the Observer Interface**
Declare the `Observer` interface with an `update(string $message)` method. Any object that wants notifications must implement this.

#### **Step 2: Create Concrete Observers**
Implement `EmailSubscriber` and `SmsSubscriber`. Each reacts to notifications in its own way.

#### **Step 3: Build the Subject**
Create the `Product` subject. It maintains an `$observers` list and provides `subscribe()`, `unsubscribe()`, and a private `notify()` method. Business methods (e.g. `backInStock()`) call `notify()` after changing state.

#### **Step 4: Wire It Together in Client Code**
The client creates a `Product`, creates observer instances, and calls `subscribe()`. From this point, every `backInStock()` call automatically reaches all registered observers.

### ⚙️ Core Rules

- **Observer Interface**: Defines the contract for objects that want to be notified.
- **Concrete Observer**: Implements the interface and reacts to updates.
- **Subject / Publisher**: Maintains the observer list; provides `attach()` / `detach()`; notifies on state change.
- **Client**: Creates subjects and observers, then registers observers with the subject.

### 🎯 Key Implementation Principles

| **Principle**             | **Description**                                        | **Benefit**                          |
|---------------------------|--------------------------------------------------------|--------------------------------------|
| **Loose Coupling**        | Subject only knows `Observer` interface                | Add new channels without touching `Product` |
| **Open/Closed**           | New notification channel = one new class               | Subject is never modified            |
| **Dynamic Subscription**  | Observers join/leave at runtime                        | Flexible, configurable notifications |
| **Fault Isolation**       | Each observer call is wrapped in try/catch             | One broken observer cannot stop rest |

---

## 📊 When to Use Observer

### ✅ Ideal Use Cases
| **Scenario**                | **Why Observer?**                                          |
|-----------------------------|------------------------------------------------------------|
| **Event systems**           | Decouple event producers from event consumers              |
| **UI frameworks**           | Widgets react to model changes automatically               |
| **Domain events**           | Broadcast business events to multiple handlers             |
| **Stock / price alerts**    | Notify subscribers when a threshold is crossed             |

## ⚠️ When to Avoid

### 🚫 Anti-Pattern Scenarios
- ❌ **Single listener** — a direct method call is simpler and more explicit
- ❌ **Performance-critical paths** — notification overhead adds up in tight loops
- ❌ **Debugging complexity** — cascading observer chains can be hard to trace

---

## 🚨 Real-world Example: Product Back-in-Stock Notifications

### 🎯 Problem Statement

A product comes back in stock. The system must notify email and SMS subscribers. Without Observer, `Product` directly calls `sendEmail()` and `sendSms()` — hardcoding every notification channel inside the subject.

---

### ⚠️ The Problem Without Observer

```php
// ❌ BAD: Subject hardcodes every notification channel — adding Push requires editing Product

class Product
{
    private string $notificationMessage = '';

    public function backInStock(string $productName): void
    {
        $this->notificationMessage = "{$productName} is available now.";

        echo "{$productName} is back in stock.\n";

        // ❌ Notification channels hardcoded inside the subject
        $this->sendEmail();
        $this->sendSms();
    }

    private function sendEmail(): void
    {
        echo "Email sent: {$this->notificationMessage}\n";
    }

    private function sendSms(): void
    {
        echo "SMS sent: {$this->notificationMessage}\n";
    }
}
```

**The Real Problems:**
- 📌 **Violates Open/Closed** — adding Push notifications means editing `Product` directly
- 📌 **Tight coupling** — `Product` knows about email and SMS implementation details
- 📌 **No dynamic subscription** — channels are hardcoded; cannot enable/disable per user at runtime
- 📌 **Untestable in isolation** — cannot test the stock event without triggering all notification side effects

---

### ✅ The Solution: Observer Pattern Implementation

See the actual working implementation in this repository:

**Components** (`src/Behavioral/Observer/`)
**Components** (`src/Behavioral/Observer/`)
    - [ObserverInterface.php](ObserverInterface.php) — Observer interface
- [EmailSubscriber.php](EmailSubscriber.php) — Concrete Observer
- [SmsSubscriber.php](SmsSubscriber.php) — Concrete Observer
- [Product.php](Product.php) — Subject / Publisher

**Demo**
- [demo/ObserverDemo.php](../../../demo/ObserverDemo.php) — See all scenarios working

**Key Benefits of This Implementation:**
- ✅ Adding `PushSubscriber` means one new class — `Product` is untouched
- ✅ Subscribers can be added or removed per user preference at runtime
- ✅ Duplicate subscriptions silently ignored via `in_array(..., true)` check
- ✅ Each observer failure is caught; the rest of the chain continues

### 🏁 Conclusion

The **Observer Pattern** is like **YouTube subscriptions** — the channel broadcasts once and every subscriber receives it automatically, without the channel knowing or caring who is watching.

---

<div align="center">

**⭐ If this documentation helped you, please give it a star!**

*"Broadcast once, notify all — stay loosely coupled."* 🚀

</div>
