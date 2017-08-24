<?php

namespace QuoteFetcher;

interface QuoteFetcher
{
    public function getQuote(): Quote;
}
