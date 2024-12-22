<?php

declare(strict_types=1);

namespace VUdaltsov\Yii3DataExperiment\Data;

/**
 * @api
 * @template TEntity of array|object
 * @implements EntityValueProvider<TEntity>
 */
final readonly class CallableEntityValueProvider implements EntityValueProvider
{
    /**
     * @param \Closure(TEntity): mixed $provider
     */
    public function __construct(
        private \Closure $provider,
    ) {}

    public function getValue(object|array $entity): mixed
    {
        return ($this->provider)($entity);
    }
}
