# Trimmer for Boatrace Venture Project

[English](README.md) | [日本語](README_ja.md)

[![keepalive](https://github.com/shimomo/bvp-trimmer/actions/workflows/keepalive.yml/badge.svg)](https://github.com/shimomo/bvp-trimmer/actions/workflows/keepalive.yml)
[![psalm](https://github.com/shimomo/bvp-trimmer/actions/workflows/psalm.yml/badge.svg)](https://github.com/shimomo/bvp-trimmer/actions/workflows/psalm.yml)
[![security](https://github.com/shimomo/bvp-trimmer/actions/workflows/security.yml/badge.svg)](https://github.com/shimomo/bvp-trimmer/actions/workflows/security.yml)
[![test](https://github.com/shimomo/bvp-trimmer/actions/workflows/test.yml/badge.svg)](https://github.com/shimomo/bvp-trimmer/actions/workflows/test.yml)
[![codecov](https://codecov.io/gh/shimomo/bvp-trimmer/graph/badge.svg?token=27E93D01MN)](https://codecov.io/gh/shimomo/bvp-trimmer)
[![php](https://poser.pugx.org/bvp/trimmer/require/php)](https://packagist.org/packages/bvp/trimmer)
[![stable](https://poser.pugx.org/bvp/trimmer/v/stable)](https://packagist.org/packages/bvp/trimmer)
[![license](https://poser.pugx.org/bvp/trimmer/license)](https://packagist.org/packages/bvp/trimmer)

BVP Trimmer は、PHP の組み込み関数 `trim`、`ltrim`、`rtrim` を拡張し、**配列**や**オブジェクト**に対しても再帰的にトリミングを適用できるライブラリです。

## 📦 Requirements

- PHP: ^8.2
- myclabs/deep-copy: ^1.11

## 💾 Installation

```bash
composer require bvp/trimmer
```

## ⚡ Usage

### サポートメソッド一覧

| メソッド | 説明 | 引数 |
|---|---|---|
| `Trimmer::trim(`<br>&nbsp;&nbsp;&nbsp;&nbsp;`$value,`<br>&nbsp;&nbsp;&nbsp;&nbsp;`$characters = null`<br>&nbsp;&nbsp;&nbsp;&nbsp;`$encoding = null`<br>`)` | 文字列・配列・オブジェクトをトリミング | `$value` : string \| array \| object<br>`$characters` : 削除対象の文字列（任意）<br>`$encoding` : 文字エンコーディング（任意、例：'UTF-8'） |
| `Trimmer::ltrim(`<br>&nbsp;&nbsp;&nbsp;&nbsp;`$value,`<br>&nbsp;&nbsp;&nbsp;&nbsp;`$characters = null`<br>&nbsp;&nbsp;&nbsp;&nbsp;`$encoding = null`<br>`)` | 左側のトリミング | 同上 |
| `Trimmer::rtrim(`<br>&nbsp;&nbsp;&nbsp;&nbsp;`$value,`<br>&nbsp;&nbsp;&nbsp;&nbsp;`$characters = null`<br>&nbsp;&nbsp;&nbsp;&nbsp;`$encoding = null`<br>`)` | 右側のトリミング | 同上 |

### 基本的な使い方

```php
<?php

require __DIR__ . '/vendor/autoload.php';

use BVP\Trimmer\Trimmer;

// 文字列をトリミング
echo Trimmer::trim(' trimmer ');                // "trimmer"
echo Trimmer::trim(' @trimmer@ ', "\x20\x40");  // "trimmer"

// 左側のみトリミング
echo Trimmer::ltrim(' trimmer ');               // "trimmer "
echo Trimmer::ltrim(' @trimmer@ ', "\x20\x40"); // "trimmer@ "

// 右側のみトリミング
echo Trimmer::rtrim(' trimmer ');               // " trimmer"
echo Trimmer::rtrim(' @trimmer@ ', "\x20\x40"); // " @trimmer"
```

---

### Trimmer::trim() - 配列のトリミング

```php
$result = Trimmer::trim([' trimmerA ']);
print_r($result);

// 出力結果:
Array
(
    [0] => trimmerA
)
```

```php
$result = Trimmer::trim([' trimmerA ', [' trimmerB ']]);
print_r($result);

// 出力結果:
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

// 出力結果:
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

### Trimmer::trim() - オブジェクトのトリミング

オブジェクトのプロパティをトリミングするには、**getter** と **setter** メソッドが必要です。  
ネストしたオブジェクトもサポートしています。

```php
$objectA = new class {
    private string $propertyA = ' trimmerA ';
    private string $propertyB = ' trimmerB '; // トリミングされない
    public function getPropertyA(): string { return $this->propertyA; }
    public function setPropertyA(string $value): void { $this->propertyA = $value; }
    public function getPropertyB(): string { return $this->propertyB; }
};

Trimmer::trim($objectA);

// $propertyA はトリミングされるが、$propertyB はそのまま
```

ネストしたオブジェクトにも対応しています。

```php
$objectB = new class($objectA) {
    private string $propertyC = ' trimmerC ';
    private string $propertyD = ' trimmerD '; // トリミングされない
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

// $propertyC と $objectA->propertyA はトリミングされるが、$propertyD と $objectA->propertyB はそのまま
```

---

## ⚠️ Notes

- `Trimmer::trim`、`Trimmer::ltrim`、`Trimmer::rtrim` は**非破壊的**です。
  元の値を変更せず、新しい値を返します。
- getter / setter メソッドが存在しないオブジェクトのプロパティはトリミングされません。

## 📄 License

Trimmer は [MIT license](LICENSE) の元で公開されています。
