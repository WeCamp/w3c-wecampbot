<?php

namespace W3C;

use PhpSlackBot\Command\BaseCommand;

class Restart extends BaseCommand
{

    protected function configure()
    {
        $this->setName('!restart');
    }

    protected function execute($message, $context)
    {

        /**
         * Close the client and end the React loop
         * This will cause the program to end, and supervisorctl to restart it
         */
        sleep(1);
        $this->getClient()->close();
    }

}

