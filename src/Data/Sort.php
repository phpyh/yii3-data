<?php

declare(strict_types=1);

namespace VUdaltsov\Yii3DataExperiment\Data;

/**
 * @api
 */
final readonly class Sort
{
    /**
     * @param array<SortDirection> $fieldDirections
     */
    public function __construct(
        public array $fieldDirections = [],
    ) {}

    public function isEmpty(): bool
    {
        return $this->fieldDirections === [];
    }

    public function reverse(): self
    {
        return new self(array_map(
            static fn(SortDirection $direction): SortDirection => $direction->reverse(),
            $this->fieldDirections,
        ));
    }
}
