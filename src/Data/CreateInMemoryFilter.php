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
 * @implements FilterVisitor<\Closure(array|object): bool>
 */
final readonly class CreateInMemoryFilter implements FilterVisitor
{
    public function __construct(
        private FieldAccessor $accessor = new AnyFieldAccessor(),
    ) {}

    public function none(None $filter): mixed
    {
        return static fn(): false => false;
    }

    public function equals(Equals $filter): mixed
    {
        return fn(array|object $entity): bool => $this->resolve($entity, $filter->left) === $this->resolve($entity, $filter->right);
    }

    public function less(Less $filter): mixed
    {
        return fn(array|object $entity): bool => $this->resolve($entity, $filter->left) < $this->resolve($entity, $filter->right);
    }

    public function greater(Greater $filter): mixed
    {
        return fn(array|object $entity): bool => $this->resolve($entity, $filter->left) > $this->resolve($entity, $filter->right);
    }

    public function and(AndX $filter): mixed
    {
        return function (array|object $entity) use ($filter): bool {
            foreach ($filter->filters as $childFilter) {
                if (!$childFilter->accept($this)($entity)) {
                    return false;
                }
            }

            return true;
        };
    }

    public function or(OrX $filter): mixed
    {
        return function (array|object $entity) use ($filter): bool {
            foreach ($filter->filters as $childFilter) {
                if ($childFilter->accept($this)($entity)) {
                    return true;
                }
            }

            return false;
        };
    }

    public function not(Not $filter): mixed
    {
        return fn(array|object $entity): bool => !$filter->filter->accept($this)($entity);
    }

    private function resolve(array|object $entity, mixed $value): mixed
    {
        if ($value instanceof Field) {
            return $this->accessor->get($entity, $value->field);
        }

        return $value;
    }
}
