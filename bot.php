<?php

require 'vendor/autoload.php';

use DogUrlFetcher\FileGetContentsDogUrlFetcher;
use PhpSlackBot\Bot;
use QuoteFetcher\ForismaticApi;
use W3C\Cat;
use W3C\Dog;
use W3C\Help;
use W3C\Quote;
use W3C\Ramon;
use W3C\Restart;
use W3C\SelfUpdate;
use W3C\Schedule;
use W3C\WhatTheCommit;
use \W3C\Weather;

$bot = new Bot();
$bot->setToken(getenv('SLACK_TOKEN'));

/**
 * This is where the magic happens
 */
$bot->loadCommand(new Help());
$bot->loadCommand(new Restart());
$bot->loadCommand(new Schedule());
$bot->loadCommand(new SelfUpdate());
$bot->loadCommand(new WhatTheCommit());
$bot->loadCommand(new Weather());
$bot->loadCommand(new Cat());
$bot->loadCommand(new Dog(new FileGetContentsDogUrlFetcher()));
$bot->loadCommand(new Ramon());
$bot->loadCommand(new Quote(new ForismaticApi()));
$bot->run();
