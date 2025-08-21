<?php

declare(strict_types=1);

namespace BVP\Trimmer\Tests;

/**
 * @author shimomo
 */
final class TrimmerDataProvider
{
    /**
     * @return array<int, array<int, array<int, mixed>>>
     */
    public static function trimArrayProvider(): array
    {
        return [
            [[' trimmerA '], ['trimmerA']],
            [[' trimmerA ', [' trimmerB ']], ['trimmerA', ['trimmerB']]],
            [["\n trimmerA \t"], ['trimmerA']],
            [["\n trimmerA \t", ["\n trimmerB \t"]], ['trimmerA', ['trimmerB']]],
            [[' trimmerA ', 1, 1.0, true, null], ['trimmerA', 1, 1.0, true, null]],
            [[' trimmerA ', [' trimmerB ', 1, 1.0, true, null]], ['trimmerA', ['trimmerB', 1, 1.0, true, null]]],
            [[1, 1.0, true, null], [1, 1.0, true, null]],
            [[1, 1.0, true, null, [1, 1.0, true, null]], [1, 1.0, true, null, [1, 1.0, true, null]]],
            [[], []],
            [[[]], [[]]],
        ];
    }

    /**
     * @return array<int, array<int, bool>>
     */
    public static function trimBoolProvider(): array
    {
        return [
            [true, true],
            [false, false],
        ];
    }

    /**
     * @return array<int, array<int, float>>
     */
    public static function trimFloatProvider(): array
    {
        return [
            [0.0, 0.0],
            [1.0, 1.0],
        ];
    }

    /**
     * @return array<int, array<int, int>>
     */
    public static function trimIntProvider(): array
    {
        return [
            [0, 0],
            [1, 1],
        ];
    }

    /**
     * @return array<int, array<int, null>>
     */
    public static function trimNullProvider(): array
    {
        return [
            [null],
        ];
    }

    /**
     * @return array<int, array<int, object|array<int, string>>>
     */
    public static function trimObjectProvider(): array
    {
        $objectA = new class {
            private string $propertyA = ' trimmerA ';
            private string $propertyB = ' trimmerB ';
            private object $objectB;
            public function __construct() {
                $this->objectB = new class {
                    private string $propertyC = ' trimmerC ';
                    private string $propertyD = ' trimmerD ';
                    public function getPropertyC(): string { return $this->propertyC; }
                    public function setPropertyC(string $value): void { $this->propertyC = $value; }
                    public function getPropertyD(): string { return $this->propertyD; }
                };
            }
            public function getPropertyA(): string { return $this->propertyA; }
            public function setPropertyA(string $value): void { $this->propertyA = $value; }
            public function getPropertyB(): string { return $this->propertyB; }
            public function getObjectB(): object { return $this->objectB; }
        };

        return [
            [$objectA, ['trimmerA', ' trimmerB ', 'trimmerC', ' trimmerD ']],
        ];
    }

    /**
     * @return array<int, array<int, string>>
     */
    public static function trimStringProvider(): array
    {
        return [
            [' trimmer ', 'trimmer'],
            ["\n trimmer \t", 'trimmer'],
            ['', ''],
            [' ', ''],
        ];
    }

    /**
     * @return array<int, array<int, array<int, mixed>>>
     */
    public static function ltrimArrayProvider(): array
    {
        return [
            [[' trimmerA '], ['trimmerA ']],
            [[' trimmerA ', [' trimmerB ']], ['trimmerA ', ['trimmerB ']]],
            [["\n trimmerA \t"], ["trimmerA \t"]],
            [["\n trimmerA \t", ["\n trimmerB \t"]], ["trimmerA \t", ["trimmerB \t"]]],
            [[' trimmerA ', 1, 1.0, true, null], ['trimmerA ', 1, 1.0, true, null]],
            [[' trimmerA ', [' trimmerB ', 1, 1.0, true, null]], ['trimmerA ', ['trimmerB ', 1, 1.0, true, null]]],
            [[1, 1.0, true, null], [1, 1.0, true, null]],
            [[1, 1.0, true, null, [1, 1.0, true, null]], [1, 1.0, true, null, [1, 1.0, true, null]]],
            [[], []],
            [[[]], [[]]],
        ];
    }

    /**
     * @return array<int, array<int, bool>>
     */
    public static function ltrimBoolProvider(): array
    {
        return [
            [true, true],
            [false, false],
        ];
    }

    /**
     * @return array<int, array<int, float>>
     */
    public static function ltrimFloatProvider(): array
    {
        return [
            [0.0, 0.0],
            [1.0, 1.0],
        ];
    }

    /**
     * @return array<int, array<int, int>>
     */
    public static function ltrimIntProvider(): array
    {
        return [
            [0, 0],
            [1, 1],
        ];
    }

    /**
     * @return array<int, array<int, null>>
     */
    public static function ltrimNullProvider(): array
    {
        return [
            [null],
        ];
    }

    /**
     * @return array<int, array<int, object|array<int, string>>>
     */
    public static function ltrimObjectProvider(): array
    {
        $objectA = new class {
            private string $propertyA = ' trimmerA ';
            private string $propertyB = ' trimmerB ';
            private object $objectB;
            public function __construct() {
                $this->objectB = new class {
                    private string $propertyC = ' trimmerC ';
                    private string $propertyD = ' trimmerD ';
                    public function getPropertyC(): string { return $this->propertyC; }
                    public function setPropertyC(string $value): void { $this->propertyC = $value; }
                    public function getPropertyD(): string { return $this->propertyD; }
                };
            }
            public function getPropertyA(): string { return $this->propertyA; }
            public function setPropertyA(string $value): void { $this->propertyA = $value; }
            public function getPropertyB(): string { return $this->propertyB; }
            public function getObjectB(): object { return $this->objectB; }
        };

        return [
            [$objectA, ['trimmerA ', ' trimmerB ', 'trimmerC ', ' trimmerD ']],
        ];
    }

    /**
     * @return array<int, array<int, string>>
     */
    public static function ltrimStringProvider(): array
    {
        return [
            [' trimmer ', 'trimmer '],
            ["\n trimmer \t", "trimmer \t"],
            ['', ''],
            [' ', ''],
        ];
    }

    /**
     * @return array<int, array<int, array<int, mixed>>>
     */
    public static function rtrimArrayProvider(): array
    {
        return [
            [[' trimmerA '], [' trimmerA']],
            [[' trimmerA ', [' trimmerB ']], [' trimmerA', [' trimmerB']]],
            [["\n trimmerA \t"], ["\n trimmerA"]],
            [["\n trimmerA \t", ["\n trimmerB \t"]], ["\n trimmerA", ["\n trimmerB"]]],
            [[' trimmerA ', 1, 1.0, true, null], [' trimmerA', 1, 1.0, true, null]],
            [[' trimmerA ', [' trimmerB ', 1, 1.0, true, null]], [' trimmerA', [' trimmerB', 1, 1.0, true, null]]],
            [[1, 1.0, true, null], [1, 1.0, true, null]],
            [[1, 1.0, true, null, [1, 1.0, true, null]], [1, 1.0, true, null, [1, 1.0, true, null]]],
            [[], []],
            [[[]], [[]]],
        ];
    }

    /**
     * @return array<int, array<int, bool>>
     */
    public static function rtrimBoolProvider(): array
    {
        return [
            [true, true],
            [false, false],
        ];
    }

    /**
     * @return array<int, array<int, float>>
     */
    public static function rtrimFloatProvider(): array
    {
        return [
            [0.0, 0.0],
            [1.0, 1.0],
        ];
    }

    /**
     * @return array<int, array<int, int>>
     */
    public static function rtrimIntProvider(): array
    {
        return [
            [0, 0],
            [1, 1],
        ];
    }

    /**
     * @return array<int, array<int, null>>
     */
    public static function rtrimNullProvider(): array
    {
        return [
            [null],
        ];
    }

    /**
     * @return array<int, array<int, object|array<int, string>>>
     */
    public static function rtrimObjectProvider(): array
    {
        $objectA = new class {
            private string $propertyA = ' trimmerA ';
            private string $propertyB = ' trimmerB ';
            private object $objectB;
            public function __construct() {
                $this->objectB = new class {
                    private string $propertyC = ' trimmerC ';
                    private string $propertyD = ' trimmerD ';
                    public function getPropertyC(): string { return $this->propertyC; }
                    public function setPropertyC(string $value): void { $this->propertyC = $value; }
                    public function getPropertyD(): string { return $this->propertyD; }
                };
            }
            public function getPropertyA(): string { return $this->propertyA; }
            public function setPropertyA(string $value): void { $this->propertyA = $value; }
            public function getPropertyB(): string { return $this->propertyB; }
            public function getObjectB(): object { return $this->objectB; }
        };

        return [
            [$objectA, [' trimmerA', ' trimmerB ', ' trimmerC', ' trimmerD ']],
        ];
    }

    /**
     * @return array<int, array<int, string>>
     */
    public static function rtrimStringProvider(): array
    {
        return [
            [' trimmer ', ' trimmer'],
            ["\n trimmer \t", "\n trimmer"],
            ['', ''],
            [' ', ''],
        ];
    }
}
