<?php
require_once __DIR__ . '/../app/setup.php';

use Itb\MainController;

// get action GET parameter (if it exists)
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);

$mainController = new MainController();

if ('about' == $action){
    $mainController->aboutAction($twig);
} else if ('contact' == $action) {
    $mainController->contactAction($twig);
} else if ('list' == $action) {
    $mainController->listAction($twig);
} else if ('sitemap' == $action) {
    $mainController->sitemapAction($twig);
} else {
    // default is home page ('index' action)
    $mainController->indexAction($twig);
}