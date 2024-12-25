<?php

declare(strict_types=1);

namespace VUdaltsov\Yii3DataExperiment\Data;

/**
 * @api
 */
final readonly class AnyFieldAccessor implements FieldAccessor
{
    public function get(object|array $entity, int|string $field): mixed
    {
        if (\is_array($entity)) {
            if (\array_key_exists($field, $entity)) {
                return $entity[$field];
            }

            throw FieldDoesNotExist::arrayKey($entity, $field);
        }

        $property = (string) $field;

        try {
            $reflectionProperty = new \ReflectionProperty($entity, $property);
        } catch (\ReflectionException $exception) {
            throw FieldDoesNotExist::property($entity::class, $property, $exception);
        }

        return $reflectionProperty->getValue($entity);
    }
}
