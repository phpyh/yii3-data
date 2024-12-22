<?php

declare(strict_types=1);

namespace VUdaltsov\Yii3DataExperiment\Data\Formatter;

use VUdaltsov\Yii3DataExperiment\Data\Formatter;

/**
 * @api
 */
final readonly class Formatters implements Formatter
{
    /**
     * @param iterable<Formatter> $formatters
     */
    public function __construct(
        private iterable $formatters = [],
    ) {}

    public function format(mixed $value): ?string
    {
        foreach ($this->formatters as $formatter) {
            $formatted = $formatter->format($value);

            if ($formatted !== null) {
                return $formatted;
            }
        }

        return null;
    }
}
