<?php

declare(strict_types=1);

namespace BVP\Trimmer;

/**
 * @author shimomo
 */
interface TrimmerCoreInterface
{
    /**
     * @param  mixed   $items
     * @param  string  $characters
     * @return mixed
     */
    public function trim(
        mixed $items,
        ?string $characters = null,
        ?string $encoding = null
    ): mixed;

    /**
     * @param  mixed   $items
     * @param  string  $characters
     * @return mixed
     */
    public function ltrim(
        mixed $items,
        ?string $characters = null,
        ?string $encoding = null
    ): mixed;

    /**
     * @param  mixed   $items
     * @param  string  $characters
     * @return mixed
     */
    public function rtrim(
        mixed $items,
        ?string $characters = null,
        ?string $encoding = null
    ): mixed;
}
