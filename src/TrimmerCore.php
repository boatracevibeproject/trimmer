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
     * @param  string  $characters
     * @return mixed
     */
    #[\Override]
    public function trim(mixed $items, string $characters = "\x00\x09\x0A\x0B\x0D\x20"): mixed
    {
        $function = fn(string $value, string $characters): mixed => trim($value, $characters);
        /** @var mixed $copyItems */
        $copyItems = $this->copier->copy($items);
        return $this->applyTrim($function, $copyItems, $characters);
    }

    /**
     * @param  mixed   $items
     * @param  string  $characters
     * @return mixed
     */
    #[\Override]
    public function ltrim(mixed $items, string $characters = "\x00\x09\x0A\x0B\x0D\x20"): mixed
    {
        $function = fn(string $value, string $characters): mixed => ltrim($value, $characters);
        /** @var mixed $copyItems */
        $copyItems = $this->copier->copy($items);
        return $this->applyTrim($function, $copyItems, $characters);
    }

    /**
     * @param  mixed   $items
     * @param  string  $characters
     * @return mixed
     */
    #[\Override]
    public function rtrim(mixed $items, string $characters = "\x00\x09\x0A\x0B\x0D\x20"): mixed
    {
        $function = fn(string $value, string $characters): mixed => rtrim($value, $characters);
        /** @var mixed $copyItems */
        $copyItems = $this->copier->copy($items);
        return $this->applyTrim($function, $copyItems, $characters);
    }

    /**
     * @param  callable  $function
     * @param  mixed     $items
     * @param  string    $characters
     * @return mixed
     */
    private function applyTrim(callable $function, mixed $items, string $characters): mixed
    {
        if (is_string($items)) {
            return $function($items, $characters);
        } elseif (is_array($items)) {
            return $this->applyTrimArray($function, $characters, $items);
        } elseif (is_object($items)) {
            return $this->applyTrimObject($function, $characters, $items);
        }

        return $items;
    }

    /**
     * @param  callable                 $function
     * @param  string                   $characters
     * @param  array<array-key, mixed>  $items
     * @return array<array-key, mixed>
     */
    private function applyTrimArray(callable $function, string $characters, array $items): array
    {
        return array_map(fn(mixed $item): mixed => $this->applyTrim($function, $item, $characters), $items);
    }

    /**
     * @param  callable  $function
     * @param  string    $characters
     * @param  object    $items
     * @return object
     */
    private function applyTrimObject(callable $function, string $characters, object $items): object
    {
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
                $trimmedValue = $this->applyTrim($function, $value, $characters);
                if (method_exists($items, $setter)) {
                    $items->$setter($trimmedValue);
                }
            }
        }

        return $items;
    }
}
