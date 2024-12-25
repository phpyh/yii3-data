<?php

declare(strict_types=1);

namespace VUdaltsov\Yii3DataExperiment\Data;

/**
 * @api
 */
interface FieldAccessor
{
    public function get(array|object $entity, int|string $field): mixed;
}
