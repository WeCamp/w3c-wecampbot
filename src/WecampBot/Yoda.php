<?php

namespace W3C;

use GuzzleHttp\Client;
use \PhpSlackBot\Command\BaseCommand;

class Yoda extends BaseCommand
{
    protected function configure() {
        $this->setName('!yoda');
    }

    protected function execute($message, $context)
    {
        $message = str_replace('!yoda', '', trim($message));

        $client = new Client();
        $headers = [
            'X-Mashape-Key' => getenv('YODA_TOKEN'),
            'Accept' => 'text/plain'
        ];

        $result = $client->get('https://yoda.p.mashape.com/yoda?sentence=' . $message, $headers);

        $this->send($this->getCurrentChannel(), null, $result->getBody());
    }
}
