<?php

declare(strict_types=1);

namespace VUdaltsov\Yii3DataExperiment\Data;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\TestCase;

#[CoversClass(OffsetPaginator::class)]
final class OffsetPaginatorTest extends TestCase
{
    /**
     * @param positive-int $page
     * @param list<array{int}> $expected
     */
    #[TestWith([1, [[1], [2], [3]]])]
    #[TestWith([2, [[4], [5], [6]]])]
    #[TestWith([3, [[7], [8], [9]]])]
    #[TestWith([4, [[10]]])]
    #[TestWith([5, []])]
    public function testQuery(int $page, array $expected): void
    {
        $repository = new InMemoryRepository(array_map(
            static fn(int $id): array => [$id],
            range(1, 10),
        ));
        $paginator = new OffsetPaginator($repository, pageSize: 3);

        $entities = $paginator->queryPage($page);

        assertEntitiesEqual($expected, $entities);
    }
}
