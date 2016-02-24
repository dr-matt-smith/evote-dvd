<?php
//----- autoload any classes we are using ------
require_once __DIR__ . '/../vendor/autoload.php';

//----- autoload any classes we are using ------
require_once __DIR__ . '/config_db.php';

//------- load in main controller functions -------
require_once __DIR__ . '/../src/mainController.php';

//----- Twig setup --------------
$templatesPath = __DIR__ . '/../templates';
$loader = new Twig_Loader_Filesystem($templatesPath);
$twig = new Twig_Environment($loader);

//---- monolog
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// create a log channel
$log = new Logger('matt');
$log->pushHandler(new StreamHandler('/Users/matt/Desktop/evote-dvd/zz_in_development_should_be_in_a_branch/eVote_dvd_version14_database/logs/log.txt', Logger::DEBUG));
