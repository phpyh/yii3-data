<?php

declare(strict_types=1);

namespace VUdaltsov\Yii3DataExperiment\Data;

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
        private FieldAccessor $accessor = new AnyFieldAccessor(),
    ) {}

    /**
     * @return list<TEntity>
     */
    public function query(Sort $sort = new Sort(), int $offset = 0, ?int $limit = null): array
    {
        $entities = $this->entities;

        if (!$sort->isEmpty()) {
            usort($entities, $this->createComparator($sort));
        }

        /** @var list<TEntity> */
        return \array_slice($entities, $offset, $limit);
    }

    /**
     * @return \Closure(TEntity, TEntity): int<-1, 1>
     */
    private function createComparator(Sort $sort): \Closure
    {
        return
            /**
             * @param TEntity $a
             * @param TEntity $b
             */
            function (array|object $a, array|object $b) use ($sort): int {
                foreach ($sort->fieldDirections as $field => $direction) {
                    $aValue = $this->accessor->get($a, $field);
                    $bValue = $this->accessor->get($b, $field);
                    $aVsB = $aValue <=> $bValue;

                    if ($aVsB === 0) {
                        continue;
                    }

                    return match ($direction) {
                        SortDirection::Asc => $aVsB,
                        SortDirection::Desc => -$aVsB,
                    };
                }

                return 0;
            };
    }
}
