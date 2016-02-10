<?php
//----- autoload any classes we are using ------
require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../app/setup.php';

// get action GET parameter (if it exists)
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);


$d = new \Itb\Dvd(1, 'Jaws', 'thriller', 10.00, 5, 1, 'starsHalf.png', 'half star');


if ('about' == $action){
   aboutAction($twig);
} else if ('contact' == $action) {
    contactAction($twig);
} else if ('list' == $action) {
    listAction($twig);
} else if ('sitemap' == $action) {
    sitemapAction($twig);
} else {
    // default is home page ('index' action)
    indexAction($twig);
}