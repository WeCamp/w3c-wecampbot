<?php

namespace DogUrlFetcher;

interface DogUrlFetcher
{
    /**
     * @throws CouldNotFetchUrl
     * @return DogUrl
     */
    public function fetchUrl(): DogUrl;
}
