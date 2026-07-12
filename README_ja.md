# Trimmer

[English](README.md) | [日本語](README_ja.md)

文字列（およびネストした配列の中の文字列）を再帰的にトリムする、小さなユーティリティクラスです。

## モチベーション

PHP 組み込みの `trim()` / `ltrim()` / `rtrim()` は 1 つの文字列にしか使えません。配列（ネストしている場合も含む）の中の文字列を全部トリムしようとすると、自前で再帰処理を書くか `array_map()` を使うことになりますが、後者は配列がネストしていたり文字列以外の値を含んでいたりすると途端に破綻します。

`Trimmer` はこれを代わりにやってくれます。

## インストール

```bash
composer require bvp/trimmer
```

## 使い方

```php
use BVP\Trimmer\Trimmer;

Trimmer::trim('  hello  ');
// 'hello'

Trimmer::trim([' foo ', ' bar ', ['  baz  ', null, 42]]);
// ['foo', 'bar', ['baz', null, 42]]
```

### 提供メソッド

| メソッド | 挙動 |
|---|---|
| `Trimmer::trim($items, $characters = null, $encoding = null, $trimKeys = false)` | 両端をトリム |
| `Trimmer::ltrim(...)` | 左端のみトリム |
| `Trimmer::rtrim(...)` | 右端のみトリム |
| `Trimmer::trimStart(...)` | `ltrim()` のエイリアス |
| `Trimmer::trimEnd(...)` | `rtrim()` のエイリアス |

すべてのメソッドは共通して以下 4 つの引数を受け取ります。

- **`$items`** *(mixed)* — 文字列、配列（何階層ネストしていても可）、またはそれ以外の任意の値。文字列はトリムされ、配列は再帰的に辿られ、それ以外はそのまま返されます。
- **`$characters`** *(?string)* — トリム対象とする文字集合。未指定時はPHP組み込みの `trim()` と同じ標準的な空白文字（`" \t\n\r\0\x0B"`）になります。
- **`$encoding`** *(?string)* — 文字エンコーディング。PHP 8.4 以上の場合のみ有効（後述）。
- **`$trimKeys`** *(bool, デフォルト `false`)* — `true` にすると、配列の文字列キーもトリム対象になります（[配列キーのトリム](#配列キーのトリム)を参照）。

### PHPバージョンによる挙動の違い

- **PHP 8.4 以上**: マルチバイト対応の `mb_trim()` / `mb_ltrim()` / `mb_rtrim()` を使用するため、`$encoding` が反映されます。
- **PHP 8.4 未満**: 組み込みの `trim()` / `ltrim()` / `rtrim()`（バイト単位）にフォールバックします。この場合 `$encoding` は無視されます。

### 配列キーのトリム

デフォルトでは配列の**値**のみがトリム対象で、キーはそのままです。これは素朴な `array_map('trim', $array)` の挙動と揃えています。

`trimKeys: true` を渡すと、文字列キーもトリム対象になります。

```php
Trimmer::trim([' foo ' => ' bar ', 'foo' => 'baz'], trimKeys: true);
// ['foo' => 'baz']
```

**衝突時の注意:** トリムの結果、2 つのキーが同一になった場合（PHP がカノニカルな数値文字列キー、例えば `"8"` を自動的に整数 `8` にキャストする挙動により衝突するケースも含む）、後から代入された値が黙って前の値を上書きします。これは通常の PHP 配列代入（`$array[$key] = $value`）と同じ挙動です。

## 対応していないこと

- オブジェクトのプロパティはトリムしません。オブジェクトはそのまま返されます。各クラスの getter/setter、`readonly` プロパティ、コンストラクタでのバリデーションを個別に把握しない限り安全にトリムできず、汎用的に対応しようとすると不変条件を壊しかねないためです。

## ライセンス

Trimmer は [MIT license](LICENSE) の元で公開されています。
