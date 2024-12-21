<?php

declare(strict_types=1);

namespace Yii3DataStream\Data;

/**
 * @api
 * @template TEntity of array|object
 */
final readonly class FieldConfig
{
    /**
     * @template TObject of object
     * @param class-string<TObject> $class
     * @param non-empty-string $name
     * @return self<TObject>
     */
    public static function property(string $class, string $name, Sort $sort = new Sort()): self
    {
        return new self(
            name: $name,
            formatter: new PropertyFieldFormatter($class, $name),
            sort: $sort,
        );
    }

    /**
     * @param non-empty-string $name
     * @param FieldFormatter<TEntity> $formatter
     */
    public function __construct(
        public string $name,
        public FieldFormatter $formatter,
        public Sort $sort = new Sort(),
    ) {}
}
