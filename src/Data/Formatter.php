<?php

declare(strict_types=1);

namespace Yii3DataStream\Data;

/**
 * @api
 */
interface Formatter
{
    /**
     * @return string|null return null to pass value to next formatter
     */
    public function format(mixed $value): ?string;
}
