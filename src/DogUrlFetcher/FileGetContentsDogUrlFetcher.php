<?php

declare(strict_types=1);

namespace DogUrlFetcher;

use Throwable;

final class FileGetContentsDogUrlFetcher implements DogUrlFetcher
{
    private $sourceUrl = 'https://dog.ceo/api/breed/labrador/images/random';

    public function fetchUrl(): DogUrl
    {
        try {
            $result = file_get_contents($this->sourceUrl);
            $response = json_decode($result, true);
        } catch (Throwable $exception) {
            throw CouldNotFetchUrl::becauseReasons($exception->getMessage());
        }

        if ($response['status'] === 'success') {
            return new DogUrl($response['message']);
        }

        throw CouldNotFetchUrl::becauseStatusIsNotSuccessful($response);
    }
}
