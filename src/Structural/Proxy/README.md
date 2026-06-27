# 🛡️ Proxy Design Pattern

> **The Access Control Wrapper** • Provide a surrogate or placeholder for another object

![Design Pattern](https://img.shields.io/badge/Pattern-Structural-4ECDC4?style=for-the-badge)
![PHP Compatible](https://img.shields.io/badge/PHP-8.4+-purple?style=for-the-badge)
![License](https://img.shields.io/badge/License-MIT-blue?style=for-the-badge)

## 🌟 Overview

| **Aspect**       | **Description**                                                        |
|------------------|------------------------------------------------------------------------|
| **Pattern Type** | Structural                                                             |
| **Purpose**      | Control access to an object by introducing a surrogate with the same interface |
| **Complexity**   | ⭐⭐☆☆☆                                                                |
| **Popularity**   | ⭐⭐⭐☆☆                                                               |

## 📖 Definition

> **"The Receptionist"** 🧑‍💼
>
> The **Proxy** pattern provides a surrogate (stand-in) for another object to control access to it. The proxy and the real subject share the same interface, making the proxy transparent to clients while adding access control, caching, or lazy initialization.

## 🎯 Overall Concept

### 🎨 Visual Metaphor
> Think of a **receptionist** 🧑‍💼. A visitor (client) never enters the back office directly. The receptionist checks authorization, hands back cached documents when available, and only fetches the real file from the back office when actually needed.

### ⚡ How It Works
- **Same Interface**: Proxy implements the same interface as the real subject
- **Transparent to Client**: Clients cannot tell whether they are talking to the proxy or the real object
- **Controlled Delegation**: Proxy decides when and how to forward requests to the real subject
- **Additional Behavior**: Proxy adds cross-cutting concerns (auth, caching, logging) without modifying the real subject

## 🔨 GoF Implementation Steps

### 📋 Step-by-Step Implementation Guide

#### **Step 1: Define the Subject Interface**
Declare an interface (`ReportService`) that both the real subject and the proxy will implement. This is the contract clients program against.

#### **Step 2: Implement the Real Subject**
Create the heavyweight or sensitive class (`RealReportService`) that performs the actual work. It implements the subject interface.

#### **Step 3: Implement the Proxy**
Create the proxy class (`CachedReportProxy`) that also implements the subject interface and holds a reference to the real subject. Add the cross-cutting behavior (access control, caching) here — not in the real subject.

#### **Step 4: Use the Proxy as a Drop-in Replacement**
Clients receive a `ReportService` reference. Inject the proxy instead of the real subject. Clients call the same interface methods without any changes.

### ⚙️ Core Rules

- **Subject Interface**: Defines the common contract; both real subject and proxy implement it.
- **Real Subject**: Performs the actual work; knows nothing about the proxy.
- **Proxy**: Implements the same interface, holds a reference to the real subject, and controls access to it.
- **Client**: Programs to the subject interface; receives a proxy transparently.

### 🎯 Key Implementation Principles

| **Principle**             | **Description**                                    | **Benefit**                    |
|---------------------------|-----------------------------------------------------|--------------------------------|
| **Same Interface**        | Proxy implements exact same interface as subject    | Transparent substitution       |
| **Controlled Delegation** | Proxy decides when/how to call the real subject     | Centralized cross-cutting logic|
| **Real Subject Isolation**| Real subject contains no proxy-related code         | Clean, testable real subject   |
| **Open/Closed**           | New proxy behaviors without touching real subject   | Safe extension                 |

---

## 📊 When to Use Proxy

### ✅ Ideal Use Cases
| **Scenario**                     | **Why Proxy?**                                      |
|----------------------------------|-----------------------------------------------------|
| **Access control**               | Centralize permission checks before delegating      |
| **Caching expensive results**    | Avoid repeated heavy computations                   |
| **Remote proxies / stubs**       | Represent remote services locally                   |
| **Lazy initialization**          | Delay expensive object creation until needed        |
| **Logging / auditing**           | Transparently record all calls to the real subject  |

## ⚠️ When to Avoid

### 🚫 Anti-Pattern Scenarios
- ❌ **Trivial objects** — proxy indirection adds unnecessary complexity
- ❌ **Performance-critical hot paths** — every extra delegation has a cost
- ❌ **Too many proxy types** — signals the real subject has too many responsibilities

---

## 🚨 Real-world Example: Report Generation

### 🎯 Problem Statement

The application generates heavy PDF reports: DB queries, file loading, rendering, and logging — all in one call. Two problems emerge:
- The same report is requested repeatedly, wasting resources
- Not every user is allowed to access every report

### ⚠️ The Problem Without Proxy

Without the Proxy pattern, the client instantiates `RealReportService` directly and is forced to manually handle access control and caching inline:

```php
// ❌ BAD: No proxy — client handles access control and caching inline

class RealReportService
{
    public function generateReport(int $reportId): string
    {
        echo "Connecting to database..." . PHP_EOL;
        echo "Fetching report data..." . PHP_EOL;
        echo "Loading files from storage..." . PHP_EOL;
        echo "Rendering PDF..." . PHP_EOL;
        echo "Writing export log..." . PHP_EOL;

        return "report_{$reportId}.pdf";
    }
}

// Client Code
$reportService = new RealReportService();

$userId   = 10;
$reportId = 501;

$cache = [];

if (!isUserAllowed($userId, $reportId)) {
    die("Access denied.");
}

if (!isset($cache[$reportId])) {
    $cache[$reportId] = $reportService
        ->generateReport($reportId);
}

echo $cache[$reportId];
```

**The Real Problems:**
- 📌 **Access control scattered in client code** — every call site must repeat the `isUserAllowed()` check manually
- 📌 **Cache is local and ephemeral** — `$cache = []` is reset on every request; the expensive generation runs every time
- 📌 **Client depends on the concrete class** — client code is tightly coupled to `RealReportService` directly
- 📌 **Violates Single Responsibility** — the client owns business logic, access control, and caching all at once
- 📌 **Brittle** — adding a new cross-cutting concern (e.g. rate limiting) means modifying every call site

---

### ✅ The Solution: Proxy Pattern Implementation

See the actual working implementation in this repository:

**Components** (`src/Structural/Proxy/`)
- [ReportServiceInterface.php](ReportServiceInterface.php) — Subject interface
- [RealReportService.php](RealReportService.php) — Real Subject: the heavy implementation
- [CachedReportProxy.php](CachedReportProxy.php) — Proxy: adds caching and permission checks

**Demo**
- [demo/ProxyDemo.php](../../../demo/ProxyDemo.php) — See all scenarios working

**Key Benefits of This Implementation:**
- ✅ **Permission and caching in one place** — `CachedReportProxy` owns both concerns
- ✅ **`RealReportService` stays clean** — only generates reports, nothing else
- ✅ **Clients see no difference** — they call `ReportService::generateReport()` regardless
- ✅ **Easy to extend** — add rate limiting, auditing, or logging in the proxy without touching the real subject
- ✅ **Independently testable** — mock `ReportService` to test proxy logic in isolation

---

### 🏁 Conclusion

The **Proxy Pattern** is like a **receptionist** — invaluable when you need a transparent, drop-in gatekeeper that adds cross-cutting concerns (access control, caching, lazy init) without modifying the real subject or the clients that depend on it.

---

<div align="center">

**⭐ If this documentation helped you, please give it a star!**

*"Control access, add behavior, keep the real subject clean."* 🚀

</div>
