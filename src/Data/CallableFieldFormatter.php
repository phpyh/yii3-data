<?php

declare(strict_types=1);

namespace Yii3DataStream\Data;

/**
 * @api
 * @template TEntity of array|object
 * @implements FieldFormatter<TEntity>
 */
final readonly class CallableFieldFormatter implements FieldFormatter
{
    /**
     * @param \Closure(TEntity): (null|bool|int|float|string|\Stringable) $formatter
     */
    public function __construct(
        private \Closure $formatter,
    ) {}

    public function format(object|array $entity): null|bool|int|float|string|\Stringable
    {
        return ($this->formatter)($entity);
    }
}
