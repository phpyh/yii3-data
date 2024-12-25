<?php

declare(strict_types=1);

namespace VUdaltsov\Yii3DataExperiment\Data\Filter;

use VUdaltsov\Yii3DataExperiment\Data\Filter;
use VUdaltsov\Yii3DataExperiment\Data\FilterVisitor;

/**
 * @api
 */
enum None implements Filter
{
    case Filter;

    public function accept(FilterVisitor $visitor): mixed
    {
        return $visitor->none($this);
    }
}
