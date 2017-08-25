<?php

declare(strict_types=1);

namespace W3C;

use PhpSlackBot\Command\BaseCommand;

final class Jeremy extends BaseCommand
{
    protected function configure()
    {
        $this->setName('!jeremy');
    }

    protected function execute($message, $context)
    {
        $this->send($this->getCurrentChannel(), null, 'https://open.spotify.com/track/5FMXrphygZ4z3gVDHGWxgl');
    }
}
