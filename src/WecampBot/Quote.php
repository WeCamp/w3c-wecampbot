<?php

declare(strict_types=1);


namespace W3C;

use QuoteFetcher\QuoteFetcher;

final class Quote
{
    /**
     * @var QuoteFetcher
     */
    private $quoteFetcher;

    public function __construct(QuoteFetcher $quoteFetcher)
    {
        $this->quoteFetcher = $quoteFetcher;
    }

    protected function configure()
    {
        $this->setName('!quote');
    }

    protected function execute($message, $context)
    {
        $quote = $this->quoteFetcher->getQuote();
        $this->send($this->getCurrentChannel(), null, (string) $quote);
    }
}
