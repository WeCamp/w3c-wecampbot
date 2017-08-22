<?php

require 'vendor/autoload.php';
use PhpSlackBot\Bot;
use W3C\Help;
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
$bot->loadCommand(new SelfUpdate());
$bot->loadCommand(new WhatTheCommit());
$bot->run();
