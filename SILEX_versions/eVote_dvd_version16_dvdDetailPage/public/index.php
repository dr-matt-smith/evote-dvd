<?php
require_once __DIR__ . '/../app/setup.php';

use Itb\MainController;

$mainController = new MainController();

// get action GET parameter (if it exists)
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);

// get ID from request
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);


// use our static controller() method...
$app->get('/',      \Itb\Utility::controller('Itb', 'main/index'));
$app->get('/about', \Itb\Utility::controller('Itb', 'main/about'));
$app->get('/contact', \Itb\Utility::controller('Itb', 'main/contact'));
$app->get('/list', \Itb\Utility::controller('Itb', 'main/list'));
$app->get('/sitemap', \Itb\Utility::controller('Itb', 'main/sitemap'));
$app->get('/detail/{id}', \Itb\Utility::controller('Itb', 'main/detail'));

// 404 - Page not found
$app->error(function (\Exception $e, $code) use ($app) {
    switch ($code) {
        case 404:
            $message = 'The requested page could not be found.';
            return \Itb\MainController::error404($app, $message);

        default:
            $message = 'We are sorry, but something went terribly wrong.';
            return \Itb\MainController::error404($app, $message);
    }
});

// run Silex front controller
// ------------
$app->run();
