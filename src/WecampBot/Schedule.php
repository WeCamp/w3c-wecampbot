<?php

namespace W3C;

use PhpSlackBot\Command\BaseCommand;

class Schedule extends BaseCommand
{

    private $schedule = [
        'Tuesday' => [
            ['from' => '23:33', 'to' => '00:00', 'activity' => 'Finish the bot schedule command'],
        ],
        'Wednesday' => [
            ['from' => '08:30', 'to' => '10:00', 'activity' => 'Breakfast'],
            ['from' => '12:45', 'to' => '13:00', 'activity' => 'Interteam standup'],
            ['from' => '13:00', 'to' => '14:00', 'activity' => 'Lunch'],
            ['from' => '19:00', 'to' => '20:00', 'activity' => 'Dinner + Gamenight kickoff'],
            ['from' => '20:00', 'to' => 'late', 'activity' => 'Future500 Gamenight'],
        ],
        'Thursday' => [
            ['from' => '08:30', 'to' => '10:00', 'activity' => 'Breakfast'],
            ['from' => '10:00', 'to' => '19:00', 'activity' => 'Fronteers Frontend Rescue Team'],
            ['from' => '12:45', 'to' => '13:00', 'activity' => 'Interteam standup'],
            ['from' => '13:00', 'to' => '14:00', 'activity' => 'Lunch'],
            ['from' => '19:00', 'to' => '20:00', 'activity' => 'Dinner'],
        ],
        'Friday' => [
            ['from' => '08:30', 'to' => '10:00', 'activity' => 'Breakfast'],
            ['from' => '10:00', 'to' => '13:00', 'activity' => 'Fronteers Frontend Rescue Team'],
            ['from' => '12:45', 'to' => '13:00', 'activity' => 'Interteam standup'],
            ['from' => '13:00', 'to' => '14:00', 'activity' => 'Lunch'],
            ['from' => '13:00', 'to' => '16:00', 'activity' => 'Pragmatist Survival Game'],
            ['from' => '19:00', 'to' => '20:00', 'activity' => 'Dinner'],
        ],
        'Saturday' => [
            ['from' => '08:30', 'to' => '10:00', 'activity' => 'Breakfast'],
            ['from' => '10:00', 'to' => '12:00', 'activity' => 'Preparing the presentations and backing the bags'],
            ['from' => '12:00', 'to' => '13:00', 'activity' => 'Lunch'],
            ['from' => '13:00', 'to' => '13:30', 'activity' => 'Project presentations'],
            ['from' => '15:30', 'to' => '16:00', 'activity' => 'Closing'],
            ['from' => '16:00', 'to' => 'the end', 'activity' => 'Departure'],
        ],
    ];

    protected function configure()
    {
        $this->setName('!schedule');
    }

    protected function execute($message, $context)
    {

        $day = date('l');
        if (!isset($this->schedule[$day])) {
            $this->send($this->getCurrentChannel(), null, 'There is no schedule for today');
            return;
        }

        $formattedSchedule = $day . "\n\n";

        foreach ($this->schedule[$day] as $item) {
            $formattedSchedule .= sprintf('- %s till %s %s', $item['from'], $item['to'], $item['activity']);
        }

        $this->send($this->getCurrentChannel(), null, $formattedSchedule);
    }
}
