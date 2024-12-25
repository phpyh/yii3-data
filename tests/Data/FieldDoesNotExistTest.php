<?php

declare(strict_types=1);

namespace VUdaltsov\Yii3DataExperiment\Data;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\TestCase;

#[CoversClass(FieldDoesNotExist::class)]
final class FieldDoesNotExistTest extends TestCase
{
    #[TestWith([[], 'a', 'Key array{}[a] does not exist'])]
    #[TestWith([['a' => 1], 'b', 'Key array{a: int}[b] does not exist'])]
    #[TestWith([[new \stdClass()], 'b', 'Key array{0: stdClass}[b] does not exist'])]
    public function testArrayKey(array $array, int|string $key, string $expectedMessage): void
    {
        $exception = FieldDoesNotExist::arrayKey($array, $key);

        self::assertSame($expectedMessage, $exception->getMessage());
    }
}
