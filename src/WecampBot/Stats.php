<?php

namespace W3C;

use \PhpSlackBot\Command\BaseCommand;

class Stats extends BaseCommand
{
    protected function configure() {
        $this->setName('!stats');
    }

    protected function execute($message, $context)
    {
        $args = $this->getArgs($message);
        $team = 'team-' . (isset($args[1]) ? $args[1] : '');

        if (!is_dir('var/' . $team)) {
            $this->send($this->getCurrentChannel(), null, 'This is not a team coach name');
            return;
        }

        shell_exec('/usr/bin/git -C var/' . $team  . ' pull');
        shell_exec('/usr/bin/gitstats var/' . $team . ' /var/www/gitstats/stats/' . $team);
        $this->send($this->getCurrentChannel(), null, 'Updated: http://toran.weca.mp/stats/' . $team);
    }

    private function getArgs($message) {
        $args = [];
        if (isset($message['text'])) {
            $args = array_values(array_filter(explode(' ', $message['text'])));
        }
        return $args;
    }
}
