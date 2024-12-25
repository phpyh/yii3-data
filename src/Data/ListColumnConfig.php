<?php

declare(strict_types=1);

namespace VUdaltsov\Yii3DataExperiment\Data;

/**
 * @api
 * @template TEntity of array|object
 */
final readonly class ListColumnConfig
{
    /**
     * @param int|non-empty-string $field
     * @param ?non-empty-string $name
     */
    public static function fromField(int|string $field, ?string $name = null): self
    {
        $accessor = new AnyFieldAccessor();

        return new self(
            name: $name ?? (string) $field,
            value: static fn(array|object $entity): mixed => $accessor->get($entity, $field),
            ascSort: new Sort([$field => SortDirection::Asc]),
        );
    }

    /**
     * @param non-empty-string $name
     * @param \Closure(TEntity): mixed $value
     */
    public function __construct(
        public string $name,
        public \Closure $value,
        public Sort $ascSort = new Sort(),
    ) {}
}
