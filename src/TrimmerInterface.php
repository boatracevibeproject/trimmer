<?php

declare(strict_types=1);

namespace BVP\Trimmer;

/**
 * @author shimomo
 */
interface TrimmerInterface
{
    /**
     * @psalm-param \BVP\Trimmer\TrimmerCoreInterface|null $trimmerCore
     * @psalm-return \BVP\Trimmer\TrimmerInterface
     *
     * @param \BVP\Trimmer\TrimmerCoreInterface|null $trimmerCore
     * @return \BVP\Trimmer\TrimmerInterface
     */
    public static function getInstance(?TrimmerCoreInterface $trimmerCore = null): TrimmerInterface;

    /**
     * @psalm-param \BVP\Trimmer\TrimmerCoreInterface|null $trimmerCore
     * @psalm-return \BVP\Trimmer\TrimmerInterface
     *
     * @param \BVP\Trimmer\TrimmerCoreInterface|null $trimmerCore
     * @return \BVP\Trimmer\TrimmerInterface
     */
    public static function createInstance(?TrimmerCoreInterface $trimmerCore = null): TrimmerInterface;

    /**
     * @psalm-return void
     *
     * @return void
     */
    public static function resetInstance(): void;
}
