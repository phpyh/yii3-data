<?php

declare(strict_types=1);

namespace Yii3DataStream\Data;

/**
 * @api
 */
final class PropertyDoesNotExist extends \LogicException
{
    /**
     * @param class-string $class
     * @param non-empty-string $property
     */
    public function __construct(string $class, string $property, ?\Throwable $previous = null)
    {
        parent::__construct(\sprintf('Property %s::$%s does not exist', $class, $property), previous: $previous);
    }
}
