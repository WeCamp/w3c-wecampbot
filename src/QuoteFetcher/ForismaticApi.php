<?php

declare(strict_types=1);


namespace QuoteFetcher;

use Throwable;

final class ForismaticApi implements QuoteFetcher
{
    private $sourceUrl = 'http://api.forismatic.com/api/1.0/?method=getQuote&format=json&lang=en';

    public function getQuote(): Quote
    {
        try {
            $result = file_get_contents($this->sourceUrl);
            $response = json_decode($result, true);
        } catch (Throwable $exception) {
            throw CouldNotFetchQuote::becauseReasons($exception->getMessage());
        }

        return new Quote($response['quoteText'], $response['quoteAuthor']);
    }
}
