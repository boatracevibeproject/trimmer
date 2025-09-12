<?php

declare(strict_types=1);

namespace BVP\Trimmer;

/**
 * @author shimomo
 */
interface TrimmerCoreInterface
{
    /**
     * @psalm-param mixed $items
     * @psalm-param string|null $characters
     * @psalm-param string|null $encoding
     * @psalm-return mixed
     *
     * @param mixed $items
     * @param string|null $characters
     * @param string|null $encoding
     * @return mixed
     */
    public function trim(
        mixed $items,
        ?string $characters = null,
        ?string $encoding = null
    ): mixed;

    /**
     * @psalm-param mixed $items
     * @psalm-param string|null $characters
     * @psalm-param string|null $encoding
     * @psalm-return mixed
     *
     * @param mixed $items
     * @param string|null $characters
     * @param string|null $encoding
     * @return mixed
     */
    public function ltrim(
        mixed $items,
        ?string $characters = null,
        ?string $encoding = null
    ): mixed;

    /**
     * @psalm-param mixed $items
     * @psalm-param string|null $characters
     * @psalm-param string|null $encoding
     * @psalm-return mixed
     *
     * @param mixed $items
     * @param string|null $characters
     * @param string|null $encoding
     * @return mixed
     */
    public function rtrim(
        mixed $items,
        ?string $characters = null,
        ?string $encoding = null
    ): mixed;
}
