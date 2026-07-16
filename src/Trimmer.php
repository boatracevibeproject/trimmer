<?php

declare(strict_types=1);

namespace BVP\Trimmer;

use Closure;

/**
 * @author shimomo
 */
final class Trimmer
{
    private const DEFAULT_CHARACTERS = "\x00\x09\x0A\x0B\x0D\x20";

    /**
     * @param mixed $items
     * @param ?string $characters
     * @param ?string $encoding
     * @param bool $trimKeys
     * @return ($items is string ? string : ($items is array ? array<array-key, mixed> : mixed))
     */
    public static function trim(
        mixed $items,
        ?string $characters = null,
        ?string $encoding = null,
        bool $trimKeys = false,
    ): mixed {
        /** @psalm-suppress MixedReturnStatement */
        return self::apply(self::trimmer('trim', $characters, $encoding), $items, $trimKeys);
    }

    /**
     * @param mixed $items
     * @param ?string $characters
     * @param ?string $encoding
     * @param bool $trimKeys
     * @return ($items is string ? string : ($items is array ? array<array-key, mixed> : mixed))
     */
    public static function ltrim(
        mixed $items,
        ?string $characters = null,
        ?string $encoding = null,
        bool $trimKeys = false,
    ): mixed {
        /** @psalm-suppress MixedReturnStatement */
        return self::apply(self::trimmer('ltrim', $characters, $encoding), $items, $trimKeys);
    }

    /**
     * @param mixed $items
     * @param ?string $characters
     * @param ?string $encoding
     * @param bool $trimKeys
     * @return ($items is string ? string : ($items is array ? array<array-key, mixed> : mixed))
     */
    public static function rtrim(
        mixed $items,
        ?string $characters = null,
        ?string $encoding = null,
        bool $trimKeys = false,
    ): mixed {
        /** @psalm-suppress MixedReturnStatement */
        return self::apply(self::trimmer('rtrim', $characters, $encoding), $items, $trimKeys);
    }

    /**
     * @param mixed $items
     * @param ?string $characters
     * @param ?string $encoding
     * @param bool $trimKeys
     * @return ($items is string ? string : ($items is array ? array<array-key, mixed> : mixed))
     */
    public static function trimStart(
        mixed $items,
        ?string $characters = null,
        ?string $encoding = null,
        bool $trimKeys = false,
    ): mixed {
        /** @psalm-suppress MixedReturnStatement */
        return self::ltrim($items, $characters, $encoding, $trimKeys);
    }

    /**
     * @param mixed $items
     * @param ?string $characters
     * @param ?string $encoding
     * @param bool $trimKeys
     * @return ($items is string ? string : ($items is array ? array<array-key, mixed> : mixed))
     */
    public static function trimEnd(
        mixed $items,
        ?string $characters = null,
        ?string $encoding = null,
        bool $trimKeys = false,
    ): mixed {
        /** @psalm-suppress MixedReturnStatement */
        return self::rtrim($items, $characters, $encoding, $trimKeys);
    }

    /**
     * @param 'trim'|'ltrim'|'rtrim' $mode
     * @param ?string $characters
     * @param ?string $encoding
     * @return \Closure
     */
    private static function trimmer(
        string $mode,
        ?string $characters,
        ?string $encoding,
    ): Closure {
        if (PHP_VERSION_ID >= 80400) {
            $mbMode = match ($mode) {
                'trim' => 'mb_trim',
                'ltrim' => 'mb_ltrim',
                'rtrim' => 'mb_rtrim',
            };
            /** @var callable(string, ?string, ?string): string $mbMode */
            return static fn(string $value): string => $mbMode($value, $characters, $encoding);
        }

        $fallbackCharacters = $characters ?? self::DEFAULT_CHARACTERS;
        /** @var callable(string, string): string $mode */
        return static fn(string $value): string => $mode($value, $fallbackCharacters);
    }

    /**
     * @param \Closure $function
     * @param mixed $items
     * @param bool $trimKeys
     * @return mixed
     */
    private static function apply(
        Closure $function,
        mixed $items,
        bool $trimKeys,
    ): mixed {
        return match (true) {
            is_string($items) => $function($items),
            is_array($items) => self::applyArray($function, $items, $trimKeys),
            default => $items,
        };
    }

    /**
     * @param \Closure $function
     * @param array<array-key, mixed> $items
     * @param bool $trimKeys
     * @return array<array-key, mixed>
     */
    private static function applyArray(
        Closure $function,
        array $items,
        bool $trimKeys,
    ): array {
        $newItems = [];

        /** @var mixed $value */
        foreach ($items as $key => $value) {
            /** @var mixed $newKey */
            $newKey = ($trimKeys && is_string($key)) ? $function($key) : $key;

            /**
             * @psalm-suppress MixedArrayOffset
             * @psalm-suppress MixedAssignment
             */
            $newItems[$newKey] = self::apply($function, $value, $trimKeys);
        }

        return $newItems;
    }
}
