<?php

declare(strict_types=1);

namespace DogUrlFetcher;

final class CouldNotFetchUrl extends DomainException
{
    public static function becauseReasons(string $reason)
    {
        return new self($reason);
    }

    public static function becauseStatusIsNotSuccessful(array $response)
    {
        return new self('Expected state "success" got state ' . $response['status']);
    }
}
