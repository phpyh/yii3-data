<?php

declare(strict_types=1);

namespace Yii3DataStream\Data;

/**
 * @api
 */
final readonly class Sort
{
    /**
     * @param array<non-empty-string, SortDirection> $fieldDirections
     */
    public function __construct(
        public array $fieldDirections = [],
    ) {}

    public function reverse(): self
    {
        return new self(array_map(
            static fn(SortDirection $direction): SortDirection => $direction->reverse(),
            $this->fieldDirections,
        ));
    }
}
