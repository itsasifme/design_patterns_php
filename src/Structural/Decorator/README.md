# 🪆 Decorator Design Pattern

> **The Dynamic Wrapper** • Attaching New Behaviors at Runtime Without Modifying Existing Code

![Design Pattern](https://img.shields.io/badge/Pattern-Structural-4ECDC4?style=for-the-badge)
![PHP Compatible](https://img.shields.io/badge/PHP-8.2+-purple?style=for-the-badge)
![License](https://img.shields.io/badge/License-MIT-blue?style=for-the-badge)

## 🌟 Overview

| **Aspect**       | **Description**                                            |
|------------------|------------------------------------------------------------|
| **Pattern Type** | Structural                                                 |
| **Purpose**      | Attach additional responsibilities to an object dynamically |
| **Complexity**   | ⭐⭐☆☆☆                                                  |
| **Popularity**   | ⭐⭐⭐⭐☆                                                 |

## 📖 Definition

> **"The Matryoshka Doll"** 🪆
>
> The **Decorator** pattern attaches additional responsibilities to an object dynamically by wrapping it in one or more decorator objects that share the same interface. It provides a flexible alternative to subclassing for extending functionality.

## 🎯 Overall Concept

### 🎨 Visual Metaphor
> Think of it like ordering **Coffee** ☕.
> You start with a basic `EmailNotifier` (the core component). If you also need SMS alerts, you don't create a new `EmailSmsNotifier` class — you just wrap the notifier in an `SmsNotifierDecorator`. Need Slack too? Wrap it again! Each layer adds a new notification channel dynamically, without touching the original object.

### ⚡ How It Works
- **Interface Conformity**: The decorator implements the exact same interface as the component it wraps
- **Composition over Inheritance**: Contains a reference to the wrapped object instead of extending it
- **Delegation**: Forwards requests to the wrapped object, executing custom logic before or after
- **Stackable**: Multiple decorators can be chained in any combination at runtime

## 🔨 GoF Implementation Steps

### 📋 Step-by-Step Implementation Guide

#### **Step 1: Create the Component Interface**
Define the common interface (`NotifierInterface`) that both concrete components and decorators must implement. This guarantees transparent interchangeability.

#### **Step 2: Create the Concrete Component**
Implement the base, default behaviour in a concrete class (`EmailNotifier`). This is the raw object that will be wrapped by decorators.

#### **Step 3: Create the Base Decorator**
Create an abstract class (`NotifierDecorator`) that implements the component interface and holds a reference to a wrapped `NotifierInterface`. Its default `send()` simply delegates to the wrapped object.

#### **Step 4: Create Concrete Decorators**
Extend the base decorator with channel-specific classes (`SmsNotifierDecorator`, `SlackNotifierDecorator`, `FacebookNotifierDecorator`). Each overrides `send()` to call `parent::send()` first, then adds its own notification logic.

#### **Step 5: Use the Decorators**
Client code stacks decorators at runtime by passing one notifier into the constructor of another. The result is a layered chain — one `send()` call triggers all channels.

### 🎯 Key Implementation Principles

| **Principle**             | **Description**                                | **Benefit**                      |
|---------------------------|------------------------------------------------|----------------------------------|
| **Single Responsibility** | Each decorator handles exactly one channel     | Easy to maintain and test        |
| **Open/Closed**           | Add channels by adding decorators, not editing | Safe extension of existing code  |
| **Composition**           | Stack decorators instead of subclassing        | Eliminates subclass explosion    |
| **Transparency**          | Client works only with `NotifierInterface`     | Clean, decoupled API             |

---

## 📊 When to Use Decorator

### ✅ Ideal Use Cases
| **Scenario**                      | **Why Decorator?**                                        |
|-----------------------------------|-----------------------------------------------------------|
| **Multi-channel notifications**   | Stack channels at runtime without class explosion         |
| **Middleware / Pipeline layers**  | Add logging, caching, auth around a core handler          |
| **UI component styling**          | Layer borders, scrollbars, shadows onto widgets           |
| **I/O stream processing**         | Wrap streams with buffering, compression, encryption      |
| **Permission / role extensions**  | Add access checks around base business operations         |

## ⚠️ When to Avoid

### 🚫 Anti-Pattern Scenarios
- ❌ **Simple, fixed enhancements** (a single subclass is clearer)
- ❌ **Order-sensitive chains** where sequencing is hard to reason about
- ❌ **Deeply nested stacks** that make debugging difficult
- ❌ **Identity-sensitive code** (`instanceof` checks break with wrapped objects)


## 🚨 Real-world Example: Multi-Channel Notification System

### 🎯 Problem Statement

Your application needs to alert users about critical events (e.g. "Server is down!"). Initially, an `EmailNotifier` was enough. Business then required **SMS** support, then **Slack**, then **Facebook**. Different users need different combinations:

- Regular users: Email only
- On-call engineers: Email + SMS
- DevOps team: Email + SMS + Slack
- Admins: Email + SMS + Slack + Facebook

**Challenge**: Support all combinations now — and new channels in the future — without rewriting existing code or drowning in subclasses.

---

### ⚠️ The Problem Without Decorator

Without the Decorator pattern, you resort to inheritance and create a separate class for every possible combination — this is called **Subclass Explosion**:

```php
// ❌ BAD: One class per combination — grows out of control
interface NotifierInterface
{
    public function send(string $message): void;
}

class EmailNotifier implements NotifierInterface
{
    public function send(string $message): void
    {
        echo "Sending Email: {$message}" . PHP_EOL;
    }
}

class EmailSmsNotifier implements NotifierInterface
{
    public function send(string $message): void
    {
        echo "Sending Email: {$message}" . PHP_EOL;
        echo "Sending SMS: {$message}" . PHP_EOL;
    }
}

class EmailSlackNotifier implements NotifierInterface
{
    public function send(string $message): void
    {
        echo "Sending Email: {$message}" . PHP_EOL;
        echo "Sending Slack message: {$message}" . PHP_EOL;
    }
}

class EmailFacebookNotifier implements NotifierInterface
{
    public function send(string $message): void
    {
        echo "Sending Email: {$message}" . PHP_EOL;
        echo "Sending Facebook message: {$message}" . PHP_EOL;
    }
}

class EmailSmsSlackNotifier implements NotifierInterface
{
    public function send(string $message): void
    {
        echo "Sending Email: {$message}" . PHP_EOL;
        echo "Sending SMS: {$message}" . PHP_EOL;
        echo "Sending Slack message: {$message}" . PHP_EOL;
    }
}

class EmailSmsFacebookNotifier implements NotifierInterface
{
    public function send(string $message): void
    {
        echo "Sending Email: {$message}" . PHP_EOL;
        echo "Sending SMS: {$message}" . PHP_EOL;
        echo "Sending Facebook message: {$message}" . PHP_EOL;
    }
}

class EmailSlackFacebookNotifier implements NotifierInterface
{
    public function send(string $message): void
    {
        echo "Sending Email: {$message}" . PHP_EOL;
        echo "Sending Slack message: {$message}" . PHP_EOL;
        echo "Sending Facebook message: {$message}" . PHP_EOL;
    }
}

class EmailSmsSlackFacebookNotifier implements NotifierInterface
{
    public function send(string $message): void
    {
        echo "Sending Email: {$message}" . PHP_EOL;
        echo "Sending SMS: {$message}" . PHP_EOL;
        echo "Sending Slack message: {$message}" . PHP_EOL;
        echo "Sending Facebook message: {$message}" . PHP_EOL;
    }
}

// Client Code
$notifier = new EmailSmsSlackNotifier();
$notifier->send("Server is down!");
```

**The Real Problems:**
- 📌 **Subclass Explosion**: 4 channels already demand **8 classes** to cover all combinations — adding a 5th channel needs 16, a 6th needs 32. It grows as 2ⁿ!
- 📌 **Massive Code Duplication**: The email-sending logic is copy-pasted into every single class
- 📌 **Violates Open/Closed Principle**: Adding a new channel requires modifying or adding many existing classes
- 📌 **Rigid at Runtime**: The combination is baked into the class name — you cannot change channels dynamically based on user settings
- 📌 **Untestable in Isolation**: You cannot test the SMS logic without also running email logic

---

### ✅ The Solution: Decorator Pattern Implementation

See the actual working implementation in this repository:

**Components** (`src/Structural/Decorator/`)
- [NotifierInterface.php](NotifierInterface.php) — Component interface (contract for all notifiers and decorators)
- [EmailNotifier.php](EmailNotifier.php) — Concrete Component (base email notifier)
- [NotifierDecorator.php](NotifierDecorator.php) — Base Decorator (abstract, delegates by default)
- [SmsNotifierDecorator.php](SmsNotifierDecorator.php) — Concrete Decorator (adds SMS channel)
- [SlackNotifierDecorator.php](SlackNotifierDecorator.php) — Concrete Decorator (adds Slack channel)
- [FacebookNotifierDecorator.php](FacebookNotifierDecorator.php) — Concrete Decorator (adds Facebook channel)

**Demo**
- [demo/DecoratorDemo.php](../../../demo/DecoratorDemo.php) — See all scenarios working


**Key Benefits of This Implementation:**
- ✅ **Zero Subclass Explosion**: 4 channels = exactly 4 decorator classes
- ✅ **Dynamic Stacking**: Build any combination at runtime — no recompilation needed
- ✅ **Single Responsibility**: The SMS decorator only handles SMS. The Slack decorator only handles Slack
- ✅ **Open/Closed**: Add a new channel (e.g. WhatsApp) by creating one new decorator class — nothing else changes
- ✅ **Highly Testable**: Each decorator is independently unit-testable with a mock `NotifierInterface`
- ✅ **Readable Runtime Config**: The stacking order is explicit and readable in client code

---

### 🏁 Conclusion

The **Decorator Pattern** is like **gift wrapping** — each layer adds something new without changing what's inside. It is indispensable when you need to extend behaviour dynamically and avoid the combinatorial explosion that inheritance causes.

---

<div align="center">

**⭐ If this documentation helped you, please give it a star!**

*"Wrap objects, not your head around subclass explosions."* 🚀

</div>