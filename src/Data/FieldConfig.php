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
     * @param non-empty-string $name
     * @param FieldFormatter<TEntity> $formatter
     */
    public function __construct(
        public string $name,
        public FieldFormatter $formatter,
        public Sort $sort = new Sort(),
    ) {}
}
