<?php

namespace W3C;

use PhpSlackBot\Command\BaseCommand;

class Beer extends BaseCommand
{
    private $midnightToSixAM = 'Curfew! Curfew! Get some sleep...';
    private $sixAMToFivePM = 'No beer, remember to drink lots of water!';
    private $beerOClock = 'BEER-O-CLOCK!';
    private $sixPMtoMidnight = 'Sure! We\'re nice and cold! (but remember to drink lots of water)';

    protected function configure()
    {
        $this->setName('!beer');
    }

    protected function execute($message, $context)
    {
        $response = $this->getTheResponseBasedOnTheTime();

        $this->send($this->getCurrentChannel(), null, $response);
    }

    private function getTheResponseBasedOnTheTime()
    {
        $hour = date('G');

        if ($hour >= 0 && $hour < 6) {
            return $this->midnightToSixAM;
        }

        if ($hour >= 6 && $hour < 17) {
            return $this->sixAMToFivePM;
        }

        if ($hour >= 17 && $hour < 18) {
            return $this->beerOClock;
        }

        if ($hour >= 18) {
            return $this->sixPMtoMidnight;
        }

        return 'I have no idea what time it is. Drink water!';
    }

}
