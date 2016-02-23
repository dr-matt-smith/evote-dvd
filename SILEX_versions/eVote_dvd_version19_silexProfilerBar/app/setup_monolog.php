<?php

//---- monolog
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// create a log channel
$log = new Logger('matt');
$log->pushHandler(new StreamHandler('/Users/matt/Desktop/evote-dvd/zz_in_development_should_be_in_a_branch/eVote_dvd_version14_database/logs/log.txt', Logger::DEBUG));

/*
* found at: http://stackoverflow.com/questions/18723040/how-to-integrate-monolog-in-the-silex-webprofiler
if ($bridge = class_exists('Symfony\Bridge\Monolog\Logger')) {
$app['monolog.handler.debug'] = function () use ($app) {
return new DebugHandler($app['monolog.level']);
};
}
*/

// test loggin:

// register monolog
$app->register(new Silex\Provider\MonologServiceProvider(), array(
'monolog.logfile' => __DIR__.'/development.log',
));

$app['monolog']->addDebug('Testing the Monolog logging.');