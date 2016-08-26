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
        $message['text'] = trim(str_replace('!yoda', '', $message['text']));

        if (empty($message['text'])) {
            $this->send($this->getCurrentChannel(), null, 'Wanted to say something, you want?');
        }

        $client = new Client();
        $headers = [
            'X-Mashape-Key' => getenv('YODA_TOKEN'),
            'Accept' => 'text/plain'
        ];

        $result = $client->get('https://yoda.p.mashape.com/yoda?sentence=' . urlencode($message['text']), ['headers' => $headers]);

        $this->send($this->getCurrentChannel(), null, $result->getBody()->getContents());
    }
}
