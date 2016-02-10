<?php

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
    require_once __DIR__ . '/../templates/list.php';
}

function sitemapAction()
{
    $pageTitle = 'Site Map';
    $sitemapLinkStyle = 'current_page';
    require_once __DIR__ . '/../templates/sitemap.php';
}
