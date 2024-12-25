<?php

declare(strict_types=1);

namespace VUdaltsov\Yii3DataExperiment\Data\Filter;

use VUdaltsov\Yii3DataExperiment\Data\Filter;
use VUdaltsov\Yii3DataExperiment\Data\FilterVisitor;

/**
 * @api
 */
final readonly class OrX implements Filter
{
    /**
     * @param non-empty-list<Filter> $filters
     */
    public function __construct(
        public array $filters,
    ) {}

    public function accept(FilterVisitor $visitor): mixed
    {
        return $visitor->or($this);
    }
}
