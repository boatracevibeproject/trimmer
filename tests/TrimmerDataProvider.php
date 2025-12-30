<?php

declare(strict_types=1);

namespace BVP\Trimmer\Tests;

/**
 * @author shimomo
 */
final class TrimmerDataProvider
{
    /**
     * @psalm-return non-empty-list<
     *     array{
     *         arguments: list<mixed>,
     *         expected: list<mixed>,
     *     }
     * >
     *
     * @return array
     */
    public static function trimArrayProvider(): array
    {
        return [
            [
                'arguments' => [' trimmerA '],
                'expected' => ['trimmerA']
            ],
            [
                'arguments' => [' trimmerA ', [' trimmerB ']],
                'expected' => ['trimmerA', ['trimmerB']],
            ],
            [
                'arguments' => ["\n trimmerA \t"],
                'expected' => ['trimmerA'],
            ],
            [
                'arguments' => ["\n trimmerA \t", ["\n trimmerB \t"]],
                'expected' => ['trimmerA', ['trimmerB']],
            ],
            [
                'arguments' => [' trimmerA ', 1, 1.0, true, null],
                'expected' => ['trimmerA', 1, 1.0, true, null],
            ],
            [
                'arguments' => [' trimmerA ', [' trimmerB ', 1, 1.0, true, null]],
                'expected' => ['trimmerA', ['trimmerB', 1, 1.0, true, null]],
            ],
            [
                'arguments' => [1, 1.0, true, null],
                'expected' => [1, 1.0, true, null],
            ],
            [
                'arguments' => [1, 1.0, true, null, [1, 1.0, true, null]],
                'expected' => [1, 1.0, true, null, [1, 1.0, true, null]],
            ],
            [
                'arguments' => [],
                'expected' => [],
            ],
            [
                'arguments' => [[]],
                'expected' => [[]],
            ],
        ];
    }

    /**
     * @psalm-return non-empty-list<
     *     array{
     *         arguments: bool,
     *         expected: bool,
     *     }
     * >
     *
     * @return array
     */
    public static function trimBoolProvider(): array
    {
        return [
            [
                'arguments' => true,
                'expected' => true,
            ],
            [
                'arguments' => false,
                'expected' => false,
            ],
        ];
    }

    /**
     * @psalm-return non-empty-list<
     *     array{
     *         arguments: float,
     *         expected: float,
     *     }
     * >
     *
     * @return array
     */
    public static function trimFloatProvider(): array
    {
        return [
            [
                'arguments' => 0.0,
                'expected' => 0.0,
            ],
            [
                'arguments' => 1.0,
                'expected' => 1.0,
            ],
        ];
    }

    /**
     * @psalm-return non-empty-list<
     *     array{
     *         arguments: int,
     *         expected: int,
     *     }
     * >
     *
     * @return array
     */
    public static function trimIntProvider(): array
    {
        return [
            [
                'arguments' => 0,
                'expected' => 0,
            ],
            [
                'arguments' => 1,
                'expected' => 1,
            ],
        ];
    }

    /**
     * @psalm-return non-empty-list<
     *     array{arguments: null}
     * >
     *
     * @return array
     */
    public static function trimNullProvider(): array
    {
        return [
            [
                'arguments' => null,
            ],
        ];
    }

    /**
     * @psalm-return non-empty-list<
     *     array{
     *         arguments: object,
     *         expected: list<non-empty-string>,
     *     }
     * >
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
            [
                'arguments' => $objectA,
                'expected' => ['trimmerA', ' trimmerB ', 'trimmerC', ' trimmerD '],
            ],
        ];
    }

    /**
     * @psalm-return non-empty-list<
     *     array{
     *         arguments: string,
     *         expected: string,
     *     }
     * >
     *
     * @return array
     */
    public static function trimStringProvider(): array
    {
        return [
            [
                'arguments' => ' trimmer ',
                'expected' => 'trimmer',
            ],
            [
                'arguments' => "\n trimmer \t",
                'expected' => 'trimmer',
            ],
            [
                'arguments' => '',
                'expected' => '',
            ],
            [
                'arguments' => ' ',
                'expected' => '',
            ],
        ];
    }

    /**
     * @psalm-return non-empty-list<
     *     array{
     *         arguments: list<mixed>,
     *         expected: list<mixed>,
     *     }
     * >
     *
     * @return array
     */
    public static function ltrimArrayProvider(): array
    {
        return [
            [
                'arguments' => [' trimmerA '],
                'expected' => ['trimmerA '],
            ],
            [
                'arguments' => [' trimmerA ', [' trimmerB ']],
                'expected' => ['trimmerA ', ['trimmerB ']],
            ],
            [
                'arguments' => ["\n trimmerA \t"],
                'expected' => ["trimmerA \t"],
            ],
            [
                'arguments' => ["\n trimmerA \t", ["\n trimmerB \t"]],
                'expected' => ["trimmerA \t", ["trimmerB \t"]],
            ],
            [
                'arguments' => [' trimmerA ', 1, 1.0, true, null],
                'expected' => ['trimmerA ', 1, 1.0, true, null]],
            [
                'arguments' => [' trimmerA ', [' trimmerB ', 1, 1.0, true, null]],
                'expected' => ['trimmerA ', ['trimmerB ', 1, 1.0, true, null]]],
            [
                'arguments' => [1, 1.0, true, null],
                'expected' => [1, 1.0, true, null]],
            [
                'arguments' => [1, 1.0, true, null, [1, 1.0, true, null]],
                'expected' => [1, 1.0, true, null, [1, 1.0, true, null]]],
            [
                'arguments' => [],
                'expected' => []],
            [
                'arguments' => [[]],
                'expected' => [[]],
            ],
        ];
    }

    /**
     * @psalm-return non-empty-list<
     *     array{
     *         arguments: bool,
     *         expected: bool,
     *     }
     * >
     *
     * @return array
     */
    public static function ltrimBoolProvider(): array
    {
        return [
            [
                'arguments' => true,
                'expected' => true,
            ],
            [
                'arguments' => false,
                'expected' => false,
            ],
        ];
    }

    /**
     * @psalm-return non-empty-list<
     *     array{
     *         arguments: float,
     *         expected: float,
     *     }
     * >
     *
     * @return array
     */
    public static function ltrimFloatProvider(): array
    {
        return [
            [
                'arguments' => 0.0,
                'expected' => 0.0,
            ],
            [
                'arguments' => 1.0,
                'expected' => 1.0,
            ],
        ];
    }

    /**
     * @psalm-return non-empty-list<
     *     array{
     *         arguments: int,
     *         expected: int,
     *     }
     * >
     *
     * @return array
     */
    public static function ltrimIntProvider(): array
    {
        return [
            [
                'arguments' => 0,
                'expected' => 0,
            ],
            [
                'arguments' => 1,
                'expected' => 1,
            ],
        ];
    }

    /**
     * @psalm-return non-empty-list<
     *     array{arguments: null}
     * >
     *
     * @return array
     */
    public static function ltrimNullProvider(): array
    {
        return [
            [
                'arguments' => null,
            ],
        ];
    }

    /**
     * @psalm-return non-empty-list<
     *     array{
     *         arguments: object,
     *         expected: list<non-empty-string>,
     *     }
     * >
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
            [
                'arguments' => $objectA,
                'expected' => ['trimmerA ', ' trimmerB ', 'trimmerC ', ' trimmerD '],
            ],
        ];
    }

    /**
     * @psalm-return non-empty-list<
     *     array{
     *         arguments: string,
     *         expected: string,
     *     }
     * >
     *
     * @return array
     */
    public static function ltrimStringProvider(): array
    {
        return [
            [
                'arguments' => ' trimmer ',
                'expected' => 'trimmer ',
            ],
            [
                'arguments' => "\n trimmer \t",
                'expected' => "trimmer \t",
            ],
            [
                'arguments' => '',
                'expected' => '',
            ],
            [
                'arguments' => ' ',
                'expected' => '',
            ],
        ];
    }

    /**
     * @psalm-return non-empty-list<
     *     array{
     *         arguments: list<mixed>,
     *         expected: list<mixed>,
     *     }
     * >
     *
     * @return array
     */
    public static function rtrimArrayProvider(): array
    {
        return [
            [
                'arguments' => [' trimmerA '],
                'expected' => [' trimmerA'],
            ],
            [
                'arguments' => [' trimmerA ', [' trimmerB ']],
                'expected' => [' trimmerA', [' trimmerB']],
            ],
            [
                'arguments' => ["\n trimmerA \t"],
                'expected' => ["\n trimmerA"],
            ],
            [
                'arguments' => ["\n trimmerA \t", ["\n trimmerB \t"]],
                'expected' => ["\n trimmerA", ["\n trimmerB"]],
            ],
            [
                'arguments' => [' trimmerA ', 1, 1.0, true, null],
                'expected' => [' trimmerA', 1, 1.0, true, null],
            ],
            [
                'arguments' => [' trimmerA ', [' trimmerB ', 1, 1.0, true, null]],
                'expected' => [' trimmerA', [' trimmerB', 1, 1.0, true, null]],
            ],
            [
                'arguments' => [1, 1.0, true, null],
                'expected' => [1, 1.0, true, null],
            ],
            [
                'arguments' => [1, 1.0, true, null, [1, 1.0, true, null]],
                'expected' => [1, 1.0, true, null, [1, 1.0, true, null]],
            ],
            [
                'arguments' => [],
                'expected' => [],
            ],
            [
                'arguments' => [[]],
                'expected' => [[]],
            ],
        ];
    }

    /**
     * @psalm-return non-empty-list<
     *     array{
     *         arguments: bool,
     *         expected: bool,
     *     }
     * >
     *
     * @return array
     */
    public static function rtrimBoolProvider(): array
    {
        return [
            [
                'arguments' => true,
                'expected' => true,
            ],
            [
                'arguments' => false,
                'expected' => false,
            ],
        ];
    }

    /**
     * @psalm-return non-empty-list<
     *     array{
     *         arguments: float,
     *         expected: float,
     *     }
     * >
     *
     * @return array
     */
    public static function rtrimFloatProvider(): array
    {
        return [
            [
                'arguments' => 0.0,
                'expected' => 0.0,
            ],
            [
                'arguments' => 1.0,
                'expected' => 1.0,
            ],
        ];
    }

    /**
     * @psalm-return non-empty-list<
     *     array{
     *         arguments: int,
     *         expected: int,
     *     }
     * >
     *
     * @return array
     */
    public static function rtrimIntProvider(): array
    {
        return [
            [
                'arguments' => 0,
                'expected' => 0,
            ],
            [
                'arguments' => 1,
                'expected' => 1,
            ],
        ];
    }

    /**
     * @psalm-return non-empty-list<
     *     array{arguments: null}
     * >
     *
     * @return array
     */
    public static function rtrimNullProvider(): array
    {
        return [
            [
                'arguments' => null,
            ],
        ];
    }

    /**
     * @psalm-return non-empty-list<
     *     array{
     *         arguments: object,
     *         expected: list<non-empty-string>,
     *     }
     * >
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
            [
                'arguments' => $objectA,
                'expected' => [' trimmerA', ' trimmerB ', ' trimmerC', ' trimmerD '],
            ],
        ];
    }

    /**
     * @psalm-return non-empty-list<
     *     array{
     *         arguments: string,
     *         expected: string,
     *     }
     * >
     *
     * @return array
     */
    public static function rtrimStringProvider(): array
    {
        return [
            [
                'arguments' => ' trimmer ',
                'expected' => ' trimmer',
            ],
            [
                'arguments' => "\n trimmer \t",
                'expected' => "\n trimmer",
            ],
            [
                'arguments' => '',
                'expected' => '',
            ],
            [
                'arguments' => ' ',
                'expected' => '',
            ],
        ];
    }
}
