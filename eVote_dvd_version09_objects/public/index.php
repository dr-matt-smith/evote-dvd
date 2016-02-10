<?php
require_once __DIR__ . '/../src/mainController.php';

// get action GET parameter (if it exists)
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);


if ('about' == $action){
   aboutAction();
} else if ('contact' == $action) {
    contactAction();
} else if ('list' == $action) {
    listAction();
} else if ('sitemap' == $action) {
    sitemapAction();
} else {
    // default is home page ('index' action)
    indexAction();
}