<?php

namespace W3C;

use \PhpSlackBot\Command\BaseCommand;

class WhatTheCommit extends BaseCommand
{
    protected function configure() {
        $this->setName('!commit');
    }

    public function execute($message, $context) {
        $commitMessage = readfile('http://whatthecommit.com/index.txt');
        $this->send($this->getCurrentChannel(), null, ">" . $commitMessage);
    }

}
