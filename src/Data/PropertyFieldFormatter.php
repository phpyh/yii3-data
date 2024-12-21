<?php

declare(strict_types=1);

namespace Yii3DataStream\Data;

/**
 * @api
 * @template TEntity of object
 * @implements FieldFormatter<TEntity>
 */
final readonly class PropertyFieldFormatter implements FieldFormatter
{
    /**
     * @param non-empty-string $property
     */
    public function __construct(
        private string $property,
    ) {}

    public function format(object|array $entity): null|bool|int|float|string|\Stringable
    {
        try {
            $property = new \ReflectionProperty($entity, $this->property);
        } catch (\ReflectionException $exception) {
            throw new PropertyDoesNotExist($entity::class, $this->property, $exception);
        }

        return ensureCorrectFieldFormat($property->getValue($entity));
    }
}
