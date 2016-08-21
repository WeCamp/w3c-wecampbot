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

        /**
         * Close the client and end the React loop
         * This will cause the program to end, and supervisorctl to restart it
         */
        $this->getClient()->close();
    }
}

