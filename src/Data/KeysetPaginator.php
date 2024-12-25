<?php

declare(strict_types=1);

namespace VUdaltsov\Yii3DataExperiment\Data;

use VUdaltsov\Yii3DataExperiment\Data\Filter\All;
use VUdaltsov\Yii3DataExperiment\Data\Filter\AndX;
use VUdaltsov\Yii3DataExperiment\Data\Filter\Field;
use VUdaltsov\Yii3DataExperiment\Data\Filter\Greater;
use VUdaltsov\Yii3DataExperiment\Data\Filter\Less;

/**
 * @api
 * @template-covariant TEntity of array|object
 */
final readonly class KeysetPaginator
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
     * @param ?non-empty-array $previousPageLastValues
     * @return iterable<TEntity>
     */
    public function queryNextPage(
        ?array $previousPageLastValues = null,
        Filter $filter = All::Filter,
        Sort $sort = new Sort(),
    ): iterable {
        if ($previousPageLastValues !== null) {
            $filter = new AndX([...array_map(
                static fn(int|string $field, mixed $value): Filter => match ($sort->fieldDirections[$field] ?? SortDirection::Asc) {
                    SortDirection::Asc => new Greater(new Field($field), $value),
                    SortDirection::Desc => new Less(new Field($field), $value),
                },
                array_keys($previousPageLastValues),
                $previousPageLastValues,
            ), $filter]);
        }

        return $this->repository->query($filter, $sort, limit: $this->pageSize);
    }

    /**
     * @param ?non-empty-array $nextPageFirstValues
     * @return iterable<TEntity>
     */
    public function queryPreviousPage(
        ?array $nextPageFirstValues = null,
        Filter $filter = All::Filter,
        Sort $sort = new Sort(),
    ): iterable {
        if ($nextPageFirstValues !== null) {
            $filter = new AndX([...array_map(
                static fn(int|string $field, mixed $value): Filter => match ($sort->fieldDirections[$field] ?? SortDirection::Asc) {
                    SortDirection::Asc => new Less(new Field($field), $value),
                    SortDirection::Desc => new Greater(new Field($field), $value),
                },
                array_keys($nextPageFirstValues),
                $nextPageFirstValues,
            ), $filter]);
        }

        return $this->repository->query($filter, $sort, limit: $this->pageSize);
    }
}
