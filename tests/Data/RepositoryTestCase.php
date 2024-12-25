<?php

declare(strict_types=1);

namespace VUdaltsov\Yii3DataExperiment\Data;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\TestCase;
use VUdaltsov\Yii3DataExperiment\Data\Filter\AndX;
use VUdaltsov\Yii3DataExperiment\Data\Filter\Equals;
use VUdaltsov\Yii3DataExperiment\Data\Filter\Field;
use VUdaltsov\Yii3DataExperiment\Data\Filter\Greater;
use VUdaltsov\Yii3DataExperiment\Data\Filter\Less;
use VUdaltsov\Yii3DataExperiment\Data\Filter\None;
use VUdaltsov\Yii3DataExperiment\Data\Filter\OrX;

#[CoversClass(Repository::class)]
abstract class RepositoryTestCase extends TestCase
{
    /**
     * @param list<array{int}> $entities
     */
    #[TestWith([[]])]
    #[TestWith([[[1], [2], [3]]])]
    #[TestWith([[[2], [4]]])]
    final public function testQueryDefaultCall(array $entities): void
    {
        $repository = $this->createRepository($entities);

        $actual = $repository->query();

        assertEntitiesEqual($entities, $actual);
    }

    /**
     * @param list<array{0: int, 1: string}> $expected
     */
    #[TestWith([None::Filter, []])]
    #[TestWith([new Equals(new Field(0), 1), [[1, 'a']]])]
    #[TestWith([new Equals(3, new Field(0)), [[3, 'c'], [3, 'c_']]])]
    #[TestWith([new Greater(new Field(0), 2), [[3, 'c'], [3, 'c_']]])]
    #[TestWith([new Less(new Field(1), 'c'), [[1, 'a'], [2, 'b']]])]
    #[TestWith([new AndX([new Equals(new Field(0), 1), new Equals(new Field(1), 'c')]), []])]
    #[TestWith([new OrX([new Equals(new Field(0), 1), new Equals(new Field(1), 'b')]), [[1, 'a'], [2, 'b']]])]
    final public function testFilter(Filter $filter, array $expected): void
    {
        $repository = $this->createRepository([
            [1, 'a'],
            [2, 'b'],
            [3, 'c'],
            [3, 'c_'],
        ]);

        $actual = $repository->query(filter: $filter);

        assertEntitiesEqual($expected, $actual);
    }

    final public function testSort(): void
    {
        $repository = $this->createRepository([[1], [2], [3]]);

        $entities = $repository->query(sort: new Sort([0 => SortDirection::Desc]));

        assertEntitiesEqual([[3], [2], [1]], $entities);
    }

    final public function testMultiSort(): void
    {
        $entity2A = [2, 'a'];
        $entity2B = [2, 'b'];
        $entity1C = [1, 'c'];
        $repository = $this->createRepository([$entity2A, $entity2B, $entity1C]);

        $entities = $repository->query(sort: new Sort([0 => SortDirection::Asc, 1 => SortDirection::Desc]));

        assertEntitiesEqual([$entity1C, $entity2B, $entity2A], $entities);
    }

    /**
     * @param non-negative-int $offset
     * @param ?non-negative-int $limit
     * @param list<array{int}> $expected
     */
    #[TestWith([0, 1, [[1]]])]
    #[TestWith([1, 1, [[2]]])]
    #[TestWith([0, 2, [[1], [2]]])]
    #[TestWith([0, 10, [[1], [2], [3]]])]
    #[TestWith([1, 10, [[2], [3]]])]
    #[TestWith([5, 10, []])]
    #[TestWith([0, 0, []])]
    final public function testOffsetLimit(int $offset, ?int $limit, array $expected): void
    {
        $repository = $this->createRepository([[1], [2], [3]]);

        $entities = $repository->query(offset: $offset, limit: $limit);

        assertEntitiesEqual($expected, $entities);
    }

    /**
     * @param list<array{0: int, 1?: string}> $entities
     */
    abstract protected function createRepository(array $entities): Repository;
}
