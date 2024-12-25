<?php

declare(strict_types=1);

namespace VUdaltsov\Yii3DataExperiment\Data;

use VUdaltsov\Yii3DataExperiment\Data\Filter\All;

/**
 * @api
 * @template-covariant TEntity of array|object
 */
interface Repository
{
    /**
     * @param non-negative-int $offset
     * @param ?non-negative-int $limit
     * @return iterable<TEntity>
     */
    public function query(
        Filter $filter = All::Filter,
        Sort $sort = new Sort(),
        int $offset = 0,
        ?int $limit = null,
    ): iterable;
}
