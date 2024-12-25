<?php

declare(strict_types=1);

namespace VUdaltsov\Yii3DataExperiment\Data;

/**
 * @api
 */
final class FieldDoesNotExist extends \LogicException
{
    /**
     * @param class-string $class
     */
    public static function property(string $class, string $property, ?\Throwable $previous = null): self
    {
        return new self(\sprintf('Property %s::$%s does not exist', $class, $property), previous: $previous);
    }

    public static function arrayKey(array $array, int|string $key, ?\Throwable $previous = null): self
    {
        return new self(
            \sprintf(
                'Key array{%s}[%s] does not exist',
                implode(', ', array_map(
                    static fn(int|string $key, mixed $value): string => \sprintf('%s: %s', $key, get_debug_type($value)),
                    array_keys($array),
                    $array,
                )),
                $key,
            ),
            previous: $previous,
        );
    }
}
