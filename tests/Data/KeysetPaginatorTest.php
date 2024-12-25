<?php

declare(strict_types=1);

namespace VUdaltsov\Yii3DataExperiment\Data;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\TestCase;

#[CoversClass(KeysetPaginator::class)]
final class KeysetPaginatorTest extends TestCase
{
    /**
     * @param ?array{0: int} $previousPageLastValues
     * @param list<array{int}> $expected
     */
    #[TestWith([null, [[1], [2], [3]]])]
    #[TestWith([[3], [[4], [5], [6]]])]
    #[TestWith([[1], [[2], [3], [4]]])]
    #[TestWith([[9], [[10]]])]
    public function testQueryPageAfter(?array $previousPageLastValues, array $expected): void
    {
        $repository = new InMemoryRepository(array_map(
            static fn(int $id): array => [$id],
            range(1, 10),
        ));
        $paginator = new KeysetPaginator($repository, pageSize: 3);

        $entities =  $paginator->queryNextPage($previousPageLastValues);

        assertEntitiesEqual($expected, $entities);
    }

    /**
     * @param ?array{0: int} $previousPageLastValues
     * @param list<array{int}> $expected
     */
    #[TestWith([null, [[10], [9], [8]]])]
    #[TestWith([[8], [[7], [6], [5]]])]
    #[TestWith([[3], [[2], [1]]])]
    public function testQueryPageAfterDesc(?array $previousPageLastValues, array $expected): void
    {
        $repository = new InMemoryRepository(array_map(
            static fn(int $id): array => [$id],
            range(1, 10),
        ));
        $paginator = new KeysetPaginator($repository, pageSize: 3);

        $entities =  $paginator->queryNextPage($previousPageLastValues, sort: new Sort([0 => SortDirection::Desc]));

        assertEntitiesEqual($expected, $entities);
    }
}
