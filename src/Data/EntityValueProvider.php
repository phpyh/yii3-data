<?php

declare(strict_types=1);

namespace VUdaltsov\Yii3DataExperiment\Data;

/**
 * @api
 * @template TEntity of array|object
 */
interface EntityValueProvider
{
    /**
     * @param TEntity $entity
     */
    public function getValue(array|object $entity): mixed;
}
