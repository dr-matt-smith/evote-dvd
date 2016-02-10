<?php
// get action GET parameter (if it exists)
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);

if ('about' == $action){
   require_once __DIR__ . '/../templates/about.php';
} else if ('contact' == $action) {
    require_once __DIR__ . '/../templates/contact.php';
} else if ('list' == $action) {
    require_once __DIR__ . '/../templates/list.php';
} else if ('sitemap' == $action) {
    require_once __DIR__ . '/../templates/sitemap.php';
} else {
    // default is home page ('index' action)
    require_once __DIR__ . '/../templates/index.php';
}