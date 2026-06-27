# 🎯 PHP Design Patterns Repository

> **Master the Art of Software Architecture** implementations in PHP 8.4

![PHP Version](https://img.shields.io/badge/PHP-8.4%2B-777BB4?style=for-the-badge&logo=php)
![Patterns](https://img.shields.io/badge/Patterns-30%2B-blue?style=for-the-badge)
![License](https://img.shields.io/badge/License-MIT-lightgrey?style=for-the-badge)
![PSR-12](https://img.shields.io/badge/PSR--12-Compliant-brightgreen?style=for-the-badge)

## 📚 Overview

A comprehensive collection of design patterns implemented in modern PHP 8.4. This repository serves as a learning resource for implementing proven software design solutions.

## 🏗️ Pattern Categories

### 🎨 Creational Patterns
*Involved in the process of object creation*

- **✅ Singleton** - Ensure a class has only one instance
- **✅ Factory Method** - Create objects without specifying exact class
- **✅ Abstract Factory** - Create families of related objects
- **✅ Builder** - Construct complex objects step by step

### 🏛️ Structural Patterns
*Concerned with the composition of classes and objects*

- **✅ Adapter** - Allows incompatible interfaces to work together
- **✅ Decorator** - Add responsibilities to objects dynamically
- **✅ Facade** - Provide a simplified interface to a complex system
- **✅ Proxy** - Control access to an object via a surrogate

### 🎭 Behavioral Patterns
*Concerned with interaction between objects*

- **✅ Observer** - Define dependency between objects
- **✅ Strategy** - Define a family of algorithms
- **✅ Command** - Encapsulate a request as an object
- **✅ Chain of Responsibility** - Pass a request along a chain of handlers

### Directory Structure
```
 ┣ 📂demo
 ┣ 📂src
 ┃ ┣ 📂Behavioral
 ┃ ┣ 📂Creational
 ┃ ┗ 📂Structural
```

## ✨ Features

### 🎯 Modern PHP 8.4
- **Typed Properties** - Full type safety
- **Union Types** - Flexible parameter handling
- **Match Expressions** - Clean control structures
- **Constructor Property Promotion** - Concise class definitions
- **Readonly Properties** - Immutable data structures
- **PSR-12 Compliance** - Industry standard coding style
- **Documentation** - Detailed explanations and examples

### 📚 Learning Focused
- **Clean Examples** - Easy-to-understand implementations
- **Real-world Use Cases** - Practical application scenarios
- **Best Practices** - Professional implementation tips
- **Anti-pattern Warnings** - Common mistakes to avoid

## 🎓 Learning Path

### Recommended Study Order
1. Singleton → Builder → Factory → Abstract Factory
2. Adapter → Decorator → Facade → Proxy
3. Strategy →  Observer → Command  → Chain of Responsibility


## 📊 Design Pattern Comparison Guide

### Creational Patterns

| Pattern | Type | Complexity | Use Case | Key Feature | When to Use |
|---------|------|------------|----------|-------------|-------------|
| **Singleton** | Creational | ⭐☆☆☆☆ | Global access point | Single instance | When exactly one instance is needed |
| **Factory Method** | Creational | ⭐⭐☆☆☆ | Object creation | Subclass decides | When class doesn't know exact object type |
| **Abstract Factory** | Creational | ⭐⭐⭐☆☆ | Families of objects | Product families | When system needs multiple product families |
| **Builder** | Creational | ⭐⭐☆☆☆ | Complex objects | Step-by-step construction | When object has many optional parameters |

### Structural Patterns

| Pattern | Type | Complexity | Use Case | Key Feature | When to Use |
|---------|------|------------|----------|-------------|-------------|
| **Adapter** | Structural | ⭐⭐☆☆☆ | Interface compatibility | Wrapper for compatibility | When integrating incompatible interfaces |
| **Decorator** | Structural | ⭐⭐☆☆☆ | Dynamic responsibilities | Add functionality dynamically | When need to add responsibilities to objects without subclassing |
| **Facade** | Structural | ⭐☆☆☆☆ | Simplified interface | Unified interface to subsystem | When need simple interface to complex subsystem |
| **Proxy** | Structural | ⭐⭐☆☆☆ | Object access control | Surrogate or placeholder | When need to control access to an object |

### Behavioral Patterns

| Pattern | Type | Complexity | Use Case | Key Feature | When to Use |
|---------|------|------------|----------|-------------|-------------|
| **Observer** | Behavioral | ⭐⭐⭐☆☆ | Event handling | Publish-subscribe mechanism | When objects need to be notified of changes |
| **Strategy** | Behavioral | ⭐⭐☆☆☆ | Algorithm selection | Interchangeable algorithms | When need to select algorithm at runtime |
| **Command** | Behavioral | ⭐⭐☆☆☆ | Action encapsulation | Encapsulate requests as objects | When need to parameterize objects with operations |
| **Chain of Responsibility** | Behavioral | ⭐⭐⭐☆☆ | Request handling | Pass request along chain | When multiple objects may handle a request |


## 📖 Documentation

Each pattern includes comprehensive documentation:

- **Definition** - Clear pattern explanation
- **Benefits** - Advantages and use cases
- **Implementation** - Code structure and examples
- **When to Use** - Appropriate scenarios
- **When to Avoid** - Anti-pattern warnings

## 🌟 Why This Repository?

### ✅ Professional Grade
- PSR-12 compliant
- Well documented

### ✅ Learning Optimized
- Clean, readable code
- Practical examples
- Progressive complexity
- Real-world scenarios

### ✅ Modern PHP
- PHP 8.4 features
- Modern syntax
- Type safety
- Performance optimized

## 🤝 Contributing

We welcome contributions! Please see our contributing guidelines:

1. **Fork** the repository
2. **Create** a feature branch
3. **Implement** patterns with tests
4. **Follow** PSR-12 standards
5. **Submit** a pull request

### Contribution Areas
- New pattern implementations
- Additional examples
- Improved documentation
- Performance optimizations
- Test coverage expansion

## 📚 Resources

### Recommended Reading
- **Design Patterns: Elements of Reusable Object-Oriented Software** (Gang of Four)
- **[Refactoring Guru](https://refactoring.guru/design-patterns)** - Excellent visual explanations and real-world examples for every pattern

### Useful Links
- [PHP FIG Standards](https://www.php-fig.org/)
- [PHP Manual](https://www.php.net/manual/)
- [Design Patterns Reference](https://refactoring.guru/design-patterns)

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🙏 Acknowledgments

- **Gang of Four** - For the original design patterns book
- **PHP Community** - For ongoing improvements and standards
- **Contributors** - Everyone who helps improve this repository

---

<div align="center">

**⭐ If this documentation helped you, please give it a star!**

*"Master patterns, master code."* 🚀

</div>
