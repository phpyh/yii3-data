<?php

declare(strict_types=1);

namespace VUdaltsov\Yii3DataExperiment\Data;

use VUdaltsov\Yii3DataExperiment\Data\Filter\AndX;
use VUdaltsov\Yii3DataExperiment\Data\Filter\Equals;
use VUdaltsov\Yii3DataExperiment\Data\Filter\Greater;
use VUdaltsov\Yii3DataExperiment\Data\Filter\Less;
use VUdaltsov\Yii3DataExperiment\Data\Filter\None;
use VUdaltsov\Yii3DataExperiment\Data\Filter\Not;
use VUdaltsov\Yii3DataExperiment\Data\Filter\OrX;

/**
 * @api
 * @template-covariant TResult
 */
interface FilterVisitor
{
    /**
     * @return TResult
     */
    public function none(None $filter): mixed;

    /**
     * @return TResult
     */
    public function equals(Equals $filter): mixed;

    /**
     * @return TResult
     */
    public function less(Less $filter): mixed;

    /**
     * @return TResult
     */
    public function greater(Greater $filter): mixed;

    /**
     * @return TResult
     */
    public function and(AndX $filter): mixed;

    /**
     * @return TResult
     */
    public function or(OrX $filter): mixed;

    /**
     * @return TResult
     */
    public function not(Not $filter): mixed;
}
