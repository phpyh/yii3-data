<?php

declare(strict_types=1);

namespace VUdaltsov\Yii3DataExperiment\Data;

use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(InMemoryRepository::class)]
final class InMemoryRepositoryTest extends RepositoryTestCase
{
    protected function createRepository(array $entities): Repository
    {
        return new InMemoryRepository($entities);
    }
}
