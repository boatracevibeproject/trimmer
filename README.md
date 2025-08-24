# Trimmer for Boatrace Venture Project

[English](README.md) | [日本語](README_ja.md)

[![keepalive](https://github.com/shimomo/bvp-trimmer/actions/workflows/keepalive.yml/badge.svg)](https://github.com/shimomo/bvp-trimmer/actions/workflows/keepalive.yml)
[![psalm](https://github.com/shimomo/bvp-trimmer/actions/workflows/psalm.yml/badge.svg)](https://github.com/shimomo/bvp-trimmer/actions/workflows/psalm.yml)
[![test](https://github.com/shimomo/bvp-trimmer/actions/workflows/test.yml/badge.svg)](https://github.com/shimomo/bvp-trimmer/actions/workflows/test.yml)
[![codecov](https://codecov.io/gh/shimomo/bvp-trimmer/graph/badge.svg?token=27E93D01MN)](https://codecov.io/gh/shimomo/bvp-trimmer)
[![php](https://poser.pugx.org/bvp/trimmer/require/php)](https://packagist.org/packages/bvp/trimmer)
[![stable](https://poser.pugx.org/bvp/trimmer/v/stable)](https://packagist.org/packages/bvp/trimmer)
[![unstable](https://poser.pugx.org/bvp/trimmer/v/unstable)](https://packagist.org/packages/bvp/trimmer#5.x-dev)
[![license](https://poser.pugx.org/bvp/trimmer/license)](https://packagist.org/packages/bvp/trimmer)

BVP Trimmer is a PHP library that extends the built-in functions `trim`, `ltrim`, and `rtrim` and allows you to recursively trim **arrays** and **objects** as well.

## 📦 Requirements
- PHP: ^8.2
- myclabs/deep-copy: ^1.11

## 💾 Installation
```bash
composer require bvp/trimmer
```

## ⚡ Usage

### Supported Methods

| Method | Description | Parameters |
|---|---|---|
| `Trimmer::trim(`<br>&nbsp;&nbsp;&nbsp;&nbsp;`$value,`<br>&nbsp;&nbsp;&nbsp;&nbsp;`$characters = null`<br>`)` | Trims strings, arrays, and objects | `$value` : string \| array \| object<br>`$characters` : Characters to remove (optional) |
| `Trimmer::ltrim(`<br>&nbsp;&nbsp;&nbsp;&nbsp;`$value,`<br>&nbsp;&nbsp;&nbsp;&nbsp;`$characters = null`<br>`)` | Left-side trimming | Same as above |
| `Trimmer::rtrim(`<br>&nbsp;&nbsp;&nbsp;&nbsp;`$value,`<br>&nbsp;&nbsp;&nbsp;&nbsp;`$characters = null`<br>`)` | Right-side trimming | Same as above |

### Basic Usage

```php
<?php

require __DIR__ . '/vendor/autoload.php';

use BVP\Trimmer\Trimmer;

// Trim strings
echo Trimmer::trim(' trimmer ');                // "trimmer"
echo Trimmer::trim(' @trimmer@ ', "\x20\x40");  // "trimmer"

// Left-side trim only
echo Trimmer::ltrim(' trimmer ');               // "trimmer "
echo Trimmer::ltrim(' @trimmer@ ', "\x20\x40"); // "trimmer@ "

// Right-side trim only
echo Trimmer::rtrim(' trimmer ');               // " trimmer"
echo Trimmer::rtrim(' @trimmer@ ', "\x20\x40"); // " @trimmer"
```

---

### Trimmer::trim() - Trimming Arrays

```php
$result = Trimmer::trim([' trimmerA ']);
print_r($result);

// Output:
Array
(
    [0] => trimmerA
)
```

```php
$result = Trimmer::trim([' trimmerA ', [' trimmerB ']]);
print_r($result);

// Output:
Array
(
    [0] => trimmerA
    [1] => Array
        (
            [0] => trimmerB
        )
)
```

```php
$result = Trimmer::trim([' trimmerA ', 1, 1.0, true, null]);
print_r($result);

// Output:
Array
(
    [0] => trimmerA
    [1] => 1
    [2] => 1
    [3] => 1
    [4] =>
)
```

---

### Trimmer::trim() - Trimming Objects

To trim object properties, you must provide **getter** and **setter** methods.
Nested objects are also supported.

```php
$objectA = new class {
    private string $propertyA = ' trimmerA ';
    private string $propertyB = ' trimmerB '; // Will NOT be trimmed
    public function getPropertyA(): string { return $this->propertyA; }
    public function setPropertyA(string $value): void { $this->propertyA = $value; }
    public function getPropertyB(): string { return $this->propertyB; }
};

Trimmer::trim($objectA);

// $propertyA will be trimmed, but $propertyB remains unchanged
```

Nested objects are also supported:

```php
$objectB = new class($objectA) {
    private string $propertyC = ' trimmerC ';
    private string $propertyD = ' trimmerD '; // Will NOT be trimmed
    private object $objectA;
    public function __construct(object $objectA) {
        $this->objectA = $objectA;
    }
    public function getPropertyC(): string { return $this->propertyC; }
    public function setPropertyC(string $value): void { $this->propertyC = $value; }
    public function getPropertyD(): string { return $this->propertyD; }
    public function getObjectA(): object { return $this->objectA; }
};

Trimmer::trim($objectB);

// $propertyC and $objectA->propertyA will be trimmed,
// but $propertyD and $objectA->propertyB remain unchanged
```

---

## ⚠️ Notes
- `Trimmer::trim`, `Trimmer::ltrim`, and `Trimmer::rtrim` are **non-destructive**.
They return new values without modifying the originals.
- Object properties without both getter and setter methods cannot be trimmed.

## 📄 License
Trimmer is open-source software released under the [MIT license](LICENSE).
