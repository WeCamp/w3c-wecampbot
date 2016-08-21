<?php

namespace W3C;

use Goutte\Client;
use \PhpSlackBot\Command\BaseCommand;

class WhatTheCommit extends BaseCommand
{
    /* Goutte\Client */
    private $client;

    public function __construct() {
        $this->client = new Client();
    }

    protected function configure() {
        $this->setName('!commit');
    }

    protected function execute($message, $context) {
        $crawler = $this->client->request('GET', 'http://whatthecommit.com/');
        $commitMessage = $crawler->filter('#content > p')->text();
        $this->send($this->getCurrentChannel(), null, ">" . $commitMessage);
    }

}

