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

### 🧠 Core Philosophy
The Adapter pattern embodies the principle of **interface harmonization** - enabling communication between incompatible components without modifying their source code.

### ⚡ How It Works
- **Interface Translation**: Converts one interface to another expected format
- **Wrapping Strategy**: Encloses incompatible object with adapter logic
- **Non-invasive Integration**: Works with existing code unchanged
- **Two Implementation Styles**: Object-based (composition) or Class-based (inheritance)

### 🎨 Visual Metaphor
> Think of it as a **universal power adapter** - you plug an incompatible device into the adapter, and suddenly it works with your electrical outlet!

## ✨ Benefits & Advantages

### 🚀 Integration & Compatibility
- 🔌 **Legacy System Integration**: Connect old code to new systems
- 🌐 **Third-party Library Integration**: Use external APIs seamlessly
- 🔗 **Interface Standardization**: Create uniform contracts across diverse implementations

### 🎯 Design & Maintenance
- 📝 **Non-invasive Integration**: No need to modify original classes
- 🛡️ **Separation of Concerns**: Keeps domain logic separate from adaptation logic
- 🔄 **Reusability**: Single adapter can work with multiple clients

### 💡 Flexibility & Scalability
- 🎭 **Multiple Implementation Patterns**: Choose between object or class adapters
- 📦 **Loose Coupling**: Clients depend on adapted interface, not implementations
- 🔧 **Easy Maintenance**: Changes to original classes don't affect clients

## 🎯 Problems Solved

### 🔗 Integration Challenges
- **Legacy System Wrapping**: Adapt old APIs to modern interfaces
- **Third-party Library Mismatches**: Use incompatible external libraries
- **Format Conversion**: Transform data from one format to another

### 🌐 Interface Conflicts
- **Protocol Adaptation**: Convert between different communication protocols
- **Data Structure Translation**: Map between incompatible data models
- **Method Signature Bridging**: Connect methods with different signatures

### 📊 System Evolution
- **Backward Compatibility**: Support old interfaces while transitioning
- **Gradual Migration**: Move from old to new system incrementally
- **Version Bridge**: Connect different API versions

## 📊 When to Use Adapter

### ✅ Ideal Use Cases
| **Scenario** | **Why Adapter?** |
|--------------|-----------------|
| **Legacy API Integration** | Connect old systems to new code |
| **Third-party Services** | Integrate external APIs seamlessly |
| **Data Format Conversion** | Transform between incompatible formats |
| **Protocol Translation** | Bridge different communication standards |
| **Dependency Injection** | Adapt objects to satisfy expected interfaces |

### 🎯 Decision Checklist
- ✔️ Do you need to use an incompatible interface?
- ✔️ Can't modify the original source code?
- ✔️ Want to integrate external systems?
- ✔️ Need to standardize multiple implementations?
- ✔️ Planning for gradual system migration?

## ⚠️ When to Avoid

### 🚫 Anti-Pattern Scenarios
- ❌ **Simple type conversions** (use casting or conversion methods)
- ❌ **Frequently changing interfaces** (adapters become maintenance nightmare)
- ❌ **Performance-critical code** (adapter layer adds overhead)
- ❌ **Too many adapters** (signals bad design)

### 🔄 Better Alternatives
- **Bridge Pattern** - For separating abstraction from implementation
- **Facade Pattern** - For simplifying complex subsystems
- **Decorator Pattern** - For adding responsibilities dynamically

## 🆚 Adapter Variations

### 🎭 Object Adapter vs. Class Adapter
| **Aspect** | **Object Adapter** | **Class Adapter** |
|------------|-------------------|-------------------|
| **Implementation** | Uses composition | Uses inheritance |
| **Flexibility** | ✅ Highly flexible | 🟡 Less flexible |
| **Performance** | 🟡 Slight overhead | ✅ No overhead |
| **Support Multiple** | ✅ Many sources | ❌ Single source |
| **Testability** | ✅ Easy to mock | 🟡 Harder to mock |

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

---

## 📊 Real-world Example: Flight Fare API

### 🎯 Problem Statement

Your modern PHP application uses a clean JSON-based architecture for flight fare processing. However, you need to integrate with a **legacy Amadeus SOAP service** that:

- Returns data in **XML wrapped in SOAP envelopes**
- Uses incompatible method names (`getLowFareSearchXml()` vs expected `fetchFareJson()`)
- Has a different data structure and format
- Can't be modified due to external dependency constraints

**Challenge**: Use this legacy service without rewriting your modern codebase or polluting the domain logic with format conversion code.

### 💻 Raw Pseudo Code (Before Adaptation)

```
// PROBLEM: Two incompatible interfaces

// Legacy Service (What we have)
$legacy = new AmadeusSoapService();
$xmlData = $legacy->getLowFareSearchXml();  // Returns XML in SOAP format
// Output: <soap:Envelope>...<BaseFare>350</BaseFare>...</soap:Envelope>

// Client Expected Interface (What we need)
$processor = new FlightFareProcessor();
$processor->displayFare($dataSource);  // Expects object with fetchFareJson()
// Expected: {"base_fare": 350, "taxes": 75.50, "currency": "EUR"}

// ❌ Without Adapter: These don't match!
// Legacy: getLowFareSearchXml() returns XML
// Client: expects fetchFareJson() returns JSON
// We need something to BRIDGE this gap!
```

### 🏗️ Implementation Architecture

**Object Adapter (Composition-based):**
```
Client (FlightFareProcessor)
    ↓ uses
Interface (FlightFareDataSourceInterface)
    ↑ implements
Adapter (AmadeusFareAdapter)
    ↓ contains
Adaptee (AmadeusSoapService)
```

**Class Adapter (Inheritance-based):**
```
Client (FlightFareProcessor)
    ↓ uses
Interface (FlightFareDataSourceInterface)
    ↑ implements
Adapter (AmadeusFareAdapter)
    ↑ extends
Adaptee (AmadeusSoapService)
```

### ✅ Main Solution Implementation

Our implementation includes:

**1. Target Interface** (`FlightFareDataSourceInterface.php`)
- Defines the expected contract
- Standardizes data format (JSON with fare details)

**2. Legacy Service** (`AmadeusSoapService.php`)
- Unchanged existing code
- Returns XML in SOAP format
- Demonstrates real-world legacy service

**3. Adapter** (`AmadeusFareAdapter.php`) - Available in two variants:
- **Object Adapter** (`ObjectAdapter/AmadeusFareAdapter.php`): Uses composition
- **Class Adapter** (`ClassAdapter/AmadeusFareAdapter.php`): Uses inheritance

**4. Client Code** (`FlightFareProcessor.php`)
- Works exclusively with target interface
- Completely unaware of legacy service details
- Clean, maintainable business logic

**5. Demo Files**:
- `ObjectAdapterDemo.php` - Shows object adapter pattern
- `ClassAdapterDemo.php` - Shows class adapter pattern

### 📈 Output Example

```json
{
    "airline_code": "LH",
    "departure_time": "2026-07-15T14:30:00",
    "base_fare": 350,
    "taxes": 75.5,
    "total_fare": 425.5,
    "currency": "EUR"
}
```

## 🏁 Conclusion

The **Adapter Pattern** is like a **universal translator** - invaluable when bridging communication gaps between incompatible systems.

### 🎯 Perfect For:
- Legacy system integration
- Third-party API adaptation
- Data format transformation
- Protocol conversion
- Gradual system migration

### 💡 Implementation Wisdom:
> **"Adapt wisely, design cleanly."** - Use adapters to bridge gaps, not to fix poor design. If you're creating adapters frequently, reconsider your architecture.

### 🔑 Key Takeaways:
- **Object Adapter**: Choose for maximum flexibility and multiple source support
- **Class Adapter**: Choose when simplicity and no overhead matter most
- **Composition over Inheritance**: Object adapters generally preferred in modern PHP
- **Single Responsibility**: Each adapter should handle one type of conversion

---

<div align="center">

**⭐ If this documentation helped you, please give it a star!**

*"Bridge interfaces, build better systems."* 🚀

</div>
