# Trimmer

[English](README.md) | [日本語](README_ja.md)

[![php](https://poser.pugx.org/bvp/trimmer/require/php)](https://packagist.org/packages/bvp/trimmer)
[![stable](https://poser.pugx.org/bvp/trimmer/v/stable)](https://packagist.org/packages/bvp/trimmer)
[![license](https://poser.pugx.org/bvp/trimmer/license)](https://packagist.org/packages/bvp/trimmer)

[![test](https://github.com/boatracevibeproject/trimmer/actions/workflows/test.yml/badge.svg)](https://github.com/boatracevibeproject/trimmer/actions/workflows/test.yml)
[![psalm](https://github.com/boatracevibeproject/trimmer/actions/workflows/psalm.yml/badge.svg)](https://github.com/boatracevibeproject/trimmer/actions/workflows/psalm.yml)
[![audit](https://github.com/boatracevibeproject/trimmer/actions/workflows/audit.yml/badge.svg)](https://github.com/boatracevibeproject/trimmer/actions/workflows/audit.yml)
[![keepalive](https://github.com/boatracevibeproject/trimmer/actions/workflows/keepalive.yml/badge.svg)](https://github.com/boatracevibeproject/trimmer/actions/workflows/keepalive.yml)
[![dependabot-updates](https://github.com/boatracevibeproject/trimmer/actions/workflows/dependabot/dependabot-updates/badge.svg)](https://github.com/boatracevibeproject/trimmer/actions/workflows/dependabot/dependabot-updates)

A small utility class that recursively trims whitespace (or custom characters) from strings, including strings nested inside arrays of any depth.

## Why

PHP's built-in `trim()` / `ltrim()` / `rtrim()` only operate on a single string. Trimming every string value inside a (possibly nested) array normally means writing your own recursive helper, or reaching for `array_map()` — which breaks as soon as the array contains nested arrays or non-string values.

`Trimmer` handles this for you.

## Installation

```bash
composer require bvp/trimmer
```

## Usage

```php
use BVP\Trimmer\Trimmer;

Trimmer::trim('  hello  ');
// 'hello'

Trimmer::trim([' foo ', ' bar ', ['  baz  ', null, 42]]);
// ['foo', 'bar', ['baz', null, 42]]
```

### Available methods

| Method | Behavior |
|---|---|
| `Trimmer::trim($items, $characters = null, $encoding = null, $trimKeys = false)` | Trims both ends |
| `Trimmer::ltrim(...)` | Trims the left end only |
| `Trimmer::rtrim(...)` | Trims the right end only |
| `Trimmer::trimStart(...)` | Alias for `ltrim()` |
| `Trimmer::trimEnd(...)` | Alias for `rtrim()` |

All methods accept the same four parameters:

- **`$items`** *(mixed)* — a string, an array (nested to any depth), or any other value. Strings are trimmed; arrays are walked recursively; anything else is returned untouched.
- **`$characters`** *(?string)* — the set of characters to trim. Defaults to the standard whitespace characters (`" \t\n\r\0\x0B"`), same as PHP's built-in `trim()`.
- **`$encoding`** *(?string)* — character encoding, only used on PHP ≥ 8.4 (see below).
- **`$trimKeys`** *(bool, default `false`)* — when `true`, string array keys are trimmed as well (see [Trimming array keys](#trimming-array-keys)).

### PHP version behavior

- **PHP ≥ 8.4**: uses the multibyte-aware `mb_trim()` / `mb_ltrim()` / `mb_rtrim()`, so `$encoding` is respected.
- **PHP < 8.4**: falls back to the built-in `trim()` / `ltrim()` / `rtrim()` (byte-based); `$encoding` is ignored.

### Trimming array keys

By default, only array *values* are trimmed — keys are left as-is, matching how a plain `array_map('trim', $array)` would behave.

Pass `trimKeys: true` to also trim string keys:

```php
Trimmer::trim([' foo ' => ' bar ', 'foo' => 'baz'], trimKeys: true);
// ['foo' => 'baz']
```

**Note on collisions:** if trimming causes two keys to become identical (including PHP's automatic casting of a canonical numeric string key like `"8"` to the integer `8`), the later value silently overwrites the earlier one — the same behavior you'd get from a normal PHP array assignment (`$array[$key] = $value`).

## What it does not do

- It does not trim object properties. Objects are returned untouched, since trimming them safely would require knowing each class's getters/setters, `readonly` properties, and constructor validation — which can't be handled generically without risking broken invariants.

## License

Trimmer is open-source software released under the [MIT license](LICENSE).
