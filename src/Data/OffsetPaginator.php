<?php

declare(strict_types=1);

namespace VUdaltsov\Yii3DataExperiment\Data;

use VUdaltsov\Yii3DataExperiment\Data\Filter\All;

/**
 * @api
 * @template-covariant TEntity of array|object
 */
final readonly class OffsetPaginator
{
    public const int DEFAULT_PAGE_SIZE = 10;

    /**
     * @param Repository<TEntity> $repository
     * @param positive-int $pageSize
     */
    public function __construct(
        private Repository $repository,
        private int $pageSize = self::DEFAULT_PAGE_SIZE,
    ) {}

    /**
     * @param positive-int $pageNumber
     * @return iterable<TEntity>
     */
    public function queryPage(int $pageNumber = 1, Filter $filter = All::Filter, Sort $sort = new Sort()): iterable
    {
        return $this->repository->query(
            filter: $filter,
            sort: $sort,
            offset: ($pageNumber - 1) * $this->pageSize,
            limit: $this->pageSize,
        );
    }

    /**
     * @return non-negative-int
     */
    public function countPages(Filter $filter = All::Filter): int
    {
        $number = (int) ceil($this->repository->count($filter) / $this->pageSize);
        \assert($number >= 0);

        return $number;
    }
}
