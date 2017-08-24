<?php

declare(strict_types=1);


namespace QuoteFetcher;

final class Quote
{
    private $quote;
    private $author;

    private function __construct(string $quote, string $author)
    {
        $this->quote = $quote;
        $this->author = $author;
    }

    public function __toString()
    {
        return "{$this->quote} - {$this->author}";
    }

    public static function fromForismaticApi(array $response)
    {
        return new self($response['quoteText'], $response['quoteAuthor']);
    }
}
