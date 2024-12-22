<?php

declare(strict_types=1);

namespace VUdaltsov\Yii3DataExperiment\Data\Formatter;

use VUdaltsov\Yii3DataExperiment\Data\Formatter;

/**
 * @api
 */
final readonly class DateTimeFormatter implements Formatter
{
    public function __construct(
        private string $format = 'd.m.Y H:i:s',
    ) {}

    public function format(mixed $value): ?string
    {
        if ($value instanceof \DateTimeInterface) {
            return $value->format($this->format);
        }

        return null;
    }
}
