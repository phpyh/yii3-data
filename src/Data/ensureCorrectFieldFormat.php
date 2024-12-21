<?php

declare(strict_types=1);

namespace Yii3DataStream\Data;

/**
 * @api
 */
function ensureCorrectFieldFormat(mixed $value): null|bool|int|float|string|\Stringable
{
    if ($value === null || \is_scalar($value) || $value instanceof \Stringable) {
        return $value;
    }

    throw new UnexpectedFieldValueType($value, 'null|scalar|Stringable');
}
