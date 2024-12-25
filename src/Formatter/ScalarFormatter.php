<?php

declare(strict_types=1);

namespace VUdaltsov\Yii3DataExperiment\Formatter;

/**
 * @api
 */
final readonly class ScalarFormatter implements Formatter
{
    public function format(mixed $value): ?string
    {
        if (\is_scalar($value)) {
            return (string) $value;
        }

        return null;
    }
}
