<?php
require_once __DIR__ . '/../app/setup.php';

use Itb\MainController;
use Itb\MessageController;

// get action GET parameter (if it exists)
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);

// get ID from request
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

$mainController = new MainController();
$messageController = new MessageController();

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
} else if ('filterList' == $action) {
    $mainController->filterListAction($twig);
} else if ('messages' == $action) {
    $messageController->messagesAction($twig);
} else if ('processMessageForm' == $action) {
    $messageController->submitAction($twig);
} else if ('deleteMessage' == $action) {
    $messageController->deleteAction($twig);
} else {
    // default is home page ('index' action)
    $mainController->indexAction($twig);
}