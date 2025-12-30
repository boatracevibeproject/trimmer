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
     * @psalm-param \DeepCopy\DeepCopy $copier
     *
     * @param \DeepCopy\DeepCopy $copier
     */
    public function __construct(private readonly DeepCopy $copier)
    {
        //
    }

    /**
     * @psalm-param non-empty-string $name
     * @psalm-param list<mixed> $arguments
     * @psalm-return never
     *
     * @param string $name
     * @param array $arguments
     * @return never
     * @throws \BadMethodCallException
     */
    public function __call(string $name, array $arguments): never
    {
        throw new \BadMethodCallException(
            __METHOD__ . "() - Call to undefined method `" . self::class . "::{$name}()`."
        );
    }

    /**
     * @psalm-param mixed $items
     * @psalm-param ?string $characters
     * @psalm-param ?string $encoding
     * @psalm-return mixed
     *
     * @param mixed $items
     * @param ?string $characters
     * @param ?string $encoding
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
            /** @psalm-var mixed */
            $copyItems = $this->copier->copy($items);
            return $this->applyTrim($function, $copyItems, $characters, $encoding);
        }

        $function = fn(string $value, ?string $characters, ?string $encoding = null): mixed
            => trim($value, $characters ?? "\x00\x09\x0A\x0B\x0D\x20");
        /** @psalm-var mixed */
        $copyItems = $this->copier->copy($items);
        return $this->applyTrim($function, $copyItems, $characters, $encoding);
    }

    /**
     * @psalm-param mixed $items
     * @psalm-param ?string $characters
     * @psalm-param ?string $encoding
     * @psalm-return mixed
     *
     * @param mixed $items
     * @param ?string $characters
     * @param ?string $encoding
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
            /** @psalm-var mixed */
            $copyItems = $this->copier->copy($items);
            return $this->applyTrim($function, $copyItems, $characters, $encoding);
        }

        $function = fn(string $value, ?string $characters, ?string $encoding = null): mixed
            => ltrim($value, $characters ?? "\x00\x09\x0A\x0B\x0D\x20");
        /** @psalm-var mixed */
        $copyItems = $this->copier->copy($items);
        return $this->applyTrim($function, $copyItems, $characters, $encoding);
    }

    /**
     * @psalm-param mixed $items
     * @psalm-param ?string $characters
     * @psalm-param ?string $encoding
     * @psalm-return mixed
     *
     * @param mixed $items
     * @param ?string $characters
     * @param ?string $encoding
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
            /** @psalm-var mixed */
            $copyItems = $this->copier->copy($items);
            return $this->applyTrim($function, $copyItems, $characters, $encoding);
        }

        $function = fn(string $value, ?string $characters, ?string $encoding = null): mixed
            => rtrim($value, $characters ?? "\x00\x09\x0A\x0B\x0D\x20");
        /** @psalm-var mixed */
        $copyItems = $this->copier->copy($items);
        return $this->applyTrim($function, $copyItems, $characters, $encoding);
    }

    /**
     * @psalm-param mixed $items
     * @psalm-param ?string $characters
     * @psalm-param ?string $encoding
     * @psalm-return mixed
     *
     * @param mixed $items
     * @param ?string $characters
     * @param ?string $encoding
     * @return mixed
     */
    #[\Override]
    public function trimStart(
        mixed $items,
        ?string $characters = null,
        ?string $encoding = null
    ): mixed {
        return $this->ltrim($items, $characters, $encoding);
    }

    /**
     * @psalm-param mixed $items
     * @psalm-param ?string $characters
     * @psalm-param ?string $encoding
     * @psalm-return mixed
     *
     * @param mixed $items
     * @param ?string $characters
     * @param ?string $encoding
     * @return mixed
     */
    #[\Override]
    public function trimEnd(
        mixed $items,
        ?string $characters = null,
        ?string $encoding = null
    ): mixed {
        return $this->rtrim($items, $characters, $encoding);
    }

    /**
     * @psalm-param callable $function
     * @psalm-param mixed $items
     * @psalm-param ?string $characters
     * @psalm-param ?string $encoding
     * @psalm-return mixed
     *
     * @param callable $function
     * @param mixed $items
     * @param ?string $characters
     * @param ?string $encoding
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
     * @psalm-param callable $function
     * @psalm-param array<array-key, mixed> $items
     * @psalm-param ?string $characters
     * @psalm-param ?string $encoding
     * @psalm-return array<array-key, mixed>
     *
     * @param callable $function
     * @param array $items
     * @param ?string $characters
     * @param ?string $encoding
     * @return array
     */
    private function applyTrimArray(
        callable $function,
        array $items,
        ?string $characters = null,
        ?string $encoding = null
    ): array {
        return array_map(fn(mixed $item): mixed
            => $this->applyTrim($function, $item, $characters, $encoding), $items);
    }

    /**
     * @psalm-param callable $function
     * @psalm-param object $items
     * @psalm-param ?string $characters
     * @psalm-param ?string $encoding
     * @psalm-return object
     *
     * @param callable $function
     * @param object $items
     * @param ?string $characters
     * @param ?string $encoding
     * @return object
     */
    private function applyTrimObject(
        callable $function,
        object $items,
        ?string $characters = null,
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
                /** @psalm-var mixed */
                $value = $items->$getter();
                /** @psalm-var mixed */
                $trimmedValue = $this->applyTrim($function, $value, $characters, $encoding);
                if (method_exists($items, $setter)) {
                    $items->$setter($trimmedValue);
                }
            }
        }

        return $items;
    }
}
