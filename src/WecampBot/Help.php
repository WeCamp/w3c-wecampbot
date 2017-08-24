<?php

namespace W3C;

use \PhpSlackBot\Command\BaseCommand;

class Help extends BaseCommand
{
    protected function configure()
    {
        $this->setName('!help');
    }

    protected function execute($message, $context)
    {
        $commands =  <<< EOC
Known commands:

- !help (You are looking at it)
- !commit (Suggests a commit message for your next commit)
- !schedule [day] (Shows the schedule for the day, i.e. !schedule friday)
- !weather (Show the weather forecast)
- !cat (Show a cat. Like duh. Seriously, what did you expect. Why are you still reading?)
- !dog (Show a dog. Far inferior to !cat. Do not use. Like ever)
- !ramon (If you really need him)
- !jeremy (He really loves having Copacabana stuck in his head, tease with ease)
- !quote (Show an inspirational quote)

Add more? Go ahead! https://github.com/WeCamp/w3c-wecampbot
EOC;
        $this->send($this->getCurrentChannel(), null, $commands);
    }
}
