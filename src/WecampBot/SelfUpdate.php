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

        $this->tellThem('Remember to restart...');
    }

    private function tellThem($something)
    {
        $this->send($this->getCurrentChannel(), null, $something);
    }

}

