<?php

declare(strict_types=1);

namespace W3C;

use DogUrlFetcher\DogUrlFetcher;
use PhpSlackBot\Command\BaseCommand;

final class Dog extends BaseCommand
{
    /**
     * @var DogUrlFetcher
     */
    private $dogUrlFetcher;

    public function __construct(DogUrlFetcher $dogUrlFetcher)
    {
        $this->dogUrlFetcher = $dogUrlFetcher;
    }

    protected function configure()
    {
        $this->setName('!dog');
    }

    protected function execute($message, $context)
    {
        $dogUrl = $this->dogUrlFetcher->fetchUrl();
        $this->send($this->getCurrentChannel(), null, (string) $dogUrl);
    }
}
