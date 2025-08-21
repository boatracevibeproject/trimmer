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
     * @param  array<int, mixed>  $input
     * @param  array<int, mixed>  $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'trimArrayProvider')]
    public function testTrimArray(array $input, array $expected): void
    {
        $this->assertSame($expected, Trimmer::trim($input));
    }

    /**
     * @param  bool  $input
     * @param  bool  $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'trimBoolProvider')]
    public function testTrimBool(bool $input, bool $expected): void
    {
        $this->assertSame($expected, Trimmer::trim($input));
    }

    /**
     * @param  float  $input
     * @param  float  $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'trimFloatProvider')]
    public function testTrimFloat(float $input, float $expected): void
    {
        $this->assertSame($expected, Trimmer::trim($input));
    }

    /**
     * @param  int  $input
     * @param  int  $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'trimIntProvider')]
    public function testTrimInt(int $input, int $expected): void
    {
        $this->assertSame($expected, Trimmer::trim($input));
    }

    /**
     * @param  null  $input
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'trimNullProvider')]
    public function testTrimNull(null $input): void
    {
        $this->assertNull(Trimmer::trim($input));
    }

    /**
     * @param  object              $input
     * @param  array<int, string>  $expected
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
     * @param  string  $input
     * @param  string  $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'trimStringProvider')]
    public function testTrimString(string $input, string $expected): void
    {
        $this->assertSame($expected, Trimmer::trim($input));
    }

    /**
     * @param  array<int, mixed>  $input
     * @param  array<int, mixed>  $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'ltrimArrayProvider')]
    public function testLtrimArray(array $input, array $expected): void
    {
        $this->assertSame($expected, Trimmer::ltrim($input));
    }

    /**
     * @param  bool  $input
     * @param  bool  $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'ltrimBoolProvider')]
    public function testLtrimBool(bool $input, bool $expected): void
    {
        $this->assertSame($expected, Trimmer::ltrim($input));
    }

    /**
     * @param  float  $input
     * @param  float  $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'ltrimFloatProvider')]
    public function testLtrimFloat(float $input, float $expected): void
    {
        $this->assertSame($expected, Trimmer::ltrim($input));
    }

    /**
     * @param  int  $input
     * @param  int  $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'ltrimIntProvider')]
    public function testLtrimInt(int $input, int $expected): void
    {
        $this->assertSame($expected, Trimmer::ltrim($input));
    }

    /**
     * @param  null  $input
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'ltrimNullProvider')]
    public function testLtrimNull(null $input): void
    {
        $this->assertNull(Trimmer::ltrim($input));
    }

    /**
     * @param  object              $input
     * @param  array<int, string>  $expected
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
     * @param  string  $input
     * @param  string  $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'ltrimStringProvider')]
    public function testLtrimString(string $input, string $expected): void
    {
        $this->assertSame($expected, Trimmer::ltrim($input));
    }

    /**
     * @param  array<int, mixed>  $input
     * @param  array<int, mixed>  $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'rtrimArrayProvider')]
    public function testRtrimArray(array $input, array $expected): void
    {
        $this->assertSame($expected, Trimmer::rtrim($input));
    }

    /**
     * @param  bool  $input
     * @param  bool  $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'rtrimBoolProvider')]
    public function testRtrimBool(bool $input, bool $expected): void
    {
        $this->assertSame($expected, Trimmer::rtrim($input));
    }

    /**
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
     * @param  int  $input
     * @param  int  $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'rtrimIntProvider')]
    public function testRtrimInt(int $input, int $expected): void
    {
        $this->assertSame($expected, Trimmer::rtrim($input));
    }

    /**
     * @param  null  $input
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'rtrimNullProvider')]
    public function testRtrimNull(null $input): void
    {
        $this->assertNull(Trimmer::rtrim($input));
    }

    /**
     * @param  object              $input
     * @param  array<int, string>  $expected
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
     * @param  string  $input
     * @param  string  $expected
     * @return void
     */
    #[DataProviderExternal(TrimmerDataProvider::class, 'rtrimStringProvider')]
    public function testRtrimString(string $input, string $expected): void
    {
        $this->assertSame($expected, Trimmer::rtrim($input));
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
