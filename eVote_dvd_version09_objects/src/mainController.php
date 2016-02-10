<?php
// read in our Dvd class declaration

require_once __DIR__ . '/../src/Dvd.php';

function aboutAction()
{
    $pageTitle = 'About Us';
    $aboutLinkStyle = 'current_page';
    require_once __DIR__ . '/../templates/about.php';
}

function contactAction()
{
    $pageTitle = 'Contact Us';
    $contactLinkStyle = 'current_page';
    require_once __DIR__ . '/../templates/contact.php';
}

function indexAction()
{
    $pageTitle = 'Home Page';
    $indexLinkStyle = 'current_page';
    require_once __DIR__ . '/../templates/index.php';
}

function listAction()
{
    $pageTitle = 'DVD listings';
    $listLinkStyle = 'current_page';


    $dvds = [];
    $dvds[] = new Dvd(1, 'Jaws', 'thriller', 10.00, 5, 1, 'starsHalf.png', 'half star');
    $dvds[] = new Dvd(2, 'Jaws II', 'thriller', 5.99, 90, 77, 'stars5.png', '5 star');
    $dvds[] = new Dvd(3, 'Shrek', 'comedy', 10.00, 50, 5, 'stars3.png', '3 star');
    $dvds[] = new Dvd(4, 'Shrek II', 'comedy', 4.99, 0, 0, '', '');
    $dvds[] = new Dvd(5, 'Alien', 'scifi', 19.00, 95, 201, 'stars5.png', '5 star');

    require_once __DIR__ . '/../templates/list.php';
}

function sitemapAction()
{
    $pageTitle = 'Site Map';
    $sitemapLinkStyle = 'current_page';
    require_once __DIR__ . '/../templates/sitemap.php';
}
