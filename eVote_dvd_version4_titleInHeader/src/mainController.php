<?php

function aboutAction()
{
    $pageTitle = 'About Us';
    require_once __DIR__ . '/../templates/about.php';
}

function contactAction()
{
    $pageTitle = 'Contact Us';
    require_once __DIR__ . '/../templates/contact.php';
}

function indexAction()
{
    $pageTitle = 'Home Page';
    require_once __DIR__ . '/../templates/index.php';
}

function listAction()
{
    $pageTitle = 'DVD listings';
    require_once __DIR__ . '/../templates/list.php';
}

function sitemapAction()
{
    $pageTitle = 'Site Map';
    require_once __DIR__ . '/../templates/sitemap.php';
}
