<?php

declare(strict_types=1);

namespace VUdaltsov\Yii3DataExperiment\Data\Filter;

use VUdaltsov\Yii3DataExperiment\Data\Filter;
use VUdaltsov\Yii3DataExperiment\Data\FilterVisitor;

/**
 * @api
 */
final readonly class Not implements Filter
{
    public function __construct(
        public Filter $filter,
    ) {}

    public function accept(FilterVisitor $visitor): mixed
    {
        return $visitor->not($this);
    }
}
