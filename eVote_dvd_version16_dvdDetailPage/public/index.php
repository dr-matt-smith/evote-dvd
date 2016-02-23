<?php
require_once __DIR__ . '/../app/setup.php';

use Itb\MainController;

$mainController = new MainController();

// get action GET parameter (if it exists)
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);

// get ID from request
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);




if ('about' == $action){
    $mainController->aboutAction($twig);
} else if ('contact' == $action) {
    $mainController->contactAction($twig);
} else if ('list' == $action) {
    $mainController->listAction($twig);
} else if ('detail' == $action) {
    $mainController->detailAction($twig,$id);
} else if ('sitemap' == $action) {
    $mainController->sitemapAction($twig);
} else {
    // default is home page ('index' action)
    $mainController->indexAction($twig);
}