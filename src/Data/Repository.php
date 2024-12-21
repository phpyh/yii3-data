<?php

declare(strict_types=1);

namespace Yii3DataStream\Data;

/**
 * @api
 * @template-covariant TEntity of array|object
 */
interface Repository
{
    /**
     * @param ?non-negative-int $limit
     * @return iterable<TEntity>
     */
    public function query(Sort $sort = new Sort(), int $offset = 0, ?int $limit = null): iterable;
}
