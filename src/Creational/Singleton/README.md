# 🏆 Singleton Design Pattern

> **The Ultimate Resource Controller** • One Instance to Rule Them All

![Design Pattern](https://img.shields.io/badge/Pattern-Creational-FF6B6B?style=for-the-badge)
![PHP Compatible](https://img.shields.io/badge/PHP-8.4+-purple?style=for-the-badge)
![License](https://img.shields.io/badge/License-MIT-blue?style=for-the-badge)

## 🌟 Overview

| **Aspect**       | **Description**                                                             |
|------------------|-----------------------------------------------------------------------------|
| **Pattern Type** | Creational                                                                  |
| **Purpose**      | Ensure a class has only one instance and provide a global access point to it |
| **Complexity**   | ⭐☆☆☆☆                                                                     |
| **Popularity**   | ⭐⭐⭐☆☆                                                                    |

## 📖 Definition

> **"The Gatekeeper of Instances"** 🔐
>
> The **Singleton** pattern ensures a class has only one instance and provides a global access point to that instance, acting as a controlled gateway to shared resources.

## 🎯 Overall Concept

### 🎨 Visual Metaphor
> Think of it as the **CEO of a company** 🏢. There is only one, everyone knows how to reach them, and you cannot just create another one when you feel like it.

### ⚡ How It Works
- **Private Constructor**: Prevents direct instantiation from outside the class
- **Static Instance Variable**: Stores the one-and-only instance
- **Static Access Method**: `getInstance()` returns the existing instance or creates one on first call
- **Lazy Initialization**: Instance is created only when first requested

## 🔨 GoF Implementation Steps

### 📋 Step-by-Step Implementation Guide

#### **Step 1: Declare a Private Constructor**
Make the constructor private so no external code can call `new ClassName()` directly. This is the fundamental guard against unauthorized instantiation.

#### **Step 2: Declare a Static Instance Variable**
Add a private static property (e.g. `$instance`) to hold the single object once it is created.

#### **Step 3: Implement the Static `getInstance()` Method**
Implement a public static method that checks whether the static instance already exists. If not, it creates it (lazy initialization). Either way, it returns the single instance.

#### **Step 4: Use the Instance Through `getInstance()`**
All client code accesses the object via `ClassName::getInstance()` — never via `new`. The method always returns the same instance throughout the application lifetime.

### ⚙️ Core Rules

- **Singleton Class**: Controls its own instantiation; one instance at most.
- **`getInstance()` Method**: The only way clients obtain a reference to the instance.
- **Client**: Never calls `new`; always uses `getInstance()` to get the shared object.

### 🎯 Key Implementation Principles

| **Principle**          | **Description**                                      | **Benefit**                        |
|------------------------|------------------------------------------------------|------------------------------------||
| **Single Instance**    | Only one instance ever created per process           | Controlled shared resource usage   |
| **Lazy Initialization**| Instance created only when first requested           | Efficient memory management        |
| **Global Access**      | Static `getInstance()` reachable from anywhere       | Convenient shared state access     |
| **Self-Governance**    | Class controls its own creation rules                | Encapsulated lifecycle management  |

---

## 📊 When to Use Singleton

### ✅ Ideal Use Cases
| **Scenario**             | **Why Singleton?**                                  |
|--------------------------|-----------------------------------------------------|
| **Database Connections** | Prevent connection pool exhaustion                  |
| **Logger Services**      | Centralized log management from one object          |
| **Configuration Stores** | Consistent settings access across the application  |
| **Cache Systems**        | Shared in-memory cache managed from one place       |
| **Service Locators**     | Single global service registry                      |

## ⚠️ When to Avoid

### 🚫 Anti-Pattern Scenarios
- ❌ **Test-heavy codebases** — global state makes unit tests fragile and order-dependent
- ❌ **Multi-tenant applications** — different tenants may require different instances
- ❌ **Simple utility functions** — use static methods instead; no mutable state needed
- ❌ **Rapidly changing requirements** — tight global coupling makes refactoring painful

---

## 🚨 Real-world Example: Database Connection Manager

### 🎯 Problem Statement

Your application needs to manage database connections efficiently. Opening a new connection for every query is expensive (authentication, handshake, resource allocation), and multiple simultaneous connections can exhaust the database connection limit.

**Challenge**: Guarantee one database connection is used throughout the application lifetime while keeping it accessible from anywhere.

---

### ⚠️ The Problem Without Singleton

Two recurring problems appear in production codebases:

**Problem 1 — Parameter Pollution**: The connection object must be passed as an argument through every function and class method that needs it. As the codebase grows, this clutters every function signature and makes refactoring painful.

**Problem 2 — Repeated Instantiation**: Different parts of the codebase independently instantiate their own `Database` objects, each opening a brand-new connection. With four or five repositories doing this simultaneously, the database connection pool is exhausted.

**Consequences:**
- 📌 **Multiple connections** open simultaneously, wasting database server resources
- 📌 **Connection exhaustion errors** under moderate load
- 📌 **Inconsistent connection state** across the application
- 📌 **Memory leaks** from connections never explicitly closed

---

### ✅ The Solution: Singleton Pattern Implementation

See the actual working implementation in this repository:

**Components** (`src/Creational/Singleton/`)
- [Inheritance/Database.php](Inheritance/Database.php) — Database connection manager using an inheritance-based singleton
- [Trait/Database.php](Trait/Database.php) — Database connection manager using a reusable trait-based singleton

**Demo**
- [demo/SingletonInheritanceDemo.php](../../../demo/SingletonInheritanceDemo.php) — Database singleton via inheritance
- [demo/SingletonTraitDemo.php](../../../demo/SingletonTraitDemo.php) — Database singleton via trait

**Key Benefits of This Implementation:**
- ✅ One connection instance reused for every query in the application
- ✅ No need to pass the connection through function parameters
- ✅ Consistent connection state everywhere
- ✅ Easy to swap the implementation for a test double
- ✅ Memory efficient — only one object allocated for the lifetime of the request

### 🏁 Conclusion

The **Singleton Pattern** is like a **specialized surgical tool** — incredibly powerful when used correctly in the right situations (shared expensive resources), but potentially dangerous when overused as a global variable substitute.

---

<div align="center">

**⭐ If this documentation helped you, please give it a star!**

*"One instance to rule them all."* 🚀

</div>
