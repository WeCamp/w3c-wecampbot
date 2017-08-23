<?php

namespace W3C;

use \PhpSlackBot\Command\BaseCommand;

class SelfUpdate extends BaseCommand
{
    private $updateCodebaseCommand = "/usr/bin/git pull 2>&1";
    private $updateDependenciesCommand = "composer install --no-interaction --no-scripts";

    protected function configure() {
        $this->setName('!selfupdate');
    }

    protected function execute($message, $context) {

        $this->tellThem('Updating my codez');
        $this->tellThem('```' . shell_exec($this->updateCodebaseCommand) . '```');

        $this->tellThem('Updating my dependencies');
        $this->tellThem('```' . shell_exec($this->updateDependenciesCommand) . '```');

        $this->tellThem('Restarting in 5...');

        /**
         * Close the client and end the React loop
         * This will cause the program to end, and supervisorctl to restart it
         */
        sleep(5);
        $this->getClient()->close();
    }

    private function tellThem($something)
    {
        $this->send($this->getCurrentChannel(), null, $something);
    }

}

