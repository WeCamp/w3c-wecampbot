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

- !help (You are looking at it)
- !commit (Suggests a commit message for your next commit)
- !schedule [day] (Shows the schedule for the day, i.e. !schedule friday)

Add more? Go ahead! https://github.com/WeCamp/w3c-wecampbot
EOC;
        $this->send($this->getCurrentChannel(), null, $commands);
    }
}
