<?php

declare(strict_types=1);

namespace VUdaltsov\Yii3DataExperiment\Data;

/**
 * @api
 */
final readonly class SQLCondition
{
    /**
     * @param non-empty-string $condition
     * @param array<non-empty-string, mixed> $values
     */
    public function __construct(
        public string $condition,
        public array $values = [],
    ) {}
}
