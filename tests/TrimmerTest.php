<?php

declare(strict_types=1);

namespace BVP\Trimmer\Tests;

use BVP\Trimmer\Trimmer;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @author shimomo
 */
final class TrimmerTest extends TestCase
{
    /**
     * @param list<mixed> $items
     * @param list<mixed> $expected
     * @return void
     */
    #[Test]
    #[DataProviderExternal(TrimmerDataProvider::class, 'trimArrayProvider')]
    public function testTrimArray(array $items, array $expected): void
    {
        $this->assertSame($expected, Trimmer::trim($items));
    }

    /**
     * @param bool $items
     * @param bool $expected
     * @return void
     */
    #[Test]
    #[DataProviderExternal(TrimmerDataProvider::class, 'trimBoolProvider')]
    public function testTrimBool(bool $items, bool $expected): void
    {
        $this->assertSame($expected, Trimmer::trim($items));
    }

    /**
     * @param float $items
     * @param float $expected
     * @return void
     */
    #[Test]
    #[DataProviderExternal(TrimmerDataProvider::class, 'trimFloatProvider')]
    public function testTrimFloat(float $items, float $expected): void
    {
        $this->assertSame($expected, Trimmer::trim($items));
    }

    /**
     * @param int $items
     * @param int $expected
     * @return void
     */
    #[Test]
    #[DataProviderExternal(TrimmerDataProvider::class, 'trimIntProvider')]
    public function testTrimInt(int $items, int $expected): void
    {
        $this->assertSame($expected, Trimmer::trim($items));
    }

    /**
     * @param null $items
     * @return void
     */
    #[Test]
    #[DataProviderExternal(TrimmerDataProvider::class, 'trimNullProvider')]
    public function testTrimNull(null $items): void
    {
        $this->assertNull(Trimmer::trim($items));
    }

    /**
     * @param string $items
     * @param string $expected
     * @return void
     */
    #[Test]
    #[DataProviderExternal(TrimmerDataProvider::class, 'trimStringProvider')]
    public function testTrimString(string $items, string $expected): void
    {
        $this->assertSame($expected, Trimmer::trim($items));
    }

    /**
     * @param object $items
     * @return void
     */
    #[Test]
    #[DataProviderExternal(TrimmerDataProvider::class, 'trimObjectProvider')]
    public function testTrimObject(object $items): void
    {
        $this->assertSame($items, Trimmer::trim($items));
    }

    /**
     * @param string $items
     * @param non-empty-string $characters
     * @param string $expected
     * @return void
     */
    #[Test]
    #[DataProviderExternal(TrimmerDataProvider::class, 'trimCharactersProvider')]
    public function testTrimCharacters(string $items, string $characters, string $expected): void
    {
        $this->assertSame($expected, Trimmer::trim($items, $characters));
    }

    /**
     * @param array<array-key, mixed> $items
     * @param bool $trimKeys
     * @param array<array-key, mixed> $expected
     * @return void
     */
    #[Test]
    #[DataProviderExternal(TrimmerDataProvider::class, 'trimKeysProvider')]
    public function testTrimKeys(array $items, bool $trimKeys, array $expected): void
    {
        $this->assertSame($expected, Trimmer::trim($items, trimKeys: $trimKeys));
    }

    /**
     * @param list<mixed> $items
     * @param list<mixed> $expected
     * @return void
     */
    #[Test]
    #[DataProviderExternal(TrimmerDataProvider::class, 'ltrimArrayProvider')]
    public function testLtrimArray(array $items, array $expected): void
    {
        $this->assertSame($expected, Trimmer::ltrim($items));
    }

    /**
     * @param bool $items
     * @param bool $expected
     * @return void
     */
    #[Test]
    #[DataProviderExternal(TrimmerDataProvider::class, 'ltrimBoolProvider')]
    public function testLtrimBool(bool $items, bool $expected): void
    {
        $this->assertSame($expected, Trimmer::ltrim($items));
    }

    /**
     * @param float $items
     * @param float $expected
     * @return void
     */
    #[Test]
    #[DataProviderExternal(TrimmerDataProvider::class, 'ltrimFloatProvider')]
    public function testLtrimFloat(float $items, float $expected): void
    {
        $this->assertSame($expected, Trimmer::ltrim($items));
    }

    /**
     * @param int $items
     * @param int $expected
     * @return void
     */
    #[Test]
    #[DataProviderExternal(TrimmerDataProvider::class, 'ltrimIntProvider')]
    public function testLtrimInt(int $items, int $expected): void
    {
        $this->assertSame($expected, Trimmer::ltrim($items));
    }

    /**
     * @param null $items
     * @return void
     */
    #[Test]
    #[DataProviderExternal(TrimmerDataProvider::class, 'ltrimNullProvider')]
    public function testLtrimNull(null $items): void
    {
        $this->assertNull(Trimmer::ltrim($items));
    }

    /**
     * @param string $items
     * @param string $expected
     * @return void
     */
    #[Test]
    #[DataProviderExternal(TrimmerDataProvider::class, 'ltrimStringProvider')]
    public function testLtrimString(string $items, string $expected): void
    {
        $this->assertSame($expected, Trimmer::ltrim($items));
    }

    /**
     * @param object $items
     * @return void
     */
    #[Test]
    #[DataProviderExternal(TrimmerDataProvider::class, 'ltrimObjectProvider')]
    public function testLtrimObject(object $items): void
    {
        $this->assertSame($items, Trimmer::ltrim($items));
    }

    /**
     * @param string $items
     * @param non-empty-string $characters
     * @param string $expected
     * @return void
     */
    #[Test]
    #[DataProviderExternal(TrimmerDataProvider::class, 'ltrimCharactersProvider')]
    public function testLtrimCharacters(string $items, string $characters, string $expected): void
    {
        $this->assertSame($expected, Trimmer::ltrim($items, $characters));
    }

    /**
     * @param array<array-key, mixed> $items
     * @param bool $trimKeys
     * @param array<array-key, mixed> $expected
     * @return void
     */
    #[Test]
    #[DataProviderExternal(TrimmerDataProvider::class, 'ltrimKeysProvider')]
    public function testLtrimKeys(array $items, bool $trimKeys, array $expected): void
    {
        $this->assertSame($expected, Trimmer::ltrim($items, trimKeys: $trimKeys));
    }

    /**
     * @param list<mixed> $items
     * @param list<mixed> $expected
     * @return void
     */
    #[Test]
    #[DataProviderExternal(TrimmerDataProvider::class, 'rtrimArrayProvider')]
    public function testRtrimArray(array $items, array $expected): void
    {
        $this->assertSame($expected, Trimmer::rtrim($items));
    }

    /**
     * @param bool $items
     * @param bool $expected
     * @return void
     */
    #[Test]
    #[DataProviderExternal(TrimmerDataProvider::class, 'rtrimBoolProvider')]
    public function testRtrimBool(bool $items, bool $expected): void
    {
        $this->assertSame($expected, Trimmer::rtrim($items));
    }

    /**
     * @param float $items
     * @param float $expected
     * @return void
     */
    #[Test]
    #[DataProviderExternal(TrimmerDataProvider::class, 'rtrimFloatProvider')]
    public function testRtrimFloat(float $items, float $expected): void
    {
        $this->assertSame($expected, Trimmer::rtrim($items));
    }

    /**
     * @param int $items
     * @param int $expected
     * @return void
     */
    #[Test]
    #[DataProviderExternal(TrimmerDataProvider::class, 'rtrimIntProvider')]
    public function testRtrimInt(int $items, int $expected): void
    {
        $this->assertSame($expected, Trimmer::rtrim($items));
    }

    /**
     * @param null $items
     * @return void
     */
    #[Test]
    #[DataProviderExternal(TrimmerDataProvider::class, 'rtrimNullProvider')]
    public function testRtrimNull(null $items): void
    {
        $this->assertNull(Trimmer::rtrim($items));
    }

    /**
     * @param string $items
     * @param string $expected
     * @return void
     */
    #[Test]
    #[DataProviderExternal(TrimmerDataProvider::class, 'rtrimStringProvider')]
    public function testRtrimString(string $items, string $expected): void
    {
        $this->assertSame($expected, Trimmer::rtrim($items));
    }

    /**
     * @param object $items
     * @return void
     */
    #[Test]
    #[DataProviderExternal(TrimmerDataProvider::class, 'rtrimObjectProvider')]
    public function testRtrimObject(object $items): void
    {
        $this->assertSame($items, Trimmer::rtrim($items));
    }

    /**
     * @param string $items
     * @param non-empty-string $characters
     * @param string $expected
     * @return void
     */
    #[Test]
    #[DataProviderExternal(TrimmerDataProvider::class, 'rtrimCharactersProvider')]
    public function testRtrimCharacters(string $items, string $characters, string $expected): void
    {
        $this->assertSame($expected, Trimmer::rtrim($items, $characters));
    }

    /**
     * @param array<array-key, mixed> $items
     * @param bool $trimKeys
     * @param array<array-key, mixed> $expected
     * @return void
     */
    #[Test]
    #[DataProviderExternal(TrimmerDataProvider::class, 'rtrimKeysProvider')]
    public function testRtrimKeys(array $items, bool $trimKeys, array $expected): void
    {
        $this->assertSame($expected, Trimmer::rtrim($items, trimKeys: $trimKeys));
    }

    /**
     * @param list<mixed> $items
     * @param list<mixed> $expected
     * @return void
     */
    #[Test]
    #[DataProviderExternal(TrimmerDataProvider::class, 'ltrimArrayProvider')]
    public function testTrimStartArray(array $items, array $expected): void
    {
        $this->assertSame($expected, Trimmer::trimStart($items));
    }

    /**
     * @param bool $items
     * @param bool $expected
     * @return void
     */
    #[Test]
    #[DataProviderExternal(TrimmerDataProvider::class, 'ltrimBoolProvider')]
    public function testTrimStartBool(bool $items, bool $expected): void
    {
        $this->assertSame($expected, Trimmer::trimStart($items));
    }

    /**
     * @param float $items
     * @param float $expected
     * @return void
     */
    #[Test]
    #[DataProviderExternal(TrimmerDataProvider::class, 'ltrimFloatProvider')]
    public function testTrimStartFloat(float $items, float $expected): void
    {
        $this->assertSame($expected, Trimmer::trimStart($items));
    }

    /**
     * @param int $items
     * @param int $expected
     * @return void
     */
    #[Test]
    #[DataProviderExternal(TrimmerDataProvider::class, 'ltrimIntProvider')]
    public function testTrimStartInt(int $items, int $expected): void
    {
        $this->assertSame($expected, Trimmer::trimStart($items));
    }

    /**
     * @param null $items
     * @return void
     */
    #[Test]
    #[DataProviderExternal(TrimmerDataProvider::class, 'ltrimNullProvider')]
    public function testTrimStartNull(null $items): void
    {
        $this->assertNull(Trimmer::trimStart($items));
    }

    /**
     * @param string $items
     * @param string $expected
     * @return void
     */
    #[Test]
    #[DataProviderExternal(TrimmerDataProvider::class, 'ltrimStringProvider')]
    public function testTrimStartString(string $items, string $expected): void
    {
        $this->assertSame($expected, Trimmer::trimStart($items));
    }

    /**
     * @param object $items
     * @return void
     */
    #[Test]
    #[DataProviderExternal(TrimmerDataProvider::class, 'ltrimObjectProvider')]
    public function testTrimStartObject(object $items): void
    {
        $this->assertSame($items, Trimmer::trimStart($items));
    }

    /**
     * @param array<array-key, mixed> $items
     * @param bool $trimKeys
     * @param array<array-key, mixed> $expected
     * @return void
     */
    #[Test]
    #[DataProviderExternal(TrimmerDataProvider::class, 'ltrimKeysProvider')]
    public function testTrimStartKeys(array $items, bool $trimKeys, array $expected): void
    {
        $this->assertSame($expected, Trimmer::trimStart($items, trimKeys: $trimKeys));
    }

    /**
     * @param list<mixed> $items
     * @param list<mixed> $expected
     * @return void
     */
    #[Test]
    #[DataProviderExternal(TrimmerDataProvider::class, 'rtrimArrayProvider')]
    public function testTrimEndArray(array $items, array $expected): void
    {
        $this->assertSame($expected, Trimmer::trimEnd($items));
    }

    /**
     * @param bool $items
     * @param bool $expected
     * @return void
     */
    #[Test]
    #[DataProviderExternal(TrimmerDataProvider::class, 'rtrimBoolProvider')]
    public function testTrimEndBool(bool $items, bool $expected): void
    {
        $this->assertSame($expected, Trimmer::trimEnd($items));
    }

    /**
     * @param float $items
     * @param float $expected
     * @return void
     */
    #[Test]
    #[DataProviderExternal(TrimmerDataProvider::class, 'rtrimFloatProvider')]
    public function testTrimEndFloat(float $items, float $expected): void
    {
        $this->assertSame($expected, Trimmer::trimEnd($items));
    }

    /**
     * @param int $items
     * @param int $expected
     * @return void
     */
    #[Test]
    #[DataProviderExternal(TrimmerDataProvider::class, 'rtrimIntProvider')]
    public function testTrimEndInt(int $items, int $expected): void
    {
        $this->assertSame($expected, Trimmer::trimEnd($items));
    }

    /**
     * @param null $items
     * @return void
     */
    #[Test]
    #[DataProviderExternal(TrimmerDataProvider::class, 'rtrimNullProvider')]
    public function testTrimEndNull(null $items): void
    {
        $this->assertNull(Trimmer::trimEnd($items));
    }

    /**
     * @param string $items
     * @param string $expected
     * @return void
     */
    #[Test]
    #[DataProviderExternal(TrimmerDataProvider::class, 'rtrimStringProvider')]
    public function testTrimEndString(string $items, string $expected): void
    {
        $this->assertSame($expected, Trimmer::trimEnd($items));
    }

    /**
     * @param object $items
     * @return void
     */
    #[Test]
    #[DataProviderExternal(TrimmerDataProvider::class, 'rtrimObjectProvider')]
    public function testTrimEndObject(object $items): void
    {
        $this->assertSame($items, Trimmer::trimEnd($items));
    }

    /**
     * @param array<array-key, mixed> $items
     * @param bool $trimKeys
     * @param array<array-key, mixed> $expected
     * @return void
     */
    #[Test]
    #[DataProviderExternal(TrimmerDataProvider::class, 'rtrimKeysProvider')]
    public function testTrimEndKeys(array $items, bool $trimKeys, array $expected): void
    {
        $this->assertSame($expected, Trimmer::trimEnd($items, trimKeys: $trimKeys));
    }
}
