<?php

declare(strict_types=1);


namespace QuoteFetcher;

final class Quote
{
    private $quote;
    private $author;

    public function __construct(string $quote, string $author)
    {
        $this->quote = $quote;
        $this->author = $author;
    }

    public function __toString()
    {
        return "{$this->quote} - {$this->author}";
    }
}
