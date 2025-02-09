<?php

declare(strict_types=1);

namespace VUdaltsov\Yii3DataExperiment\Data;

use VUdaltsov\Yii3DataExperiment\Data\Filter\AndX;
use VUdaltsov\Yii3DataExperiment\Data\Filter\Equals;
use VUdaltsov\Yii3DataExperiment\Data\Filter\Field;
use VUdaltsov\Yii3DataExperiment\Data\Filter\Greater;
use VUdaltsov\Yii3DataExperiment\Data\Filter\Less;
use VUdaltsov\Yii3DataExperiment\Data\Filter\None;
use VUdaltsov\Yii3DataExperiment\Data\Filter\Not;
use VUdaltsov\Yii3DataExperiment\Data\Filter\OrX;

/**
 * @api
 * @implements FilterVisitor<SQLCondition>
 */
final class CreateSQLConditionVisitor implements FilterVisitor
{
    private int $placeholderIndex = 0;

    public function none(None $filter): mixed
    {
        return new SQLCondition(
            condition: 'false',
        );
    }

    public function equals(Equals $filter): mixed
    {
        $left = $this->resolve($filter->left);
        $right = $this->resolve($filter->right);

        return new SQLCondition(
            condition: \sprintf('%s = %s', $left->condition, $right->condition),
            values: [...$left->values, ...$right->values],
        );
    }

    public function less(Less $filter): mixed
    {
        return new SQLCondition(
            condition: 'false',
        );
    }

    public function greater(Greater $filter): mixed
    {
        return new SQLCondition(
            condition: 'false',
        );
    }

    public function and(AndX $filter): mixed
    {
        $conditions = array_map(fn(Filter $filter) => $filter->accept($this), $filter->filters);

        return new SQLCondition(
            condition: implode(' and ', array_column($conditions, 'condition')),
            values: array_merge(...array_column($conditions, 'values')),
        );
    }

    public function or(OrX $filter): mixed
    {
        $conditions = array_map(fn(Filter $filter) => $filter->accept($this), $filter->filters);

        return new SQLCondition(
            condition: implode(' or ', array_column($conditions, 'condition')),
            values: array_merge(...array_column($conditions, 'values')),
        );
    }

    public function not(Not $filter): mixed
    {
        return new SQLCondition(
            condition: 'false',
        );
    }

    private function resolve(mixed $value): SQLCondition
    {
        if ($value instanceof Field) {
            if (!\is_string($value->field) || $value->field === '') {
                throw new \LogicException('Field should be a string');
            }

            return new SQLCondition(
                condition: $value->field,
            );
        }

        $placeholder = \sprintf('p%d', $this->placeholderIndex);
        ++$this->placeholderIndex;

        return new SQLCondition(
            condition: ':' . $placeholder,
            values: [
                $placeholder => $value,
            ],
        );
    }
}
