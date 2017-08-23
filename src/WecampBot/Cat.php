<?php

declare(strict_types=1);

namespace W3C;

use PhpSlackBot\Command\BaseCommand;

final class Cat extends BaseCommand
{
    protected function configure()
    {
        $this->setName('!cat');
    }

    protected function execute($message, $context)
    {
        $catUrl = "http://thecatapi.com/api/images/get?format=src&type=gif&time=" . time();
        $this->send($this->getCurrentChannel(), null, $catUrl);
    }
}
