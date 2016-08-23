<?php

namespace W3C;

use \PhpSlackBot\Command\BaseCommand;

class Help extends BaseCommand
{
    protected function configure() {
        $this->setName('!help');
    }

    protected function execute($message, $context)
    {
        $commands =  <<< EOC
Known commands:

- !commit (Suggests a commit message for your next commit)
- !help (You are looking at it)
- !schedule (Shows the schedule for the day)
- !stats [coach] (Updates the stats for the team with that coach)
EOC;
        $this->send($this->getCurrentChannel(), null, $commands);
    }
}
