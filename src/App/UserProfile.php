<?php

declare(strict_types=1);

namespace VUdaltsov\Yii3DataExperiment\App;

/**
 * @api
 */
final readonly class UserProfile
{
    /**
     * @param non-negative-int $id
     * @param non-empty-string $nickname
     * @param non-empty-string $firstName
     * @param non-empty-string $lastName
     */
    public function __construct(
        public int $id,
        public string $nickname,
        public string $firstName,
        public string $lastName,
        public \DateTimeImmutable $birthday,
    ) {}
}
