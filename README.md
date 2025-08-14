# BVP Trimmer

[English](./README.md) | [日本語](./README_ja.md)

[![tests](https://github.com/shimomo/bvp-trimmer/actions/workflows/tests.yml/badge.svg)](https://github.com/shimomo/bvp-trimmer/actions/workflows/tests.yml)
[![keepalive](https://github.com/shimomo/bvp-trimmer/actions/workflows/keepalive.yml/badge.svg)](https://github.com/shimomo/bvp-trimmer/actions/workflows/keepalive.yml)
[![codecov](https://codecov.io/gh/shimomo/bvp-trimmer/graph/badge.svg?token=27E93D01MN)](https://codecov.io/gh/shimomo/bvp-trimmer)
[![php](https://poser.pugx.org/bvp/trimmer/require/php)](https://packagist.org/packages/bvp/trimmer)
[![stable](https://poser.pugx.org/bvp/trimmer/v/stable)](https://packagist.org/packages/bvp/trimmer)
[![unstable](https://poser.pugx.org/bvp/trimmer/v/unstable)](https://packagist.org/packages/bvp/trimmer#5.x-dev)
[![license](https://poser.pugx.org/bvp/trimmer/license)](https://packagist.org/packages/bvp/trimmer)

The BVP Trimmer package extends PHP's built-in trim, ltrim, and rtrim functions so they can also be used with arrays and objects.

## Features
- Recursively trims all string elements in arrays
- Trims object properties via getter/setter methods
- Supports nested arrays and nested objects
- API is consistent with trim, ltrim, and rtrim

## Installation
```bash
composer require bvp/trimmer
```

## Usage
```php
<?php

require __DIR__ . '/vendor/autoload.php';

use BVP\Trimmer\Trimmer;
```

### For strings
```php
Trimmer::trim(' trimmer ');                // "trimmer"
Trimmer::trim(' @trimmer@ ', "\x20\x40");  // "trimmer"

Trimmer::ltrim(' trimmer ');               // "trimmer "
Trimmer::ltrim(' @trimmer@ ', "\x20\x40"); // "trimmer@ "

Trimmer::rtrim(' trimmer ');               // " trimmer"
Trimmer::rtrim(' @trimmer@ ', "\x20\x40"); // " @trimmer"
```

### For arrays
```php
Trimmer::trim([' trimmerA ']);
// => ["trimmerA"]

Trimmer::trim([' trimmerA ', [' trimmerB ']]);
// => ["trimmerA", ["trimmerB"]]

Trimmer::trim([' trimmerA ', 1, 1.0, true, null]);
// => ["trimmerA", 1, 1.0, true, null]

Trimmer::trim([' trimmerA ', [' trimmerB ', 1, 1.0, true, null]]);
// => ["trimmerA", ["trimmerB", 1, 1.0, true, null]]
```

Examples for `ltrim` and `rtrim` are omitted for brevity, but these functions are fully supported.

### For objects
Trimming object properties requires both getter and setter methods. Nested objects are also supported.

```php
$objectA = new class {
    private string $propertyA = ' trimmerA ';
    private string $propertyB = ' trimmerB '; // This will not be trimmed.
    public function getPropertyA(): string { return $this->propertyA; }
    public function setPropertyA(string $value): void { $this->propertyA = $value; }
    public function getPropertyB(): string { return $this->propertyB; }
};

Trimmer::trim($objectA);
// $propertyA will be trimmed, $propertyB will remain unchanged.
```

Nested objects are supported as well:
```php
$objectB = new class($objectA) {
    private string $propertyC = ' trimmerC ';
    private string $propertyD = ' trimmerD '; // This will not be trimmed.
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
// $propertyC and $objectA->propertyA will be trimmed, $propertyD and $objectA->$propertyB will remain unchanged.
```

Examples for `ltrim` and `rtrim` are omitted for brevity, but these functions are fully supported.

## Notes
All `Trimmer::trim`, `Trimmer::ltrim`, and `Trimmer::rtrim` methods are **non-destructive** (they return new values rather than modifying the original data).

## License
The BVP Trimmer package is open source software licensed under the [MIT license](LICENSE).
