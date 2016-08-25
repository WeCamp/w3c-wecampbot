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
- !schedule [day] (Shows the schedule for the day, i.e. !schedule friday)
- !stats [coach] (Updates the stats for the team with that coach)

Add more? Go ahead! https://github.com/WeCamp/w3c-wecampbot
EOC;
        $this->send($this->getCurrentChannel(), null, $commands);
    }
}
