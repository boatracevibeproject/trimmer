<?php

declare(strict_types=1);

namespace BVP\Trimmer\Tests;

use BVP\Trimmer\Trimmer;
use BVP\Trimmer\TrimmerCoreInterface;
use BVP\Trimmer\TrimmerInterface;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;

/**
 * @author shimomo
 */
final class TrimmerTest extends TestCase
{
    /**
     * @psalm-param array<int, mixed> $input
     * @psalm-param array<int, mixed> $expected
     * @psalm-return void
     *
     * @param array $input
     * @param array $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'trimArrayProvider')]
    public function testTrimArray(array $input, array $expected): void
    {
        $this->assertSame($expected, Trimmer::trim($input));
    }

    /**
     * @psalm-param bool $input
     * @psalm-param bool $expected
     * @psalm-return void
     *
     * @param bool $input
     * @param bool $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'trimBoolProvider')]
    public function testTrimBool(bool $input, bool $expected): void
    {
        $this->assertSame($expected, Trimmer::trim($input));
    }

    /**
     * @psalm-param float $input
     * @psalm-param float $expected
     * @psalm-return void
     *
     * @param float $input
     * @param float $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'trimFloatProvider')]
    public function testTrimFloat(float $input, float $expected): void
    {
        $this->assertSame($expected, Trimmer::trim($input));
    }

    /**
     * @psalm-param int $input
     * @psalm-param int $expected
     * @psalm-return void
     *
     * @param int $input
     * @param int $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'trimIntProvider')]
    public function testTrimInt(int $input, int $expected): void
    {
        $this->assertSame($expected, Trimmer::trim($input));
    }

    /**
     * @psalm-param null $input
     * @psalm-return void
     *
     * @param null $input
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'trimNullProvider')]
    public function testTrimNull(null $input): void
    {
        $this->assertNull(Trimmer::trim($input));
    }

    /**
     * @psalm-param object $input
     * @psalm-param array<int, string> $expected
     * @psalm-return void
     *
     * @param object $input
     * @param array $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'trimObjectProvider')]
    public function testTrimObject(object $input, array $expected): void
    {
        $actual = Trimmer::trim($input);
        $this->assertSame($expected, [
            $actual->getPropertyA(),
            $actual->getPropertyB(),
            $actual->getObjectB()->getPropertyC(),
            $actual->getObjectB()->getPropertyD(),
        ]);
    }

    /**
     * @psalm-param string $input
     * @psalm-param string $expected
     * @psalm-return void
     *
     * @param string $input
     * @param string $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'trimStringProvider')]
    public function testTrimString(string $input, string $expected): void
    {
        $this->assertSame($expected, Trimmer::trim($input));
    }

    /**
     * @psalm-param array<int, mixed> $input
     * @psalm-param array<int, mixed> $expected
     * @psalm-return void
     *
     * @param array $input
     * @param array $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'ltrimArrayProvider')]
    public function testLtrimArray(array $input, array $expected): void
    {
        $this->assertSame($expected, Trimmer::ltrim($input));
    }

    /**
     * @psalm-param bool $input
     * @psalm-param bool $expected
     * @psalm-return void
     *
     * @param bool $input
     * @param bool $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'ltrimBoolProvider')]
    public function testLtrimBool(bool $input, bool $expected): void
    {
        $this->assertSame($expected, Trimmer::ltrim($input));
    }

    /**
     * @psalm-param float $input
     * @psalm-param float $expected
     * @psalm-return void
     *
     * @param float $input
     * @param float $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'ltrimFloatProvider')]
    public function testLtrimFloat(float $input, float $expected): void
    {
        $this->assertSame($expected, Trimmer::ltrim($input));
    }

    /**
     * @psalm-param int $input
     * @psalm-param int $expected
     * @psalm-return void
     *
     * @param int $input
     * @param int $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'ltrimIntProvider')]
    public function testLtrimInt(int $input, int $expected): void
    {
        $this->assertSame($expected, Trimmer::ltrim($input));
    }

    /**
     * @psalm-param null $input
     * @psalm-return void
     *
     * @param null $input
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'ltrimNullProvider')]
    public function testLtrimNull(null $input): void
    {
        $this->assertNull(Trimmer::ltrim($input));
    }

    /**
     * @psalm-param object $input
     * @psalm-param array<int, string> $expected
     * @psalm-return void
     *
     * @param object $input
     * @param array $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'ltrimObjectProvider')]
    public function testLtrimObject(object $input, array $expected): void
    {
        $actual = Trimmer::ltrim($input);
        $this->assertSame($expected, [
            $actual->getPropertyA(),
            $actual->getPropertyB(),
            $actual->getObjectB()->getPropertyC(),
            $actual->getObjectB()->getPropertyD(),
        ]);
    }

    /**
     * @psalm-param string $input
     * @psalm-param string $expected
     * @psalm-return void
     *
     * @param string $input
     * @param string $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'ltrimStringProvider')]
    public function testLtrimString(string $input, string $expected): void
    {
        $this->assertSame($expected, Trimmer::ltrim($input));
    }

    /**
     * @psalm-param array<int, mixed> $input
     * @psalm-param array<int, mixed> $expected
     * @psalm-return void
     *
     * @param array $input
     * @param array $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'rtrimArrayProvider')]
    public function testRtrimArray(array $input, array $expected): void
    {
        $this->assertSame($expected, Trimmer::rtrim($input));
    }

    /**
     * @psalm-param bool $input
     * @psalm-param bool $expected
     * @psalm-return void
     *
     * @param bool $input
     * @param bool $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'rtrimBoolProvider')]
    public function testRtrimBool(bool $input, bool $expected): void
    {
        $this->assertSame($expected, Trimmer::rtrim($input));
    }

    /**
     * @psalm-param float $input
     * @psalm-param float $expected
     * @psalm-return void
     *
     * @param  float  $input
     * @param  float  $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'rtrimFloatProvider')]
    public function testRtrimFloat(float $input, float $expected): void
    {
        $this->assertSame($expected, Trimmer::rtrim($input));
    }

    /**
     * @psalm-param int $input
     * @psalm-param int $expected
     * @psalm-return void
     *
     * @param int $input
     * @param int $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'rtrimIntProvider')]
    public function testRtrimInt(int $input, int $expected): void
    {
        $this->assertSame($expected, Trimmer::rtrim($input));
    }

    /**
     * @psalm-param null $input
     * @psalm-return void
     *
     * @param null $input
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'rtrimNullProvider')]
    public function testRtrimNull(null $input): void
    {
        $this->assertNull(Trimmer::rtrim($input));
    }

    /**
     * @psalm-param object $input
     * @psalm-param array<int, string> $expected
     * @psalm-return void
     *
     * @param object $input
     * @param array $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'rtrimObjectProvider')]
    public function testRtrimObject(object $input, array $expected): void
    {
        $actual = Trimmer::rtrim($input);
        $this->assertSame($expected, [
            $actual->getPropertyA(),
            $actual->getPropertyB(),
            $actual->getObjectB()->getPropertyC(),
            $actual->getObjectB()->getPropertyD(),
        ]);
    }

    /**
     * @psalm-param string $input
     * @psalm-param string $expected
     * @psalm-return void
     *
     * @param string $input
     * @param string $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'rtrimStringProvider')]
    public function testRtrimString(string $input, string $expected): void
    {
        $this->assertSame($expected, Trimmer::rtrim($input));
    }

    /**
     * @psalm-param array<int, mixed> $input
     * @psalm-param array<int, mixed> $expected
     * @psalm-return void
     *
     * @param array $input
     * @param array $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'ltrimArrayProvider')]
    public function testTrimStartArray(array $input, array $expected): void
    {
        $this->assertSame($expected, Trimmer::trimStart($input));
    }

    /**
     * @psalm-param bool $input
     * @psalm-param bool $expected
     * @psalm-return void
     *
     * @param bool $input
     * @param bool $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'ltrimBoolProvider')]
    public function testTrimStartBool(bool $input, bool $expected): void
    {
        $this->assertSame($expected, Trimmer::trimStart($input));
    }

    /**
     * @psalm-param float $input
     * @psalm-param float $expected
     * @psalm-return void
     *
     * @param float $input
     * @param float $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'ltrimFloatProvider')]
    public function testTrimStartFloat(float $input, float $expected): void
    {
        $this->assertSame($expected, Trimmer::trimStart($input));
    }

    /**
     * @psalm-param int $input
     * @psalm-param int $expected
     * @psalm-return void
     *
     * @param int $input
     * @param int $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'ltrimIntProvider')]
    public function testTrimStartInt(int $input, int $expected): void
    {
        $this->assertSame($expected, Trimmer::trimStart($input));
    }

    /**
     * @psalm-param null $input
     * @psalm-return void
     *
     * @param null $input
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'ltrimNullProvider')]
    public function testTrimStartNull(null $input): void
    {
        $this->assertNull(Trimmer::trimStart($input));
    }

    /**
     * @psalm-param object $input
     * @psalm-param array<int, string> $expected
     * @psalm-return void
     *
     * @param object $input
     * @param array $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'ltrimObjectProvider')]
    public function testTrimStartObject(object $input, array $expected): void
    {
        $actual = Trimmer::trimStart($input);
        $this->assertSame($expected, [
            $actual->getPropertyA(),
            $actual->getPropertyB(),
            $actual->getObjectB()->getPropertyC(),
            $actual->getObjectB()->getPropertyD(),
        ]);
    }

    /**
     * @psalm-param string $input
     * @psalm-param string $expected
     * @psalm-return void
     *
     * @param string $input
     * @param string $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'ltrimStringProvider')]
    public function testTrimStartString(string $input, string $expected): void
    {
        $this->assertSame($expected, Trimmer::trimStart($input));
    }

    /**
     * @psalm-param array<int, mixed> $input
     * @psalm-param array<int, mixed> $expected
     * @psalm-return void
     *
     * @param array $input
     * @param array $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'rtrimArrayProvider')]
    public function testTrimEndArray(array $input, array $expected): void
    {
        $this->assertSame($expected, Trimmer::trimEnd($input));
    }

    /**
     * @psalm-param bool $input
     * @psalm-param bool $expected
     * @psalm-return void
     *
     * @param bool $input
     * @param bool $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'rtrimBoolProvider')]
    public function testTrimEndBool(bool $input, bool $expected): void
    {
        $this->assertSame($expected, Trimmer::trimEnd($input));
    }

    /**
     * @psalm-param float $input
     * @psalm-param float $expected
     * @psalm-return void
     *
     * @param  float  $input
     * @param  float  $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'rtrimFloatProvider')]
    public function testTrimEndFloat(float $input, float $expected): void
    {
        $this->assertSame($expected, Trimmer::trimEnd($input));
    }

    /**
     * @psalm-param int $input
     * @psalm-param int $expected
     * @psalm-return void
     *
     * @param int $input
     * @param int $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'rtrimIntProvider')]
    public function testTrimEndInt(int $input, int $expected): void
    {
        $this->assertSame($expected, Trimmer::trimEnd($input));
    }

    /**
     * @psalm-param null $input
     * @psalm-return void
     *
     * @param null $input
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'rtrimNullProvider')]
    public function testTrimEndNull(null $input): void
    {
        $this->assertNull(Trimmer::trimEnd($input));
    }

    /**
     * @psalm-param object $input
     * @psalm-param array<int, string> $expected
     * @psalm-return void
     *
     * @param object $input
     * @param array $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'rtrimObjectProvider')]
    public function testTrimEndObject(object $input, array $expected): void
    {
        $actual = Trimmer::trimEnd($input);
        $this->assertSame($expected, [
            $actual->getPropertyA(),
            $actual->getPropertyB(),
            $actual->getObjectB()->getPropertyC(),
            $actual->getObjectB()->getPropertyD(),
        ]);
    }

    /**
     * @psalm-param string $input
     * @psalm-param string $expected
     * @psalm-return void
     *
     * @param string $input
     * @param string $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'rtrimStringProvider')]
    public function testTrimEndString(string $input, string $expected): void
    {
        $this->assertSame($expected, Trimmer::trimEnd($input));
    }

    /**
     * @return void
     */
    public function testGetInstance(): void
    {
        Trimmer::resetInstance();
        $this->assertInstanceOf(TrimmerInterface::class, Trimmer::getInstance());
    }

    /**
     * @return void
     */
    public function testGetInstanceWithMockInput(): void
    {
        Trimmer::resetInstance();
        $mock = $this->createMock(TrimmerCoreInterface::class);
        $mock->method('trim')->willReturn(' exampleA ');
        $mock->method('ltrim')->willReturn(' exampleB ');
        $mock->method('rtrim')->willReturn(' exampleC ');
        $trimmer = Trimmer::getInstance($mock);
        $this->assertInstanceOf(TrimmerInterface::class, $trimmer);
        $this->assertSame(' exampleA ', $trimmer::trim(' exampleA '));
        $this->assertSame(' exampleB ', $trimmer::ltrim(' exampleB '));
        $this->assertSame(' exampleC ', $trimmer::rtrim(' exampleC '));
    }

    /**
     * @return void
     */
    public function testCreateInstance(): void
    {
        Trimmer::resetInstance();
        $this->assertInstanceOf(TrimmerInterface::class, Trimmer::createInstance());
    }

    /**
     * @return void
     */
    public function testCreateInstanceWithMockInput(): void
    {
        Trimmer::resetInstance();
        $mock = $this->createMock(TrimmerCoreInterface::class);
        $mock->method('trim')->willReturn(' exampleA ');
        $mock->method('ltrim')->willReturn(' exampleB ');
        $mock->method('rtrim')->willReturn(' exampleC ');
        $trimmer = Trimmer::createInstance($mock);
        $this->assertInstanceOf(TrimmerInterface::class, $trimmer);
        $this->assertSame(' exampleA ', $trimmer::trim(' exampleA '));
        $this->assertSame(' exampleB ', $trimmer::ltrim(' exampleB '));
        $this->assertSame(' exampleC ', $trimmer::rtrim(' exampleC '));
    }

    /**
     * @return void
     */
    public function testResetInstance(): void
    {
        Trimmer::resetInstance();
        $instance1 = Trimmer::getInstance();
        Trimmer::resetInstance();
        $instance2 = Trimmer::getInstance();
        $this->assertNotSame($instance1, $instance2);
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
            "Call to undefined method 'BVP\Trimmer\TrimmerCore::ghost()'."
        );

        Trimmer::ghost();
    }
}
