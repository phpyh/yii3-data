<?php

declare(strict_types=1);

namespace Yii3DataStream\Data\Formatter;

use Yii3DataStream\Data\Formatter;

/**
 * @api
 */
final readonly class StringableFormatter implements Formatter
{
    public function format(mixed $value): ?string
    {
        if ($value instanceof \Stringable) {
            return (string) $value;
        }

        return null;
    }
}
