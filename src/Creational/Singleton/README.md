# 🏆 Singleton Design Pattern

> **The Ultimate Resource Controller** • One Instance to Rule Them All

![Design Pattern](https://img.shields.io/badge/Pattern-Creational-FF6B6B?style=for-the-badge)
![PHP Compatible](https://img.shields.io/badge/PHP-8.4+-purple?style=for-the-badge)
![License](https://img.shields.io/badge/License-MIT-blue?style=for-the-badge)

## 🌟 Overview

| **Aspect** | **Description** |
|------------|-----------------|
| **Pattern Type** | Creational |
| **Purpose** | Control object creation and ensure single instance |
| **Complexity** | ⭐☆☆☆☆ |
| **Popularity** | ⭐⭐⭐☆☆ |

## 📖 Definition

> **"The Gatekeeper of Instances"** 🔐
> 
> The **Singleton** pattern ensures a class has only one instance and provides a global access point to that instance, acting as a controlled gateway to shared resources.

## 🎯 Overall Concept

### 🎨 Visual Metaphor
> Think of it as the **CEO of a company** - there's only one, everyone knows how to reach them, and you can't just create another one when you feel like it!

### ⚡ How It Works
- **Single Instance**: Maintains one instance throughout application lifecycle
- **Global Access**: Provides worldwide accessibility via static method
- **Self-Governance**: Manages its own creation and access rules
- **Strict Control**: Prevents unauthorized instantiation and duplication

## 🔨 GoF Implementation Steps

### 📋 Step-by-Step Implementation Guide

#### **Step 1: Declare Private Constructor**
Create a private constructor to prevent direct instantiation from outside the class.

#### **Step 2: Create Static Instance Variable**
Maintain a static variable to hold the single instance of the class.

#### **Step 3: Implement getInstance() Method**
Create a static method that returns the single instance, creating it if necessary (lazy loading).

#### **Step 4: Use the Instance**
Client code calls the static getInstance() method to access the single instance, never creating new instances directly.

### 🎯 Key Implementation Principles

| **Principle** | **Description** | **Benefit** |
|--------------|-----------------|-----------|
| **Single Instance** | Only one instance ever created | Controlled resource usage |
| **Lazy Initialization** | Instance created only when needed | Efficient memory management |
| **Global Access** | Static getInstance() method | Easy access throughout codebase |
| **Thread Safety** | Synchronized access in concurrent code | Prevents race conditions |

---

## 🎯 Problems Solved

### 🚫 Resource Conflicts
- **Database Connection Pooling**: Prevents connection exhaustion
- **File System Access**: Avoids simultaneous write conflicts
- **Hardware Interface**: Controls access to physical devices

### 🌐 Global State Management
- **Application Configuration**: Centralized settings management
- **User Session Handling**: Consistent session data access
- **Feature Toggles**: Uniform feature flag distribution

### ⚡ Performance Challenges
- **Expensive Initialization**: Heavy objects created only once
- **Memory-intensive Resources**: Large caches or buffers
- **Network Connections**: HTTP clients or API connectors

## 📊 When to Use Singleton

### ✅ Ideal Use Cases
| **Scenario** | **Why Singleton?** |
|--------------|-------------------|
| **Database Connections** | Prevents connection pool exhaustion |
| **Logger Services** | Centralized log management |
| **Configuration Stores** | Consistent settings access |
| **Cache Systems** | Shared memory management |
| **Service Locators** | Global service access point |

### 🎯 Decision Checklist
- ✔️ Does this resource need exactly one instance?
- ✔️ Is global access necessary?
- ✔️ Would multiple instances cause problems?
- ✔️ Is the object expensive to create?
- ✔️ Does it manage shared state?

## ⚠️ When to Avoid

### 🚫 Anti-Pattern Scenarios
- ❌ **Test-heavy codebases** (hard to mock)
- ❌ **Multi-tenant applications** (different instances needed)
- ❌ **Simple utility functions** (use static methods)
- ❌ **Rapidly changing requirements** (inflexible)

### 🔄 Better Alternatives
- **Dependency Injection** - For testability and flexibility
- **Static Classes** - For stateless operations
- **Factory Pattern** - When multiple instances are needed later

## 🆚 Pattern Comparison

### 🔄 Singleton vs. Static Class
| **Aspect** | **Singleton** | **Static Class** |
|------------|---------------|------------------|
| **State Management** | ✅ Maintains state | ❌ Stateless |
| **Inheritance** | ✅ Supports interfaces | ❌ No inheritance |
| **Testing** | 🟡 Mockable with effort | ❌ Difficult to mock |
| **Flexibility** | 🟡 Controlled flexibility | ❌ Rigid |

### 🏭 Singleton vs. Factory
| **Aspect** | **Singleton** | **Factory** |
|------------|---------------|-------------|
| **Instance Control** | One instance | Multiple instances |
| **Purpose** | Access control | Creation logic |
| **Return Type** | Always same | New instances |
| **Complexity** | Simple | Variable |

## 📊 Real-world Example: Database Connection Manager

### 🎯 Problem Statement

Your application needs to manage database connections efficiently:

- Opening a new database connection for every query is **expensive** (authentication, handshake, resource allocation)
- Multiple connections could lead to **connection exhaustion** (database limits connections per user)
- Every part of the code needs **consistent access** to the same database resource
- Connection state needs to be **uniform** across the entire application

**Challenge**: Ensure one database connection is used throughout the application while allowing easy access from anywhere.

### ⚠️ The Problem Without Singleton

There are two critical problems developers face:

**Problem 1: Parameter Pollution** - Passing connection through every method:

```php
// ❌ BAD: Connection passed through every layer
function getUserData($userId, $connection) {
    return $connection->query("SELECT * FROM users WHERE id = $userId");
}

function getOrderData($userId, $connection) {
    return $connection->query("SELECT * FROM orders WHERE user_id = $userId");
}

function processPayment($orderId, $connection, $paymentGateway) {
    $order = $connection->query("SELECT * FROM orders WHERE id = $orderId");
    return $paymentGateway->process($order, $connection);
}

// Every function call requires passing connection - tedious!
$connection = connectToDatabase();
$user = getUserData($userId, $connection);
$orders = getOrderData($userId, $connection);
processPayment($orderId, $connection, $gateway);
```

**Problem 2: Repeated Instantiation** - Developers forget and create new connections:

```php
// ❌ EVEN WORSE: Different parts create their own connections
class UserRepository {
    public function getUser($id) {
        $db = new Database();  // Creates a NEW connection!
        return $db->query("SELECT * FROM users WHERE id = ?", [$id]);
    }
}

class OrderRepository {
    public function getOrders($userId) {
        $db = new Database();  // Creates ANOTHER NEW connection!
        return $db->query("SELECT * FROM orders WHERE user_id = ?", [$userId]);
    }
}

// Result: Multiple connections! Connection exhaustion! Resource waste!
$users = new UserRepository();
$orders = new OrderRepository();
$user = $users->getUser(1);              // Connection 1
$userOrders = $orders->getOrders(1);     // Connection 2 - PROBLEM!
```

**Results in BOTH cases:**
- 📌 Multiple connections wasting resources
- 📌 Database connection exhaustion errors
- 📌 Inconsistent connection state across application
- 📌 Hard to track which code is using which connection
- 📌 Memory leaks from unclosed connections

### ✅ **The Solution: Singleton Pattern Implementation**

See the actual working implementation in this repository:

**1. Database Connection Singleton** (`src/Creational/Singleton/`)
- [Inheritance/Database.php](Inheritance/Database.php) - Database connection manager using inheritance-based singleton
- [Trait/Database.php](Trait/Database.php) - Database connection manager using trait-based singleton

**2. Demo Files** (`demo/`)
- [SingletonInheritanceDemo.php](../demo/SingletonInheritanceDemo.php) - Database singleton via inheritance
- [SingletonTraitDemo.php](../demo/SingletonTraitDemo.php) - Database singleton via trait

**Key Benefits of This Implementation:**
- ✅ Single connection reused throughout application
- ✅ No need to pass connection through parameters
- ✅ Consistent connection state everywhere
- ✅ Easy to swap implementation for testing
- ✅ Clean, maintainable code
- ✅ Memory efficient

### 🏗️ Implementation Architecture

```
Application Code
    ↓ calls
getInstance() (static method)
    ↓ returns (if not exists, creates)
Single Database Connection Instance
```

### 📈 Output Example

```
========================================
Singleton Database Connection Demo
========================================

Instance 1 ID: 140735278158112
Instance 2 ID: 140735278158112
✓ Both instances are identical!

Connection Status:
- Host: localhost
- Database: test_db
- User: app_user
- Status: Active ✓

Query Result:
ID: 1, Name: John Doe, Email: john@example.com

Connection reused for second query:
ID: 2, Name: Jane Smith, Email: jane@example.com

Memory Usage: 1 connection instance
========================================
```



## 🏁 Conclusion

The **Singleton Pattern** is like a **specialized surgical tool** - incredibly powerful when used correctly in the right situations, but potentially dangerous when misused.

### 🎯 Perfect For:
- Shared resource management
- Expensive object initialization
- Global access points
- State consistency requirements

### 🔧 Remember:
> **"With great power comes great responsibility"** - use Singleton judiciously, document thoroughly, and always consider alternatives before implementation.

---

<div align="center">

**⭐ If this documentation helped you, please give it a star!**

*"Master patterns, master code."* 🚀

</div>