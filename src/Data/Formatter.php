<?php

declare(strict_types=1);

namespace VUdaltsov\Yii3DataExperiment\Data;

/**
 * @api
 */
interface Formatter
{
    /**
     * @return string|null return null to pass value to next formatter
     */
    public function format(mixed $value): ?string;
}
