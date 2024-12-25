<?php

declare(strict_types=1);

namespace VUdaltsov\Yii3DataExperiment\Data\Filter;

/**
 * @api
 */
final readonly class Field
{
    public function __construct(
        public int|string $field,
    ) {}
}
