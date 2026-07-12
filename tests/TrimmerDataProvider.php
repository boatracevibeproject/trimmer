<?php

declare(strict_types=1);

namespace BVP\Trimmer\Tests;

use stdClass;

/**
 * @author shimomo
 */
final class TrimmerDataProvider
{
    /**
     * @return non-empty-list<
     *     array{
     *         items: list<mixed>,
     *         expected: list<mixed>,
     *     },
     * >
     */
    public static function trimArrayProvider(): array
    {
        return [
            [
                'items' => [' trimmerA '],
                'expected' => ['trimmerA']
            ],
            [
                'items' => [' trimmerA ', [' trimmerB ']],
                'expected' => ['trimmerA', ['trimmerB']],
            ],
            [
                'items' => ["\n trimmerA \t"],
                'expected' => ['trimmerA'],
            ],
            [
                'items' => ["\n trimmerA \t", ["\n trimmerB \t"]],
                'expected' => ['trimmerA', ['trimmerB']],
            ],
            [
                'items' => [' trimmerA ', 1, 1.0, true, null],
                'expected' => ['trimmerA', 1, 1.0, true, null],
            ],
            [
                'items' => [' trimmerA ', [' trimmerB ', 1, 1.0, true, null]],
                'expected' => ['trimmerA', ['trimmerB', 1, 1.0, true, null]],
            ],
            [
                'items' => [1, 1.0, true, null],
                'expected' => [1, 1.0, true, null],
            ],
            [
                'items' => [1, 1.0, true, null, [1, 1.0, true, null]],
                'expected' => [1, 1.0, true, null, [1, 1.0, true, null]],
            ],
            [
                'items' => [],
                'expected' => [],
            ],
            [
                'items' => [[]],
                'expected' => [[]],
            ],
        ];
    }

    /**
     * @return non-empty-list<
     *     array{
     *         items: bool,
     *         expected: bool,
     *     },
     * >
     */
    public static function trimBoolProvider(): array
    {
        return [
            [
                'items' => true,
                'expected' => true,
            ],
            [
                'items' => false,
                'expected' => false,
            ],
        ];
    }

    /**
     * @return non-empty-list<
     *     array{
     *         items: float,
     *         expected: float,
     *     },
     * >
     */
    public static function trimFloatProvider(): array
    {
        return [
            [
                'items' => 0.0,
                'expected' => 0.0,
            ],
            [
                'items' => 1.0,
                'expected' => 1.0,
            ],
        ];
    }

    /**
     * @return non-empty-list<
     *     array{
     *         items: int,
     *         expected: int,
     *     },
     * >
     */
    public static function trimIntProvider(): array
    {
        return [
            [
                'items' => 0,
                'expected' => 0,
            ],
            [
                'items' => 1,
                'expected' => 1,
            ],
        ];
    }

    /**
     * @return non-empty-list<
     *     array{
     *         items: null,
     *     },
     * >
     */
    public static function trimNullProvider(): array
    {
        return [
            [
                'items' => null,
            ],
        ];
    }

    /**
     * @return non-empty-list<
     *     array{
     *         items: string,
     *         expected: string,
     *     },
     * >
     */
    public static function trimStringProvider(): array
    {
        return [
            [
                'items' => ' trimmer ',
                'expected' => 'trimmer',
            ],
            [
                'items' => "\n trimmer \t",
                'expected' => 'trimmer',
            ],
            [
                'items' => '',
                'expected' => '',
            ],
            [
                'items' => ' ',
                'expected' => '',
            ],
        ];
    }

    /**
     * @return non-empty-list<
     *     array{
     *         items: object,
     *     },
     * >
     */
    public static function trimObjectProvider(): array
    {
        return [
            [
                'items' => new stdClass(),
            ],
            [
                'items' => (object) ['foo' => ' bar '],
            ],
        ];
    }

    /**
     * @return non-empty-list<
     *     array{
     *         items: non-empty-string,
     *         characters: non-empty-string,
     *         expected: non-empty-string,
     *     },
     * >
     */
    public static function trimCharactersProvider(): array
    {
        return [
            [
                'items' => '__trimmer__',
                'characters' => '_',
                'expected' => 'trimmer',
            ],
            [
                'items' => '--trimmer--',
                'characters' => '-',
                'expected' => 'trimmer',
            ],
            [
                'items' => ' _trimmer_ ',
                'characters' => ' _',
                'expected' => 'trimmer',
            ],
        ];
    }

    /**
     * @return non-empty-list<
     *     array{
     *         items: array<array-key, mixed>,
     *         trimKeys: bool,
     *         expected: array<array-key, mixed>,
     *     },
     * >
     */
    public static function trimKeysProvider(): array
    {
        return [
            [
                'items' => [' foo ' => ' bar '],
                'trimKeys' => false,
                'expected' => [' foo ' => 'bar'],
            ],
            [
                'items' => [' foo ' => ' bar '],
                'trimKeys' => true,
                'expected' => ['foo' => 'bar'],
            ],
            [
                'items' => [' foo ' => ' a ', 'foo' => ' b '],
                'trimKeys' => true,
                'expected' => ['foo' => 'b'],
            ],
            [
                'items' => [8 => 'a', ' 8 ' => 'b'],
                'trimKeys' => true,
                'expected' => [8 => 'b'],
            ],
            [
                'items' => [0 => ' a ', 1 => ' b '],
                'trimKeys' => true,
                'expected' => [0 => 'a', 1 => 'b'],
            ],
            [
                'items' => [' outer ' => [' inner ' => ' value ']],
                'trimKeys' => true,
                'expected' => ['outer' => ['inner' => 'value']],
            ],
            [
                'items' => [],
                'trimKeys' => true,
                'expected' => [],
            ],
        ];
    }

    /**
     * @return non-empty-list<
     *     array{
     *         items: list<mixed>,
     *         expected: list<mixed>,
     *     },
     * >
     */
    public static function ltrimArrayProvider(): array
    {
        return [
            [
                'items' => [' trimmerA '],
                'expected' => ['trimmerA '],
            ],
            [
                'items' => [' trimmerA ', [' trimmerB ']],
                'expected' => ['trimmerA ', ['trimmerB ']],
            ],
            [
                'items' => ["\n trimmerA \t"],
                'expected' => ["trimmerA \t"],
            ],
            [
                'items' => ["\n trimmerA \t", ["\n trimmerB \t"]],
                'expected' => ["trimmerA \t", ["trimmerB \t"]],
            ],
            [
                'items' => [' trimmerA ', 1, 1.0, true, null],
                'expected' => ['trimmerA ', 1, 1.0, true, null]],
            [
                'items' => [' trimmerA ', [' trimmerB ', 1, 1.0, true, null]],
                'expected' => ['trimmerA ', ['trimmerB ', 1, 1.0, true, null]]],
            [
                'items' => [1, 1.0, true, null],
                'expected' => [1, 1.0, true, null]],
            [
                'items' => [1, 1.0, true, null, [1, 1.0, true, null]],
                'expected' => [1, 1.0, true, null, [1, 1.0, true, null]]],
            [
                'items' => [],
                'expected' => []],
            [
                'items' => [[]],
                'expected' => [[]],
            ],
        ];
    }

    /**
     * @return non-empty-list<
     *     array{
     *         items: bool,
     *         expected: bool,
     *     },
     * >
     */
    public static function ltrimBoolProvider(): array
    {
        return [
            [
                'items' => true,
                'expected' => true,
            ],
            [
                'items' => false,
                'expected' => false,
            ],
        ];
    }

    /**
     * @return non-empty-list<
     *     array{
     *         items: float,
     *         expected: float,
     *     },
     * >
     */
    public static function ltrimFloatProvider(): array
    {
        return [
            [
                'items' => 0.0,
                'expected' => 0.0,
            ],
            [
                'items' => 1.0,
                'expected' => 1.0,
            ],
        ];
    }

    /**
     * @return non-empty-list<
     *     array{
     *         items: int,
     *         expected: int,
     *     },
     * >
     */
    public static function ltrimIntProvider(): array
    {
        return [
            [
                'items' => 0,
                'expected' => 0,
            ],
            [
                'items' => 1,
                'expected' => 1,
            ],
        ];
    }

    /**
     * @return non-empty-list<
     *     array{
     *         items: null,
     *     },
     * >
     */
    public static function ltrimNullProvider(): array
    {
        return [
            [
                'items' => null,
            ],
        ];
    }

    /**
     * @return non-empty-list<
     *     array{
     *         items: string,
     *         expected: string,
     *     },
     * >
     */
    public static function ltrimStringProvider(): array
    {
        return [
            [
                'items' => ' trimmer ',
                'expected' => 'trimmer ',
            ],
            [
                'items' => "\n trimmer \t",
                'expected' => "trimmer \t",
            ],
            [
                'items' => '',
                'expected' => '',
            ],
            [
                'items' => ' ',
                'expected' => '',
            ],
        ];
    }

    /**
     * @return non-empty-list<
     *     array{
     *         items: object,
     *     },
     * >
     */
    public static function ltrimObjectProvider(): array
    {
        return self::trimObjectProvider();
    }

    /**
     * @return non-empty-list<
     *     array{
     *         items: string,
     *         characters: non-empty-string,
     *         expected: string,
     *     },
     * >
     */
    public static function ltrimCharactersProvider(): array
    {
        return [
            [
                'items' => '__trimmer__',
                'characters' => '_',
                'expected' => 'trimmer__',
            ],
            [
                'items' => '--trimmer--',
                'characters' => '-',
                'expected' => 'trimmer--',
            ],
        ];
    }

    /**
     * @return non-empty-list<
     *     array{
     *         items: array<array-key, mixed>,
     *         trimKeys: bool,
     *         expected: array<array-key, mixed>,
     *     },
     * >
     */
    public static function ltrimKeysProvider(): array
    {
        return [
            [
                'items' => [' foo ' => ' bar '],
                'trimKeys' => false,
                'expected' => [' foo ' => 'bar '],
            ],
            [
                'items' => [' foo ' => ' bar '],
                'trimKeys' => true,
                'expected' => ['foo ' => 'bar '],
            ],
            [
                'items' => [' foo' => ' a', 'foo' => ' b'],
                'trimKeys' => true,
                'expected' => ['foo' => 'b'],
            ],
            [
                'items' => [8 => 'a', ' 8' => 'b'],
                'trimKeys' => true,
                'expected' => [8 => 'b'],
            ],
            [
                'items' => [0 => ' a ', 1 => ' b '],
                'trimKeys' => true,
                'expected' => [0 => 'a ', 1 => 'b '],
            ],
            [
                'items' => [' outer ' => [' inner ' => ' value ']],
                'trimKeys' => true,
                'expected' => ['outer ' => ['inner ' => 'value ']],
            ],
            [
                'items' => [],
                'trimKeys' => true,
                'expected' => [],
            ],
        ];
    }

    /**
     * @return non-empty-list<
     *     array{
     *         items: list<mixed>,
     *         expected: list<mixed>,
     *     },
     * >
     */
    public static function rtrimArrayProvider(): array
    {
        return [
            [
                'items' => [' trimmerA '],
                'expected' => [' trimmerA'],
            ],
            [
                'items' => [' trimmerA ', [' trimmerB ']],
                'expected' => [' trimmerA', [' trimmerB']],
            ],
            [
                'items' => ["\n trimmerA \t"],
                'expected' => ["\n trimmerA"],
            ],
            [
                'items' => ["\n trimmerA \t", ["\n trimmerB \t"]],
                'expected' => ["\n trimmerA", ["\n trimmerB"]],
            ],
            [
                'items' => [' trimmerA ', 1, 1.0, true, null],
                'expected' => [' trimmerA', 1, 1.0, true, null],
            ],
            [
                'items' => [' trimmerA ', [' trimmerB ', 1, 1.0, true, null]],
                'expected' => [' trimmerA', [' trimmerB', 1, 1.0, true, null]],
            ],
            [
                'items' => [1, 1.0, true, null],
                'expected' => [1, 1.0, true, null],
            ],
            [
                'items' => [1, 1.0, true, null, [1, 1.0, true, null]],
                'expected' => [1, 1.0, true, null, [1, 1.0, true, null]],
            ],
            [
                'items' => [],
                'expected' => [],
            ],
            [
                'items' => [[]],
                'expected' => [[]],
            ],
        ];
    }

    /**
     * @return non-empty-list<
     *     array{
     *         items: bool,
     *         expected: bool,
     *     },
     * >
     */
    public static function rtrimBoolProvider(): array
    {
        return [
            [
                'items' => true,
                'expected' => true,
            ],
            [
                'items' => false,
                'expected' => false,
            ],
        ];
    }

    /**
     * @return non-empty-list<
     *     array{
     *         items: float,
     *         expected: float,
     *     },
     * >
     */
    public static function rtrimFloatProvider(): array
    {
        return [
            [
                'items' => 0.0,
                'expected' => 0.0,
            ],
            [
                'items' => 1.0,
                'expected' => 1.0,
            ],
        ];
    }

    /**
     * @return non-empty-list<
     *     array{
     *         items: int,
     *         expected: int,
     *     },
     * >
     */
    public static function rtrimIntProvider(): array
    {
        return [
            [
                'items' => 0,
                'expected' => 0,
            ],
            [
                'items' => 1,
                'expected' => 1,
            ],
        ];
    }

    /**
     * @return non-empty-list<
     *     array{
     *         items: null,
     *     },
     * >
     */
    public static function rtrimNullProvider(): array
    {
        return [
            [
                'items' => null,
            ],
        ];
    }

    /**
     * @return non-empty-list<
     *     array{
     *         items: string,
     *         expected: string,
     *     },
     * >
     */
    public static function rtrimStringProvider(): array
    {
        return [
            [
                'items' => ' trimmer ',
                'expected' => ' trimmer',
            ],
            [
                'items' => "\n trimmer \t",
                'expected' => "\n trimmer",
            ],
            [
                'items' => '',
                'expected' => '',
            ],
            [
                'items' => ' ',
                'expected' => '',
            ],
        ];
    }

    /**
     * @return non-empty-list<
     *     array{
     *         items: object,
     *     },
     * >
     */
    public static function rtrimObjectProvider(): array
    {
        return self::trimObjectProvider();
    }

    /**
     * @return non-empty-list<
     *     array{
     *         items: string,
     *         characters: non-empty-string,
     *         expected: string,
     *     },
     * >
     */
    public static function rtrimCharactersProvider(): array
    {
        return [
            [
                'items' => '__trimmer__',
                'characters' => '_',
                'expected' => '__trimmer',
            ],
            [
                'items' => '--trimmer--',
                'characters' => '-',
                'expected' => '--trimmer',
            ],
        ];
    }

    /**
     * @return non-empty-list<
     *     array{
     *         items: array<array-key, mixed>,
     *         trimKeys: bool,
     *         expected: array<array-key, mixed>,
     *     },
     * >
     */
    public static function rtrimKeysProvider(): array
    {
        return [
            [
                'items' => [' foo ' => ' bar '],
                'trimKeys' => false,
                'expected' => [' foo ' => ' bar'],
            ],
            [
                'items' => [' foo ' => ' bar '],
                'trimKeys' => true,
                'expected' => [' foo' => ' bar'],
            ],
            [
                'items' => ['foo ' => 'a ', 'foo' => 'b '],
                'trimKeys' => true,
                'expected' => ['foo' => 'b'],
            ],
            [
                'items' => [8 => 'a', '8 ' => 'b'],
                'trimKeys' => true,
                'expected' => [8 => 'b'],
            ],
            [
                'items' => [0 => ' a ', 1 => ' b '],
                'trimKeys' => true,
                'expected' => [0 => ' a', 1 => ' b'],
            ],
            [
                'items' => [' outer ' => [' inner ' => ' value ']],
                'trimKeys' => true,
                'expected' => [' outer' => [' inner' => ' value']],
            ],
            [
                'items' => [],
                'trimKeys' => true,
                'expected' => [],
            ],
        ];
    }
}
