<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Itb\MainController;

// get action GET parameter (if it exists)
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);

$mainController = new MainController();

if ('about' == $action){
    $mainController->aboutAction();
} else if ('contact' == $action) {
    $mainController->contactAction();
} else if ('list' == $action) {
    $mainController->listAction();
} else if ('sitemap' == $action) {
    $mainController->sitemapAction();
} else {
    // default is home page ('index' action)
    $mainController->indexAction();
}