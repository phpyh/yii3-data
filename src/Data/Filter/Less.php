<?php

declare(strict_types=1);

namespace VUdaltsov\Yii3DataExperiment\Data\Filter;

use VUdaltsov\Yii3DataExperiment\Data\Filter;
use VUdaltsov\Yii3DataExperiment\Data\FilterVisitor;

/**
 * @api
 */
final readonly class Less implements Filter
{
    public function __construct(
        public mixed $left,
        public mixed $right,
    ) {}

    public function accept(FilterVisitor $visitor): mixed
    {
        return $visitor->less($this);
    }
}
