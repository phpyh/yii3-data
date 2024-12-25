<?php

declare(strict_types=1);

namespace VUdaltsov\Yii3DataExperiment\Data;

/**
 * @api
 * @template TEntity of array|object
 */
final readonly class ListConfig
{
    /**
     * @param non-empty-string $name
     * @param non-empty-list<ListColumnConfig<TEntity>> $columns
     */
    public function __construct(
        public string $name,
        public array $columns,
    ) {}
}
