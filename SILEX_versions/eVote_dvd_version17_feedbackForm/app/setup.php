<?php
//----- autoload any classes we are using ------
require_once __DIR__ . '/../vendor/autoload.php';

//----- autoload any classes we are using ------
require_once __DIR__ . '/config_db.php';

// my settings
// ------------
$myTemplatesPath = __DIR__ . '/../templates';

// setup Silex
// ------------
$app = new Silex\Application();

// register Twig with Silex
// ------------
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => $myTemplatesPath
));

//---- monolog
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// create a log channel
$log = new Logger('matt');
$log->pushHandler(new StreamHandler('/Users/matt/Desktop/evote-dvd/zz_in_development_should_be_in_a_branch/eVote_dvd_version14_database/logs/log.txt', Logger::DEBUG));
