<?php

declare(strict_types=1);

namespace BVP\Trimmer;

use DeepCopy\DeepCopy;

/**
 * @psalm-method static mixed trim(mixed $items, ?string $characters = null, ?string $encoding = null)
 * @psalm-method static mixed ltrim(mixed $items, ?string $characters = null, ?string $encoding = null)
 * @psalm-method static mixed rtrim(mixed $items, ?string $characters = null, ?string $encoding = null)
 * @psalm-method static mixed trimStart(mixed $items, ?string $characters = null, ?string $encoding = null)
 * @psalm-method static mixed trimEnd(mixed $items, ?string $characters = null, ?string $encoding = null)
 *
 * @method static mixed trim(mixed $items, ?string $characters = null, ?string $encoding = null)
 * @method static mixed ltrim(mixed $items, ?string $characters = null, ?string $encoding = null)
 * @method static mixed rtrim(mixed $items, ?string $characters = null, ?string $encoding = null)
 * @method static mixed trimStart(mixed $items, ?string $characters = null, ?string $encoding = null)
 * @method static mixed trimEnd(mixed $items, ?string $characters = null, ?string $encoding = null)
 *
 * @author shimomo
 */
final class Trimmer implements TrimmerInterface
{
    /**
     * @psalm-var ?\BVP\Trimmer\TrimmerInterface
     *
     * @var ?\BVP\Trimmer\TrimmerInterface
     */
    private static ?TrimmerInterface $instance;

    /**
     * @psalm-param \BVP\Trimmer\TrimmerCoreInterface $trimmer
     *
     * @param \BVP\Trimmer\TrimmerCoreInterface $trimmer
     */
    public function __construct(private readonly TrimmerCoreInterface $trimmer)
    {
        //
    }

    /**
     * @psalm-param non-empty-string $name
     * @psalm-param list<mixed> $arguments
     * @psalm-return mixed
     *
     * @param string $name
     * @param array $arguments
     * @return mixed
     */
    public function __call(string $name, array $arguments): mixed
    {
        return $this->trimmer->$name(...$arguments);
    }

    /**
     * @psalm-param non-empty-string $name
     * @psalm-param list<mixed> $arguments
     * @psalm-return mixed
     *
     * @param string $name
     * @param array $arguments
     * @return mixed
     */
    public static function __callStatic(string $name, array $arguments): mixed
    {
        return self::getInstance()->$name(...$arguments);
    }

    /**
     * @psalm-param ?\BVP\Trimmer\TrimmerCoreInterface $trimmerCore
     * @psalm-return \BVP\Trimmer\TrimmerInterface
     *
     * @param ?\BVP\Trimmer\TrimmerCoreInterface $trimmerCore
     * @return \BVP\Trimmer\TrimmerInterface
     */
    #[\Override]
    public static function getInstance(?TrimmerCoreInterface $trimmerCore = null): TrimmerInterface
    {
        return self::$instance ??= new self($trimmerCore ?? new TrimmerCore(new DeepCopy()));
    }

    /**
     * @psalm-param ?\BVP\Trimmer\TrimmerCoreInterface $trimmerCore
     * @psalm-return \BVP\Trimmer\TrimmerInterface
     *
     * @param ?\BVP\Trimmer\TrimmerCoreInterface $trimmerCore
     * @return \BVP\Trimmer\TrimmerInterface
     */
    #[\Override]
    public static function createInstance(?TrimmerCoreInterface $trimmerCore = null): TrimmerInterface
    {
        return self::$instance = new self($trimmerCore ?? new TrimmerCore(new DeepCopy()));
    }

    /**
     * @psalm-return void
     *
     * @return void
     */
    #[\Override]
    public static function resetInstance(): void
    {
        self::$instance = null;
    }
}
