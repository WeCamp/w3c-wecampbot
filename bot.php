<?php

require 'vendor/autoload.php';
use PhpSlackBot\Bot;
use W3C\Beer;
use W3C\Help;
use W3C\Schedule;
use W3C\SelfUpdate;
use W3C\Stats;
use W3C\WhatTheCommit;
use W3C\Yoda;

$bot = new Bot();
$bot->setToken(getenv('SLACK_TOKEN'));

/**
 * This is where the magic happens
 */
$bot->loadCommand(new Help());
$bot->loadCommand(new Beer());
$bot->loadCommand(new Schedule());
$bot->loadCommand(new SelfUpdate());
$bot->loadCommand(new Stats());
$bot->loadCommand(new WhatTheCommit());
$bot->loadCommand(new Yoda());
$bot->run();
