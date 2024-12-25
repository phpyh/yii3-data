<?php

declare(strict_types=1);

namespace VUdaltsov\Yii3DataExperiment\Data\Filter;

use VUdaltsov\Yii3DataExperiment\Data\Filter;
use VUdaltsov\Yii3DataExperiment\Data\FilterVisitor;

/**
 * @api
 */
enum All implements Filter
{
    case Filter;

    public function accept(FilterVisitor $visitor): mixed
    {
        /** @var Not */
        static $filter = new Not(None::Filter);

        return $visitor->not($filter);
    }
}
