<?php

declare(strict_types=1);


namespace QuoteFetcher;

use DomainException;

final class CouldNotFetchQuote extends DomainException
{
    public static function becauseReasons(string $reason)
    {
        return new self($reason);
    }
}
