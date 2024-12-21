<?php

declare(strict_types=1);

namespace Yii3DataStream\Data;

/**
 * @api
 * @template TEntity of array|object
 */
interface FieldFormatter
{
    /**
     * @param TEntity $entity
     */
    public function format(array|object $entity): null|bool|int|float|string|\Stringable;
}
