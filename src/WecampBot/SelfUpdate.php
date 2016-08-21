<?php

namespace W3C;

use \PhpSlackBot\Command\BaseCommand;

class SelfUpdate extends BaseCommand
{
    protected function configure() {
        $this->setName('!selfupdate');
    }

    protected function execute($message, $context) {
        $this->send($this->getCurrentChannel(), null, "Updating my codez and restarting");
        $result = shell_exec("/usr/bin/git pull 2>&1");
        $this->send($this->getCurrentChannel(), null, '```' . $result . '```');
    }
}

