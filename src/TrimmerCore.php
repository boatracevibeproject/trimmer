<?php

declare(strict_types=1);

namespace BVP\Trimmer;

use DeepCopy\DeepCopy;

/**
 * @author shimomo
 */
final class TrimmerCore implements TrimmerCoreInterface
{
    /**
     * @param  \DeepCopy\DeepCopy  $copier
     * @return void
     */
    public function __construct(private readonly DeepCopy $copier)
    {
        //
    }

    /**
     * @param  string             $name
     * @param  array<int, mixed>  $arguments
     * @return never
     *
     * @throws \BadMethodCallException
     */
    public function __call(string $name, array $arguments): never
    {
        throw new \BadMethodCallException(
            __METHOD__ . "() - Call to undefined method '" . self::class . "::{$name}()'."
        );
    }

    /**
     * @param  mixed   $items
     * @param  string|null  $characters
     * @param  string|null  $encoding
     * @return mixed
     */
    #[\Override]
    public function trim(
        mixed $items,
        ?string $characters = null,
        ?string $encoding = null
    ): mixed {
        if (PHP_VERSION_ID >= 80400) {
            $function = fn(string $value, ?string $characters, ?string $encoding): mixed
                => mb_trim($value, $characters, $encoding);
            /** @var mixed $copyItems */
            $copyItems = $this->copier->copy($items);
            return $this->applyTrim($function, $copyItems, $characters, $encoding);
        }

        $function = fn(string $value, ?string $characters, ?string $encoding = null): mixed
            => trim($value, $characters ?? "\x00\x09\x0A\x0B\x0D\x20");
        /** @var mixed $copyItems */
        $copyItems = $this->copier->copy($items);
        return $this->applyTrim($function, $copyItems, $characters, $encoding);
    }

    /**
     * @param  mixed   $items
     * @param  string|null  $characters
     * @param  string|null  $encoding
     * @return mixed
     */
    #[\Override]
    public function ltrim(
        mixed $items,
        ?string $characters = null,
        ?string $encoding = null
    ): mixed {
        if (PHP_VERSION_ID >= 80400) {
            $function = fn(string $value, ?string $characters, ?string $encoding): mixed
                => mb_ltrim($value, $characters, $encoding);
            /** @var mixed $copyItems */
            $copyItems = $this->copier->copy($items);
            return $this->applyTrim($function, $copyItems, $characters, $encoding);
        }

        $function = fn(string $value, ?string $characters, ?string $encoding = null): mixed
            => ltrim($value, $characters ?? "\x00\x09\x0A\x0B\x0D\x20");
        /** @var mixed $copyItems */
        $copyItems = $this->copier->copy($items);
        return $this->applyTrim($function, $copyItems, $characters, $encoding);
    }

    /**
     * @param  mixed   $items
     * @param  string|null  $characters
     * @param  string|null  $encoding
     * @return mixed
     */
    #[\Override]
    public function rtrim(
        mixed $items,
        ?string $characters = null,
        ?string $encoding = null
    ): mixed {
        if (PHP_VERSION_ID >= 80400) {
            $function = fn(string $value, ?string $characters, ?string $encoding): mixed
                => mb_rtrim($value, $characters, $encoding);
            /** @var mixed $copyItems */
            $copyItems = $this->copier->copy($items);
            return $this->applyTrim($function, $copyItems, $characters, $encoding);
        }

        $function = fn(string $value, ?string $characters, ?string $encoding = null): mixed
            => rtrim($value, $characters ?? "\x00\x09\x0A\x0B\x0D\x20");
        /** @var mixed $copyItems */
        $copyItems = $this->copier->copy($items);
        return $this->applyTrim($function, $copyItems, $characters, $encoding);
    }

    /**
     * @param  callable  $function
     * @param  mixed     $items
     * @param  string|null  $characters
     * @param  string|null  $encoding
     * @return mixed
     */
    private function applyTrim(
        callable $function,
        mixed $items,
        ?string $characters = null,
        ?string $encoding = null
    ): mixed {
        if (is_string($items)) {
            return $function($items, $characters, $encoding);
        } elseif (is_array($items)) {
            return $this->applyTrimArray($function, $items, $characters, $encoding);
        } elseif (is_object($items)) {
            return $this->applyTrimObject($function, $items, $characters, $encoding);
        }

        return $items;
    }

    /**
     * @param  callable                 $function
     * @param  array<array-key, mixed>  $items
     * @param  string                   $characters
     * @param  string|null  $encoding
     * @return array<array-key, mixed>
     */
    private function applyTrimArray(
        callable $function,
        array $items,
        ?string $characters,
        ?string $encoding = null
    ): array {
        return array_map(fn(mixed $item): mixed
            => $this->applyTrim($function, $item, $characters, $encoding), $items);
    }

    /**
     * @param  callable  $function
     * @param  string    $characters
     * @param  object    $items
     * @return object
     */
    private function applyTrimObject(
        callable $function,
        object $items,
        ?string $characters,
        ?string $encoding = null
    ): object {
        $propertyNames = [];
        foreach (get_class_methods($items) as $methodName) {
            if (preg_match('/^get([A-Z].*)$/u', $methodName, $matches)) {
                $propertyNames[] = $matches[1];
            }
        }

        foreach ($propertyNames as $propertyName) {
            $getter = 'get' . $propertyName;
            $setter = 'set' . $propertyName;
            if (method_exists($items, $getter)) {
                /** @var mixed $value */
                $value = $items->$getter();
                /** @var mixed $trimmedValue */
                $trimmedValue = $this->applyTrim($function, $value, $characters, $encoding);
                if (method_exists($items, $setter)) {
                    $items->$setter($trimmedValue);
                }
            }
        }

        return $items;
    }
}
