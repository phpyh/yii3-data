<?php

declare(strict_types=1);

namespace VUdaltsov\Yii3DataExperiment\Data;

/**
 * @api
 */
interface Filter
{
    /**
     * @template TResult
     * @param FilterVisitor<TResult> $visitor
     * @return TResult
     */
    public function accept(FilterVisitor $visitor): mixed;
}
