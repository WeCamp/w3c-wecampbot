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
            ['from' => '08:30', 'to' => '10:30', 'activity' => 'Breakfast'],
            ['from' => '12:45', 'to' => '13:00', 'activity' => 'Interteam standup'],
            ['from' => '13:00', 'to' => '14:00', 'activity' => 'Lunch'],
            ['from' => '19:00', 'to' => '20:00', 'activity' => 'Dinner + Gamenight kickoff'],
            ['from' => '20:00', 'to' => 'late', 'activity' => 'Future500 Gamenight'],
        ],
        'Thursday' => [
            ['from' => '08:00', 'to' => '08:30', 'activity' => 'Guided Mindfulness Meditation @ Main Tipi'],
            ['from' => '08:30', 'to' => '10:00', 'activity' => 'Breakfast'],
            ['from' => '12:45', 'to' => '13:00', 'activity' => 'Interteam standup'],
            ['from' => '13:00', 'to' => '14:00', 'activity' => 'Lunch'],
            ['from' => '19:00', 'to' => '20:00', 'activity' => 'Dinner'],
        ],
        'Friday' => [
            ['from' => '08:00', 'to' => '08:30', 'activity' => 'Guided Mindfulness Meditation @ Main Tipi'],
            ['from' => '08:30', 'to' => '10:00', 'activity' => 'Breakfast'],
            ['from' => '11:45', 'to' => '12:00', 'activity' => 'Interteam standup'],
            ['from' => '12:00', 'to' => '13:00', 'activity' => 'Lunch'],
            ['from' => '13:00', 'to' => '16:00', 'activity' => 'Pragmatist Survival Game'],
            ['from' => '19:00', 'to' => '20:00', 'activity' => 'Dinner'],
        ],
        'Saturday' => [
            ['from' => '08:00', 'to' => '08:30', 'activity' => 'Guided Mindfulness Meditation @ Main Tipi'],
            ['from' => '08:30', 'to' => '10:00', 'activity' => 'Breakfast'],
            ['from' => '09:30', 'to' => '12:00', 'activity' => 'Preparing the presentations and backing the bags'],
            ['from' => '12:00', 'to' => '13:00', 'activity' => 'Lunch'],
            ['from' => '13:00', 'to' => '15:30', 'activity' => 'Project presentations'],
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
        if ($firstArgument = $this->extractFirstArgument($message)) {
            $day = date('l', strtotime($firstArgument));
        } else {
            $day = date('l');
        }

        $formattedSchedule = ["*" . $day . "*\n"];

        foreach ($this->schedule[$day] as $item) {
            $formattedSchedule[] = sprintf('- %s till %s %s', $item['from'], $item['to'], $item['activity']);
        }

        $this->send($this->getCurrentChannel(), null, implode("\n", $formattedSchedule));
    }

    private function extractFirstArgument($message)
    {
        $args = [];

        if (isset($message['text'])) {
            $args = array_values(array_filter(explode(' ', $message['text'])));
        }

        return isset($args[1]) ? $args[1] : '';
    }

}
