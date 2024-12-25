<?php

declare(strict_types=1);

namespace VUdaltsov\Yii3DataExperiment\Data;

use PHPUnit\Framework\Assert;

/**
 * @param list<array|object> $expected
 * @param iterable<array|object> $actual
 */
function assertEntitiesEqual(array $expected, iterable $actual, string $message = ''): void
{
    /** @psalm-suppress InvalidArgument */
    $actualAsArray = iterator_to_array($actual, preserve_keys: false);

    Assert::assertEquals($expected, $actualAsArray, $message);
}
