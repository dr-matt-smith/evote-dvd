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

switch ($action){
    case 'about':
        $mainController->aboutAction($twig);
        break;
    case 'contact':
        $mainController->contactAction($twig);
        break;
    case 'list':
        $mainController->listAction($twig);
        break;
    case 'detail':
        $mainController->detailAction($twig,$id);
        break;
    case 'sitemap':
        $mainController->sitemapAction($twig);
        break;
    case 'filterList':
        $mainController->filterListAction($twig);
        break;
    case 'filterListTitleOrCategory':
        $mainController->filterListTitleorCategoryAction($twig);
        break;
    case 'messages':
        $messageController->messagesAction($twig);
        break;
    case 'processMessageForm':
        $messageController->submitAction($twig);
        break;
    case 'processMessageUpdateForm':
        $messageController->updateAction($twig);
        break;
    case 'editMessage':
        $messageController->messageEditAction($twig);
        break;
    case 'deleteMessage':
        $messageController->deleteAction($twig);
        break;
    case 'index':
    default:
        $mainController->indexAction($twig);
}