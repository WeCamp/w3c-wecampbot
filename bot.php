<?php

require 'vendor/autoload.php';
use PhpSlackBot\Bot;
use W3C\WhatTheCommit;
use W3C\SelfUpdate;

$bot = new Bot();
$bot->setToken(getenv('SLACK_TOKEN'));

/**
 * This is where the magic happens
 */
$bot->loadCommand(new WhatTheCommit());
$bot->loadCommand(new SelfUpdate());
$bot->run();
