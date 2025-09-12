<?php

declare(strict_types=1);

namespace BVP\Trimmer\Tests;

/**
 * @author shimomo
 */
final class TrimmerDataProvider
{
    /**
     * @psalm-return array<int, array<int, array<int, mixed>>>
     *
     * @return array
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
     * @psalm-return array<int, array<int, bool>>
     *
     * @return array
     */
    public static function trimBoolProvider(): array
    {
        return [
            [true, true],
            [false, false],
        ];
    }

    /**
     * @psalm-return array<int, array<int, float>>
     *
     * @return array
     */
    public static function trimFloatProvider(): array
    {
        return [
            [0.0, 0.0],
            [1.0, 1.0],
        ];
    }

    /**
     * @psalm-return array<int, array<int, int>>
     *
     * @return array
     */
    public static function trimIntProvider(): array
    {
        return [
            [0, 0],
            [1, 1],
        ];
    }

    /**
     * @psalm-return array<int, array<int, null>>
     *
     * @return array
     */
    public static function trimNullProvider(): array
    {
        return [
            [null],
        ];
    }

    /**
     * @psalm-return array<int, array<int, object|array<int, string>>>
     *
     * @return array
     */
    public static function trimObjectProvider(): array
    {
        $objectA = new class {
            private string $propertyA = ' trimmerA ';
            private string $propertyB = ' trimmerB ';
            private object $objectB;

            public function __construct()
            {
                $this->objectB = new class {
                    private string $propertyC = ' trimmerC ';
                    private string $propertyD = ' trimmerD ';

                    public function getPropertyC(): string
                    {
                        return $this->propertyC;
                    }

                    public function setPropertyC(string $value): void
                    {
                        $this->propertyC = $value;
                    }

                    public function getPropertyD(): string
                    {
                        return $this->propertyD;
                    }
                };
            }

            public function getPropertyA(): string
            {
                return $this->propertyA;
            }

            public function setPropertyA(string $value): void
            {
                $this->propertyA = $value;
            }

            public function getPropertyB(): string
            {
                return $this->propertyB;
            }

            public function getObjectB(): object
            {
                return $this->objectB;
            }
        };

        return [
            [$objectA, ['trimmerA', ' trimmerB ', 'trimmerC', ' trimmerD ']],
        ];
    }

    /**
     * @psalm-return array<int, array<int, string>>
     *
     * @return array
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
     * @psalm-return array<int, array<int, array<int, mixed>>>
     *
     * @return array
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
     * @psalm-return array<int, array<int, bool>>
     *
     * @return array
     */
    public static function ltrimBoolProvider(): array
    {
        return [
            [true, true],
            [false, false],
        ];
    }

    /**
     * @psalm-return array<int, array<int, float>>
     *
     * @return array
     */
    public static function ltrimFloatProvider(): array
    {
        return [
            [0.0, 0.0],
            [1.0, 1.0],
        ];
    }

    /**
     * @psalm-return array<int, array<int, int>>
     *
     * @return array
     */
    public static function ltrimIntProvider(): array
    {
        return [
            [0, 0],
            [1, 1],
        ];
    }

    /**
     * @psalm-return array<int, array<int, null>>
     *
     * @return array
     */
    public static function ltrimNullProvider(): array
    {
        return [
            [null],
        ];
    }

    /**
     * @psalm-return array<int, array<int, object|array<int, string>>>
     *
     * @return array
     */
    public static function ltrimObjectProvider(): array
    {
        $objectA = new class {
            private string $propertyA = ' trimmerA ';
            private string $propertyB = ' trimmerB ';
            private object $objectB;

            public function __construct()
            {
                $this->objectB = new class {
                    private string $propertyC = ' trimmerC ';
                    private string $propertyD = ' trimmerD ';

                    public function getPropertyC(): string
                    {
                        return $this->propertyC;
                    }

                    public function setPropertyC(string $value): void
                    {
                        $this->propertyC = $value;
                    }

                    public function getPropertyD(): string
                    {
                        return $this->propertyD;
                    }
                };
            }

            public function getPropertyA(): string
            {
                return $this->propertyA;
            }

            public function setPropertyA(string $value): void
            {
                $this->propertyA = $value;
            }

            public function getPropertyB(): string
            {
                return $this->propertyB;
            }

            public function getObjectB(): object
            {
                return $this->objectB;
            }
        };

        return [
            [$objectA, ['trimmerA ', ' trimmerB ', 'trimmerC ', ' trimmerD ']],
        ];
    }

    /**
     * @psalm-return array<int, array<int, string>>
     *
     * @return array
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
     * @psalm-return array<int, array<int, array<int, mixed>>>
     *
     * @return array
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
     * @psalm-return array<int, array<int, bool>>
     *
     * @return array
     */
    public static function rtrimBoolProvider(): array
    {
        return [
            [true, true],
            [false, false],
        ];
    }

    /**
     * @psalm-return array<int, array<int, float>>
     *
     * @return array
     */
    public static function rtrimFloatProvider(): array
    {
        return [
            [0.0, 0.0],
            [1.0, 1.0],
        ];
    }

    /**
     * @psalm-return array<int, array<int, int>>
     *
     * @return array
     */
    public static function rtrimIntProvider(): array
    {
        return [
            [0, 0],
            [1, 1],
        ];
    }

    /**
     * psalm-return array<int, array<int, null>>
     *
     * @return array
     */
    public static function rtrimNullProvider(): array
    {
        return [
            [null],
        ];
    }

    /**
     * @psalm-return array<int, array<int, object|array<int, string>>>
     *
     * @return array
     */
    public static function rtrimObjectProvider(): array
    {
        $objectA = new class {
            private string $propertyA = ' trimmerA ';
            private string $propertyB = ' trimmerB ';
            private object $objectB;

            public function __construct()
            {
                $this->objectB = new class {
                    private string $propertyC = ' trimmerC ';
                    private string $propertyD = ' trimmerD ';

                    public function getPropertyC(): string
                    {
                        return $this->propertyC;
                    }

                    public function setPropertyC(string $value): void
                    {
                        $this->propertyC = $value;
                    }

                    public function getPropertyD(): string
                    {
                        return $this->propertyD;
                    }
                };
            }

            public function getPropertyA(): string
            {
                return $this->propertyA;
            }

            public function setPropertyA(string $value): void
            {
                $this->propertyA = $value;
            }

            public function getPropertyB(): string
            {
                return $this->propertyB;
            }

            public function getObjectB(): object
            {
                return $this->objectB;
            }
        };

        return [
            [$objectA, [' trimmerA', ' trimmerB ', ' trimmerC', ' trimmerD ']],
        ];
    }

    /**
     * @psalm-return array<int, array<int, string>>
     *
     * @return array
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
