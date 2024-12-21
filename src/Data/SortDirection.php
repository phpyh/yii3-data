<?php

declare(strict_types=1);

namespace Yii3DataStream\Data;

/**
 * @api
 */
enum SortDirection
{
    case Asc;
    case Desc;

    public function reverse(): self
    {
        return match ($this) {
            self::Asc => self::Desc,
            self::Desc => self::Asc,
        };
    }
}
