<?php

declare(strict_types=1);

namespace Yii3DataStream\Data;

/**
 * @api
 */
final class UnexpectedFieldValueType extends \UnexpectedValueException
{
    public function __construct(mixed $value, string $expectedType, ?\Throwable $previous = null)
    {
        parent::__construct(\sprintf('Expected %s, got %s', $expectedType, get_debug_type($value)), previous: $previous);
    }
}
