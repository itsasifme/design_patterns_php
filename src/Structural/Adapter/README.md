# 🔌 Adapter Design Pattern

> **The Universal Translator** • Making Incompatible Interfaces Play Nice Together

![Design Pattern](https://img.shields.io/badge/Pattern-Structural-4ECDC4?style=for-the-badge)
![PHP Compatible](https://img.shields.io/badge/PHP-8.4+-purple?style=for-the-badge)
![License](https://img.shields.io/badge/License-MIT-blue?style=for-the-badge)

## 🌟 Overview

| **Aspect** | **Description** |
|------------|-----------------|
| **Pattern Type** | Structural |
| **Purpose** | Convert incompatible interfaces into compatible ones |
| **Complexity** | ⭐⭐⭐☆☆ |
| **Popularity** | ⭐⭐⭐☆☆ |

## 📖 Definition

> **"The Bridge Between Worlds"** 🌉
> 
> The **Adapter** pattern converts the interface of a class into another interface that clients expect, allowing incompatible interfaces to work together seamlessly.

## 🎯 Overall Concept

### 🎨 Visual Metaphor
> Think of it as a **universal power adapter** - you plug an incompatible device into the adapter, and suddenly it works with your electrical outlet!

### ⚡ How It Works
- **Interface Translation**: Converts one interface to another expected format
- **Wrapping Strategy**: Encloses incompatible object with adapter logic
- **Non-invasive Integration**: Works with existing code unchanged
- **Two Implementation Styles**: Object-based (composition) or Class-based (inheritance)

## 🔨 GoF Implementation Steps

### 📋 Step-by-Step Implementation Guide

#### **Step 1: Identify the Target Interface**
Define the interface that clients expect to work with. This becomes the contract that the adapter must implement.

#### **Step 2: Identify the Adaptee (Incompatible Class)**
Identify the existing class that has an incompatible interface. This is the legacy or third-party code that you cannot modify.

#### **Step 3: Create the Adapter**
Implement the adapter that converts the adaptee's interface to the target interface. Choose between:
- **Object Adapter (Composition)**: Contains an instance of the adaptee
- **Class Adapter (Inheritance)**: Extends the adaptee class

#### **Step 4: Use the Adapter**
Client code works exclusively with the target interface through the adapter, remaining unaware of the adaptee.

### 🎯 Key Implementation Principles

| **Principle** | **Description** | **Benefit** |
|--------------|-----------------|-----------|
| **Single Responsibility** | Adapter handles only interface conversion | Easy to maintain |
| **Preserve Original** | Don't modify adaptee class | Safe integration |
| **Hide Complexity** | Client sees only target interface | Clean API |
| **Two-way Conversion** | Some adapters support bidirectional mapping | Flexible reuse |


## 📊 When to Use Adapter

### ✅ Ideal Use Cases
| **Scenario** | **Why Adapter?** |
|--------------|-----------------|
| **Legacy API Integration** | Connect old systems to new code |
| **Third-party Services** | Integrate external APIs seamlessly |
| **Data Format Conversion** | Transform between incompatible formats |
| **Protocol Translation** | Bridge different communication standards |
| **Dependency Injection** | Adapt objects to satisfy expected interfaces |

## ⚠️ When to Avoid

### 🚫 Anti-Pattern Scenarios
- ❌ **Simple type conversions** (use casting or conversion methods)
- ❌ **Frequently changing interfaces** (adapters become maintenance nightmare)
- ❌ **Performance-critical code** (adapter layer adds overhead)
- ❌ **Too many adapters** (signals bad design)

## 🆚 Adapter Variations

### 🎭 Object Adapter vs. Class Adapter
| **Aspect** | **Object Adapter** | **Class Adapter** |
|------------|-------------------|-------------------|
| **Implementation** | Uses composition | Uses inheritance |
| **Flexibility** | ✅ Highly flexible | 🟡 Less flexible |
| **Performance** | 🟡 Slight overhead | ✅ No overhead |
| **Support Multiple** | ✅ Many sources | ❌ Single source |
| **Testability** | ✅ Easy to mock | 🟡 Harder to mock |

## 🚨 Real-world Example: Flight Fare API

### 🎯 Problem Statement

Your modern PHP application uses a clean JSON-based architecture for flight fare processing. However, you need to integrate with a **legacy Amadeus SOAP service** that:

- Returns data in **XML wrapped in SOAP envelopes**
- Uses incompatible method names (`getLowFareSearchXml()` vs expected `fetchFareJson()`)
- Has a different data structure and format
- Can't be modified due to external dependency constraints

**Challenge**: Use this legacy service without rewriting your modern codebase or polluting the domain logic with format conversion code.

### ⚠️ The Problem Without Adapter

Without the adapter pattern, you'd be forced to pollute your business logic with format conversion code scattered throughout:

```php
// ❌ BAD: Mixing business logic with service-specific parsing
class FlightFareProcessor
{
    public function displayFare($dataSource): void
    {
        // Type-checking nightmare begins...
        if ($dataSource instanceof AmadeusSoapService) {
            $xml = $dataSource->getLowFareSearchXml();  // Legacy method
            $fare = parseXmlAndExtractFare($xml);       // Custom parsing logic
        } elseif ($dataSource instanceof SabreService) {
            $xml = $dataSource->getQuoteXml();          // Different method!
            $fare = parseQuoteXmlAndExtractFare($xml);  // More custom logic
        } elseif ($dataSource instanceof KayakService) {
            $json = $dataSource->searchFlights();       // Yet another API!
            $fare = extractFareFromJson($json);         // Even more logic
        } else {
            $fare = $dataSource->fetchFareJson();       // Finally the clean case
        }
        
        // ... rest of business logic ...
    }
}
```

**The Real Problems:**
- 📌 **One class doing too many things**: Parsing Amadeus XML, Sabre XML, Kayak JSON, AND business logic
- 📌 **Violates Open/Closed Principle**: Adding each new service requires modifying this class (risky!)
- 📌 **Violates Single Responsibility**: Converting formats is NOT the responsibility of business logic
- 📌 **Hard to test**: You need to mock multiple service types with their specific formats
- 📌 **Code duplication**: Similar parsing logic is repeated for each service variant
- 📌 **Unmaintainable**: The class grows uncontrollably as more services are added

### ✅ The Solution: Adapter Pattern Implementation

See the actual working implementation in this repository:

**1. Shared Components** (`src/Structural/Adapter/`)
- [FlightFareDataSourceInterface.php](FlightFareDataSourceInterface.php) - Target interface
- [AmadeusSoapService.php](AmadeusSoapService.php) - Legacy service
- [FlightFareProcessor.php](FlightFareProcessor.php) - Client code

**2. Object Adapter** (Composition-based)
    - [ObjectAdapter/AmadeusFareAdapter.php](ObjectAdapter/AmadeusFareAdapter.php) - Wraps legacy service
    - [demo/ObjectAdapterDemo.php](../../../demo/ObjectAdapterDemo.php) - See it working

**3. Class Adapter** (Inheritance-based)
    - [ClassAdapter/AmadeusFareAdapter.php](ClassAdapter/AmadeusFareAdapter.php) - Extends legacy service
    - [demo/ClassAdapterDemo.php](../../../demo/ClassAdapterDemo.php) - See it working

**Key Benefits of This Implementation:**
- ✅ `FlightFareProcessor` stays clean - only 5 lines!
- ✅ Each class has ONE reason to change
- ✅ Add new services by creating new adapters (no modification to existing code)
- ✅ Type safe - adapters implement expected interface
- ✅ Easily testable and mockable
- ✅ Logic is reusable and isolated

### 🏁 Conclusion

The **Adapter Pattern** is like a **universal translator** - invaluable when bridging communication gaps between incompatible systems.

---

<div align="center">

**⭐ If this documentation helped you, please give it a star!**

*"Bridge interfaces, build better systems."* 🚀

</div>
