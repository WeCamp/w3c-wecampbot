<?php

declare(strict_types=1);

namespace DogUrlFetcher;

final class DogUrl
{
    private $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function __toString()
    {
        return $this->url;
    }
}
