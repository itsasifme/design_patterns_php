# 🏛️ Abstract Factory Design Pattern

> **The Family Creator** • Create Families of Related Objects Without Specifying Concrete Classes

![Design Pattern](https://img.shields.io/badge/Pattern-Creational-FF6B6B?style=for-the-badge)
![PHP Compatible](https://img.shields.io/badge/PHP-8.4+-purple?style=for-the-badge)
![License](https://img.shields.io/badge/License-MIT-blue?style=for-the-badge)

## 🌟 Overview

| **Aspect**       | **Description**                                                                        |
|------------------|----------------------------------------------------------------------------------------|
| **Pattern Type** | Creational                                                                             |
| **Purpose**      | Produce families of related objects without specifying their concrete classes          |
| **Complexity**   | ⭐⭐⭐☆☆                                                                                    |
| **Popularity**   | ⭐⭐⭐⭐☆                                                                                   |

## 📖 Definition

> **"The Platform Architect"** 🏛️
>
> The **Abstract Factory** pattern provides an interface for creating families of related or dependent objects without specifying their concrete classes. All products created by one factory belong to the same variant and are guaranteed to be compatible.

## 🎯 Overall Concept

### 🎨 Visual Metaphor
> Think of it as a **furniture manufacturer** 🛋️. You order from the Victorian factory — you get a Victorian chair and a Victorian sofa. You order from the Modern factory — you get a Modern chair and a Modern sofa. You never mix a Victorian chair with a Modern sofa because the factory guarantees the whole set matches.

### ⚡ How It Works
- **Family Guarantee**: All products from one factory belong to the same variant and are compatible
- **Interface-Based**: Client depends only on the Abstract Factory and Abstract Product interfaces
- **Swappable Factories**: Switching a platform means swapping one factory object — nothing else changes
- **No Concrete References**: Client code never calls `new WindowsButton()` or `new MacCheckbox()` directly

## 🔨 GoF Implementation Steps

### 📋 Step-by-Step Implementation Guide

#### **Step 1: Define Abstract Product Interfaces**
Declare one interface per product type in the family (`ButtonInterface`, `CheckboxInterface`). These describe what each product can do, regardless of platform.

#### **Step 2: Create Concrete Products**
Implement platform-specific classes for each product type: `WindowsButton`, `MacButton`, `WindowsCheckbox`, `MacCheckbox`. Each implements the matching abstract product interface.

#### **Step 3: Define the Abstract Factory Interface**
Declare a factory interface (`GUIFactory`) with one creation method per product type: `createButton()`, `createCheckbox()`. This is the contract all concrete factories must follow.

#### **Step 4: Create Concrete Factories**
Implement one factory class per platform variant (`WindowsFactory`, `MacFactory`). Each factory method returns the platform-specific concrete product.

#### **Step 5: Use the Abstract Factory**
Client code receives a `GUIFactory` reference and calls `createButton()` / `createCheckbox()`. It works entirely through interfaces — the platform is determined by which factory was injected.

### ⚙️ Core Rules

- **Abstract Factory**: Declares creation methods for each product type in the family.
- **Concrete Factory**: Implements creation methods; all products from one factory belong to the same variant.
- **Abstract Product**: Declares the interface for one type of product (`ButtonInterface`, `CheckboxInterface`).
- **Concrete Product**: Platform-specific implementation; knows nothing about the factory or other products.
- **Client**: Programs only to `GUIFactory` and abstract product interfaces — never to concrete classes.

### 🎯 Key Implementation Principles

| **Principle**             | **Description**                                           | **Benefit**                          |
|---------------------------|-----------------------------------------------------------|--------------------------------------|
| **Family Consistency**    | One factory produces only compatible products             | No accidental Windows/Mac mix-ups    |
| **Open/Closed**           | New platform = new factory + new products; no edits       | Safe, non-breaking extension         |
| **Interface Segregation** | Each product type has its own focused interface           | Clean, minimal contracts             |
| **Dependency Inversion**  | Client depends on abstractions, not concrete classes      | Fully testable and swappable         |

---

## 📊 When to Use Abstract Factory

### ✅ Ideal Use Cases
| **Scenario**                | **Why Abstract Factory?**                                     |
|-----------------------------|---------------------------------------------------------------|
| **Cross-platform UIs**      | Swap entire widget families per OS without touching clients   |
| **Theme/Skin systems**      | Switch a full visual theme by swapping one factory            |
| **Database portability**    | Swap SQL/NoSQL product families without changing query logic  |
| **Plugin architectures**    | Each plugin ships its own factory for a consistent component set |
| **Test doubles**            | Inject a mock factory that returns stub products in tests     |

## ⚠️ When to Avoid

### 🚫 Anti-Pattern Scenarios
- ❌ **Single product type** — one product with no family means Factory Method is simpler
- ❌ **Rarely changes platform** — if you only ever target one platform, the abstraction is overhead
- ❌ **Products are unrelated** — Abstract Factory is for *families*; unrelated objects need separate factories
- ❌ **Over-engineering** — do not create families of factories for objects that never vary by platform

---

## 🚨 Real-world Example: Cross-Platform GUI

### 🎯 Problem Statement

Your application renders a GUI with buttons and checkboxes. It must support both Windows and macOS, each with its own native look and feel. Every widget must match its platform — mixing a Windows button with a Mac checkbox is a bug.

---

### ⚠️ The Problem Without Abstract Factory

```php
// ❌ BAD: Client uses conditionals to create each product — platform logic scattered everywhere

class UIRenderer
{
    public function render(string $platform): void
    {
        // ❌ Separate conditional for every product type
        if ($platform === 'windows') {
            $button = new WindowsButton();
        } elseif ($platform === 'mac') {
            $button = new MacButton();
        } else {
            throw new \InvalidArgumentException("Unknown platform: $platform");
        }

        // ❌ Same conditional duplicated for every new product
        if ($platform === 'windows') {
            $checkbox = new WindowsCheckbox();
        } elseif ($platform === 'mac') {
            $checkbox = new MacCheckbox();
        }

        $button->render();
        $checkbox->render();
    }
}
```

**The Real Problems:**
- 📌 **Conditional explosion** — every new product type (Dropdown, TextField) adds another full if/elseif block
- 📌 **No family guarantee** — a bug could mix `WindowsButton` with `MacCheckbox`; the compiler won't catch it
- 📌 **Violates Open/Closed** — adding Linux support means editing every conditional in `UIRenderer`
- 📌 **Tight coupling** — `UIRenderer` depends on all six concrete product classes directly

---

### ✅ The Solution: Abstract Factory Implementation

See the actual working implementation in this repository:

**Components** (`src/Creational/AbstractFactory/`)
- [GUIFactory.php](GUIFactory.php) — Abstract Factory interface
- [ButtonInterface.php](ButtonInterface.php), [CheckboxInterface.php](CheckboxInterface.php) — Abstract Product interfaces
- [WindowsFactory.php](WindowsFactory.php), [MacFactory.php](MacFactory.php) — Concrete Factories
- [WindowsButton.php](WindowsButton.php), [MacButton.php](MacButton.php) — Concrete Button products
- [WindowsCheckbox.php](WindowsCheckbox.php), [MacCheckbox.php](MacCheckbox.php) — Concrete Checkbox products

**Demo**
- [demo/AbstractFactoryDemo.php](../../../demo/AbstractFactoryDemo.php) — See all scenarios working

**Key Benefits of This Implementation:**
- ✅ **Family consistency guaranteed** — `WindowsFactory` can only produce Windows products; mixing is impossible
- ✅ **Adding Linux** means one new factory + two new product classes — `UIRenderer` is untouched
- ✅ **Client is fully decoupled** — `UIRenderer` only sees `GUIFactory`, `ButtonInterface`, `CheckboxInterface`
- ✅ **Testable** — inject a `MockGUIFactory` that returns stubs without touching production code

### 🏁 Conclusion

The **Abstract Factory Pattern** is like a **platform-specific manufacturing plant** — essential when your system must support multiple product families and you need a compile-time guarantee that components from different families are never accidentally mixed.

---

<div align="center">

**⭐ If this documentation helped you, please give it a star!**

*"Create families, guarantee compatibility, swap the whole set."* 🚀

</div>
