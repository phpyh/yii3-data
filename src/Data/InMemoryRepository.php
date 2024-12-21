<?php

declare(strict_types=1);

namespace Yii3DataStream\Data;

/**
 * @api
 * @template TEntity of array|object
 * @implements Repository<TEntity>
 */
final readonly class InMemoryRepository implements Repository
{
    /**
     * @param array<TEntity> $entities
     */
    public function __construct(
        private array $entities,
    ) {}

    public function query(int $offset = 0, ?int $limit = null, Sort $sort = new Sort()): iterable
    {
        return \array_slice(
            $this->entities,
            $offset,
            $limit,
        );
    }
}
