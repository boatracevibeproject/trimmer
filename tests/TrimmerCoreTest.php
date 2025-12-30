<?php

declare(strict_types=1);

namespace BVP\Trimmer\Tests;

use BVP\Trimmer\TrimmerCore;
use DeepCopy\DeepCopy;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;

/**
 * @author shimomo
 */
final class TrimmerCoreTest extends TestCase
{
    /**
     * @psalm-suppress PropertyNotSetInConstructor
     * @psalm-var \BVP\Trimmer\TrimmerCore
     *
     * @var \BVP\Trimmer\TrimmerCore
     */
    protected TrimmerCore $trimmer;

    /**
     * @psalm-return void
     *
     * @return void
     */
    #[\Override]
    protected function setUp(): void
    {
        $this->trimmer = new TrimmerCore(
            new DeepCopy()
        );
    }

    /**
     * @psalm-param list<mixed> $arguments
     * @psalm-param list<mixed> $expected
     * @psalm-return void
     *
     * @param array $arguments
     * @param array $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'trimArrayProvider')]
    public function testTrimArray(array $arguments, array $expected): void
    {
        $this->assertSame($expected, $this->trimmer->trim($arguments));
    }

    /**
     * @psalm-param bool $arguments
     * @psalm-param bool $expected
     * @psalm-return void
     *
     * @param bool $arguments
     * @param bool $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'trimBoolProvider')]
    public function testTrimBool(bool $arguments, bool $expected): void
    {
        $this->assertSame($expected, $this->trimmer->trim($arguments));
    }

    /**
     * @psalm-param float $arguments
     * @psalm-param float $expected
     * @psalm-return void
     *
     * @param float $arguments
     * @param float $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'trimFloatProvider')]
    public function testTrimFloat(float $arguments, float $expected): void
    {
        $this->assertSame($expected, $this->trimmer->trim($arguments));
    }

    /**
     * @psalm-param int $arguments
     * @psalm-param int $expected
     * @psalm-return void
     *
     * @param int $arguments
     * @param int $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'trimIntProvider')]
    public function testTrimInt(int $arguments, int $expected): void
    {
        $this->assertSame($expected, $this->trimmer->trim($arguments));
    }

    /**
     * @psalm-param null $arguments
     * @psalm-return void
     *
     * @param null $arguments
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'trimNullProvider')]
    public function testTrimNull(null $arguments): void
    {
        $this->assertNull($this->trimmer->trim($arguments));
    }

    /**
     * @psalm-param object $arguments
     * @psalm-param list<non-empty-string> $expected
     * @psalm-return void
     *
     * @param object $arguments
     * @param array $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'trimObjectProvider')]
    public function testTrimObject(object $arguments, array $expected): void
    {
        $objectA = $this->trimmer->trim($arguments);
        if (!is_object($objectA)) {
            return;
        }

        if (!method_exists($objectA, 'getObjectB')) {
            return;
        }

        $objectB = $objectA->getObjectB();
        if (!is_object($objectB)) {
            return;
        }

        if (!method_exists($objectA, 'getPropertyA') || !method_exists($objectA, 'getPropertyB')) {
            return;
        }

        if (!method_exists($objectB, 'getPropertyC') || !method_exists($objectB, 'getPropertyD')) {
            return;
        }

        $this->assertSame($expected, [
            $objectA->getPropertyA(),
            $objectA->getPropertyB(),
            $objectB->getPropertyC(),
            $objectB->getPropertyD(),
        ]);
    }

    /**
     * @psalm-param string $arguments
     * @psalm-param string $expected
     * @psalm-return void
     *
     * @param string $arguments
     * @param string $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'trimStringProvider')]
    public function testTrimString(string $arguments, string $expected): void
    {
        $this->assertSame($expected, $this->trimmer->trim($arguments));
    }

    /**
     * @psalm-param list<mixed> $arguments
     * @psalm-param list<mixed> $expected
     * @psalm-return void
     *
     * @param array $arguments
     * @param array $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'ltrimArrayProvider')]
    public function testLtrimArray(array $arguments, array $expected): void
    {
        $this->assertSame($expected, $this->trimmer->ltrim($arguments));
    }

    /**
     * @psalm-param bool $arguments
     * @psalm-param bool $expected
     * @psalm-return void
     *
     * @param bool $arguments
     * @param bool $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'ltrimBoolProvider')]
    public function testLtrimBool(bool $arguments, bool $expected): void
    {
        $this->assertSame($expected, $this->trimmer->ltrim($arguments));
    }

    /**
     * @psalm-param float $arguments
     * @psalm-param float $expected
     * @psalm-return void
     *
     * @param float $arguments
     * @param float $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'ltrimFloatProvider')]
    public function testLtrimFloat(float $arguments, float $expected): void
    {
        $this->assertSame($expected, $this->trimmer->ltrim($arguments));
    }

    /**
     * @psalm-param int $arguments
     * @psalm-param int $expected
     * @psalm-return void
     *
     * @param int $arguments
     * @param int $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'ltrimIntProvider')]
    public function testLtrimInt(int $arguments, int $expected): void
    {
        $this->assertSame($expected, $this->trimmer->ltrim($arguments));
    }

    /**
     * @psalm-param null $arguments
     * @psalm-return void
     *
     * @param null $arguments
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'ltrimNullProvider')]
    public function testLtrimNull(null $arguments): void
    {
        $this->assertNull($this->trimmer->ltrim($arguments));
    }

    /**
     * @psalm-param object $arguments
     * @psalm-param list<non-empty-string> $expected
     * @psalm-return void
     *
     * @param object $arguments
     * @param array $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'ltrimObjectProvider')]
    public function testLtrimObject(object $arguments, array $expected): void
    {
        $objectA = $this->trimmer->ltrim($arguments);
        if (!is_object($objectA)) {
            return;
        }

        if (!method_exists($objectA, 'getObjectB')) {
            return;
        }

        $objectB = $objectA->getObjectB();
        if (!is_object($objectB)) {
            return;
        }

        if (!method_exists($objectA, 'getPropertyA') || !method_exists($objectA, 'getPropertyB')) {
            return;
        }

        if (!method_exists($objectB, 'getPropertyC') || !method_exists($objectB, 'getPropertyD')) {
            return;
        }

        $this->assertSame($expected, [
            $objectA->getPropertyA(),
            $objectA->getPropertyB(),
            $objectB->getPropertyC(),
            $objectB->getPropertyD(),
        ]);
    }

    /**
     * @psalm-param string $arguments
     * @psalm-param string $expected
     * @psalm-return void
     *
     * @param string $arguments
     * @param string $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'ltrimStringProvider')]
    public function testLtrimString(string $arguments, string $expected): void
    {
        $this->assertSame($expected, $this->trimmer->ltrim($arguments));
    }

    /**
     * @psalm-param list<mixed> $arguments
     * @psalm-param list<mixed> $expected
     * @psalm-return void
     *
     * @param array $arguments
     * @param array $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'rtrimArrayProvider')]
    public function testRtrimArray(array $arguments, array $expected): void
    {
        $this->assertSame($expected, $this->trimmer->rtrim($arguments));
    }

    /**
     * @psalm-param bool $arguments
     * @psalm-param bool $expected
     * @psalm-return void
     *
     * @param bool $arguments
     * @param bool $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'rtrimBoolProvider')]
    public function testRtrimBool(bool $arguments, bool $expected): void
    {
        $this->assertSame($expected, $this->trimmer->rtrim($arguments));
    }

    /**
     * @psalm-param float $arguments
     * @psalm-param float $expected
     * @psalm-return void
     *
     * @param float $arguments
     * @param float $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'rtrimFloatProvider')]
    public function testRtrimFloat(float $arguments, float $expected): void
    {
        $this->assertSame($expected, $this->trimmer->rtrim($arguments));
    }

    /**
     * @psalm-param int $arguments
     * @psalm-param int $expected
     * @psalm-return void
     *
     * @param int $arguments
     * @param int $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'rtrimIntProvider')]
    public function testRtrimInt(int $arguments, int $expected): void
    {
        $this->assertSame($expected, $this->trimmer->rtrim($arguments));
    }

    /**
     * @psalm-param null $arguments
     * @psalm-return void
     *
     * @param null $arguments
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'rtrimNullProvider')]
    public function testRtrimNull(null $arguments): void
    {
        $this->assertNull($this->trimmer->rtrim($arguments));
    }

    /**
     * @psalm-param object $arguments
     * @psalm-param list<non-empty-string> $expected
     * @psalm-return void
     *
     * @param object $arguments
     * @param array $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'rtrimObjectProvider')]
    public function testRtrimObject(object $arguments, array $expected): void
    {
        $objectA = $this->trimmer->rtrim($arguments);
        if (!is_object($objectA)) {
            return;
        }

        if (!method_exists($objectA, 'getObjectB')) {
            return;
        }

        $objectB = $objectA->getObjectB();
        if (!is_object($objectB)) {
            return;
        }

        if (!method_exists($objectA, 'getPropertyA') || !method_exists($objectA, 'getPropertyB')) {
            return;
        }

        if (!method_exists($objectB, 'getPropertyC') || !method_exists($objectB, 'getPropertyD')) {
            return;
        }

        $this->assertSame($expected, [
            $objectA->getPropertyA(),
            $objectA->getPropertyB(),
            $objectB->getPropertyC(),
            $objectB->getPropertyD(),
        ]);
    }

    /**
     * @psalm-param string $arguments
     * @psalm-param string $expected
     * @psalm-return void
     *
     * @param string $arguments
     * @param string $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'rtrimStringProvider')]
    public function testRtrimString(string $arguments, string $expected): void
    {
        $this->assertSame($expected, $this->trimmer->rtrim($arguments));
    }

    /**
     * @psalm-param list<mixed> $arguments
     * @psalm-param list<mixed> $expected
     * @psalm-return void
     *
     * @param array $arguments
     * @param array $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'ltrimArrayProvider')]
    public function testTrimStartArray(array $arguments, array $expected): void
    {
        $this->assertSame($expected, $this->trimmer->trimStart($arguments));
    }

    /**
     * @psalm-param bool $arguments
     * @psalm-param bool $expected
     * @psalm-return void
     *
     * @param bool $arguments
     * @param bool $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'ltrimBoolProvider')]
    public function testTrimStartBool(bool $arguments, bool $expected): void
    {
        $this->assertSame($expected, $this->trimmer->trimStart($arguments));
    }

    /**
     * @psalm-param float $arguments
     * @psalm-param float $expected
     * @psalm-return void
     *
     * @param float $arguments
     * @param float $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'ltrimFloatProvider')]
    public function testTrimStartFloat(float $arguments, float $expected): void
    {
        $this->assertSame($expected, $this->trimmer->trimStart($arguments));
    }

    /**
     * @psalm-param int $arguments
     * @psalm-param int $expected
     * @psalm-return void
     *
     * @param int $arguments
     * @param int $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'ltrimIntProvider')]
    public function testTrimStartInt(int $arguments, int $expected): void
    {
        $this->assertSame($expected, $this->trimmer->trimStart($arguments));
    }

    /**
     * @psalm-param null $arguments
     * @psalm-return void
     *
     * @param null $arguments
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'ltrimNullProvider')]
    public function testTrimStartNull(null $arguments): void
    {
        $this->assertNull($this->trimmer->trimStart($arguments));
    }

    /**
     * @psalm-param object $arguments
     * @psalm-param list<non-empty-string> $expected
     * @psalm-return void
     *
     * @param object $arguments
     * @param array $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'ltrimObjectProvider')]
    public function testTrimStartObject(object $arguments, array $expected): void
    {
        $objectA = $this->trimmer->trimStart($arguments);
        if (!is_object($objectA)) {
            return;
        }

        if (!method_exists($objectA, 'getObjectB')) {
            return;
        }

        $objectB = $objectA->getObjectB();
        if (!is_object($objectB)) {
            return;
        }

        if (!method_exists($objectA, 'getPropertyA') || !method_exists($objectA, 'getPropertyB')) {
            return;
        }

        if (!method_exists($objectB, 'getPropertyC') || !method_exists($objectB, 'getPropertyD')) {
            return;
        }

        $this->assertSame($expected, [
            $objectA->getPropertyA(),
            $objectA->getPropertyB(),
            $objectB->getPropertyC(),
            $objectB->getPropertyD(),
        ]);
    }

    /**
     * @psalm-param string $arguments
     * @psalm-param string $expected
     * @psalm-return void
     *
     * @param string $arguments
     * @param string $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'ltrimStringProvider')]
    public function testTrimStartString(string $arguments, string $expected): void
    {
        $this->assertSame($expected, $this->trimmer->trimStart($arguments));
    }

    /**
     * @psalm-param list<mixed> $arguments
     * @psalm-param list<mixed> $expected
     * @psalm-return void
     *
     * @param array $arguments
     * @param array $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'rtrimArrayProvider')]
    public function testTrimEndArray(array $arguments, array $expected): void
    {
        $this->assertSame($expected, $this->trimmer->trimEnd($arguments));
    }

    /**
     * @psalm-param bool $arguments
     * @psalm-param bool $expected
     * @psalm-return void
     *
     * @param bool $arguments
     * @param bool $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'rtrimBoolProvider')]
    public function testTrimEndBool(bool $arguments, bool $expected): void
    {
        $this->assertSame($expected, $this->trimmer->trimEnd($arguments));
    }

    /**
     * @psalm-param float $arguments
     * @psalm-param float $expected
     * @psalm-return void
     *
     * @param  float  $arguments
     * @param  float  $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'rtrimFloatProvider')]
    public function testTrimEndFloat(float $arguments, float $expected): void
    {
        $this->assertSame($expected, $this->trimmer->trimEnd($arguments));
    }

    /**
     * @psalm-param int $arguments
     * @psalm-param int $expected
     * @psalm-return void
     *
     * @param int $arguments
     * @param int $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'rtrimIntProvider')]
    public function testTrimEndInt(int $arguments, int $expected): void
    {
        $this->assertSame($expected, $this->trimmer->trimEnd($arguments));
    }

    /**
     * @psalm-param null $arguments
     * @psalm-return void
     *
     * @param null $arguments
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'rtrimNullProvider')]
    public function testTrimEndNull(null $arguments): void
    {
        $this->assertNull($this->trimmer->trimEnd($arguments));
    }

    /**
     * @psalm-param object $arguments
     * @psalm-param list<non-empty-string> $expected
     * @psalm-return void
     *
     * @param object $arguments
     * @param array $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'rtrimObjectProvider')]
    public function testTrimEndObject(object $arguments, array $expected): void
    {
        $objectA = $this->trimmer->trimEnd($arguments);
        if (!is_object($objectA)) {
            return;
        }

        if (!method_exists($objectA, 'getObjectB')) {
            return;
        }

        $objectB = $objectA->getObjectB();
        if (!is_object($objectB)) {
            return;
        }

        if (!method_exists($objectA, 'getPropertyA') || !method_exists($objectA, 'getPropertyB')) {
            return;
        }

        if (!method_exists($objectB, 'getPropertyC') || !method_exists($objectB, 'getPropertyD')) {
            return;
        }

        $this->assertSame($expected, [
            $objectA->getPropertyA(),
            $objectA->getPropertyB(),
            $objectB->getPropertyC(),
            $objectB->getPropertyD(),
        ]);
    }

    /**
     * @psalm-param string $arguments
     * @psalm-param string $expected
     * @psalm-return void
     *
     * @param string $arguments
     * @param string $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'rtrimStringProvider')]
    public function testTrimEndString(string $arguments, string $expected): void
    {
        $this->assertSame($expected, $this->trimmer->trimEnd($arguments));
    }

    /**
     * @psalm-return void
     *
     * @return void
     */
    public function testThrowsExceptionWhenMethodDoesNotExist(): void
    {
        $this->expectException(\BadMethodCallException::class);
        $this->expectExceptionMessage(
            "BVP\Trimmer\TrimmerCore::__call() - " .
            "Call to undefined method `BVP\Trimmer\TrimmerCore::ghost()`."
        );

        /** @psalm-suppress UndefinedMagicMethod */
        $this->trimmer->ghost();
    }
}
