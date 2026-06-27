# ⛓️ Chain of Responsibility Design Pattern

> **The Sequential Gatekeeper** • Pass a Request Along a Chain Until One Handler Takes It

![Design Pattern](https://img.shields.io/badge/Pattern-Behavioral-9B59B6?style=for-the-badge)
![PHP Compatible](https://img.shields.io/badge/PHP-8.4+-purple?style=for-the-badge)
![License](https://img.shields.io/badge/License-MIT-blue?style=for-the-badge)

## 🌟 Overview

| **Aspect**       | **Description**                                                              |
|------------------|------------------------------------------------------------------------------|
| **Pattern Type** | Behavioral                                                                   |
| **Purpose**      | Pass a request along a chain of handlers; each handler decides to process or forward it |
| **Complexity**   | ⭐⭐☆☆☆                                                                      |
| **Popularity**   | ⭐⭐⭐☆☆                                                                     |

## 📖 Definition

> **"Airport Security"** ✈️
>
> The **Chain of Responsibility** pattern lets you pass requests along a chain of handlers. Each handler either processes the request or passes it to the next handler in the chain — just like airport security where each checkpoint either stops you or waves you through to the next one.

## 🎯 Overall Concept

### 🎨 Visual Metaphor
> Think of **airport security** ✈️. ID check, baggage scan, immigration, and boarding happen in order. If one check fails, you stop immediately and do not proceed further. Each checkpoint is independent and unaware of the others.

### ⚡ How It Works
- **Chain Assembly**: Handlers are linked by calling `setNext()` on each one
- **Request Passing**: Each handler runs its check; on success it forwards to the next handler
- **Early Stop**: A failing handler returns `false` from `check()` and the chain halts
- **Request Object**: A shared `OrderRequest` carries state that handlers can read and mutate

## 🔨 GoF Implementation Steps

### 📋 Step-by-Step Implementation Guide

#### **Step 1: Define the Handler Interface**
Declare `HandlerInterface` with `setNext()` and `handle()` methods. This is the contract all handlers share.

#### **Step 2: Create the Abstract Handler**
Implement `AbstractHandler` with the base forwarding logic: call `check()`; if it returns `true` and a next handler exists, forward the request. Concrete handlers only override `check()`.

#### **Step 3: Create Concrete Handlers**
Implement one handler per concern: `IpBlockHandler`, `AuthHandler`, `SanitizeHandler`, `PermissionHandler`, `CacheHandler`, `OrderSystemHandler`. Each overrides `check()` and returns `true` to continue or `false` to stop.

#### **Step 4: Define the Request Object**
`OrderRequest` carries all data every handler needs to inspect or mutate. State set by early handlers (e.g. `$isAuthenticated`) is visible to later ones.

#### **Step 5: Build the Chain and Send Requests**
Client code links handlers with `setNext()` and sends requests to the first handler. The chain does the rest.

### ⚙️ Core Rules

- **Handler Interface**: Defines the contract for handling requests and setting the next handler.
- **Abstract Handler**: Provides base chain behaviour — stores the next handler and forwards if `check()` passes.
- **Concrete Handlers**: Extend the abstract handler and handle one specific concern each.
- **Request Object**: Carries data every handler needs; may be mutated by handlers.
- **Client**: Builds the chain and sends the initial request to the first handler.

### 🎯 Key Implementation Principles

| **Principle**             | **Description**                                        | **Benefit**                           |
|---------------------------|--------------------------------------------------------|---------------------------------------|
| **Single Responsibility** | Each handler owns exactly one check                    | Easy to test, reorder, or remove      |
| **Open/Closed**           | Add a new check by adding one handler class            | Chain clients are untouched           |
| **Ordered Execution**     | Checks run in a deterministic sequence                 | Predictable, auditable processing     |
| **Early Termination**     | Any handler can halt the chain by returning false      | No wasted work after a failed check   |

---

## 📊 When to Use Chain of Responsibility

### ✅ Ideal Use Cases
| **Scenario**               | **Why CoR?**                                               |
|-----------------------------|------------------------------------------------------------|
| **Request pipelines**       | Middleware stacks, HTTP filter chains                      |
| **Multi-step validation**   | Each rule is an independent, reorderable handler           |
| **Logging / auditing**      | Transparent handlers that observe without modifying        |
| **Permission systems**      | Layered access checks that stop on first denial            |

## ⚠️ When to Avoid

### 🚫 Anti-Pattern Scenarios
- ❌ **Single check** — one `if` statement does not need a chain
- ❌ **Unordered processing** — if order doesn't matter, use a collection of validators instead
- ❌ **Debugging difficulty** — long chains can make tracing a failure path non-obvious

---

## 🚨 Real-world Example: Order Request Processing

### 🎯 Problem Statement

An online ordering system must verify each request in order: Is the IP blocked? Are credentials valid? Is input sanitized? Does the user have permission? Is there a cached response? If any check fails the request must stop immediately.

---

### ⚠️ The Problem Without Chain of Responsibility

```php
// ❌ BAD: All checks crammed into one method — every new check requires editing OrderController

class OrderController
{
    public function handle(OrderRequest $request): void
    {
        // ❌ Five independent concerns tangled together
        if (($this->failedAttempts[$request->ipAddress] ?? 0) >= 3) {
            echo "Request blocked: Too many failed attempts.\n";
            return;
        }

        if (!isset($this->users[$request->username]) ||
            $this->users[$request->username]['password'] !== $request->password) {
            echo "Request rejected: Invalid username or password.\n";
            return;
        }

        $request->note = strip_tags($request->note);

        if (!$request->isAdmin && $request->username !== $request->orderOwner) {
            echo "Request rejected: You cannot access this order.\n";
            return;
        }

        // ... cache check, final handling ...
    }
}
```

**The Real Problems:**
- 📌 **Single Responsibility violated** — IP blocking, auth, sanitization, permission, and caching in one method
- 📌 **Violates Open/Closed** — adding a rate-limit check means editing `OrderController` directly
- 📌 **Hard to reorder** — moving a check requires carefully re-reading all the surrounding logic
- 📌 **Impossible to test in isolation** — cannot unit-test the permission check without setting up all prior state

---

### ✅ The Solution: Chain of Responsibility Implementation

See the actual working implementation in this repository:

**Components** (`src/Behavioral/ChainOfResponsibility/`)
- [OrderRequest.php](OrderRequest.php) — Request object carrying all request data
- [HandlerInterface.php](HandlerInterface.php) — Handler interface
- [AbstractHandler.php](AbstractHandler.php) — Base chain forwarding logic
- [IpBlockHandler.php](IpBlockHandler.php) — IP block check
- [AuthHandler.php](AuthHandler.php) — Credential authentication
- [SanitizeHandler.php](SanitizeHandler.php) — Input sanitization
- [PermissionHandler.php](PermissionHandler.php) — Access permission check
- [CacheHandler.php](CacheHandler.php) — Cache hit check
- [OrderSystemHandler.php](OrderSystemHandler.php) — Final order processor

**Demo**
- [demo/ChainOfResponsibilityDemo.php](../../../demo/ChainOfResponsibilityDemo.php) — See all scenarios working

**Key Benefits of This Implementation:**
- ✅ Adding a rate-limit check means one new `RateLimitHandler` class — `OrderController` is gone
- ✅ Each handler is independently unit-testable with a mock `OrderRequest`
- ✅ Reordering checks means reordering `setNext()` calls — no logic changes
- ✅ Handlers are reusable across different chains (e.g. reuse `AuthHandler` in API and web)

### 🏁 Conclusion

The **Chain of Responsibility Pattern** is like **airport security** — each checkpoint is independent, focused on one concern, and stops processing immediately on failure, keeping the pipeline clean and each step individually testable.

---

<div align="center">

**⭐ If this documentation helped you, please give it a star!**

*"One concern per handler, one chain to rule them all."* 🚀

</div>
