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

    public function query(Sort $sort = new Sort(), int $offset = 0, ?int $limit = null): iterable
    {
        if (!$sort->isEmpty()) {
            throw new \LogicException(\sprintf('Sorting is not supported in %s', __METHOD__));
        }

        return \array_slice($this->entities, $offset, $limit);
    }
}
