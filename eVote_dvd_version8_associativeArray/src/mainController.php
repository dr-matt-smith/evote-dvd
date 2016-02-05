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


    $dvds = [];
    $dvds[] = [
        'id' => 1,
        'title' => 'Jaws',
        'category' => 'thriller',
        'price' => 10.00,
        'voteAverage' => 5,
        'numVotes' => 1,
        'imageFile' => 'starsHalf.png',
        'altText' => 'half star'
    ];

    $dvds[] = [
        'id' => 2,
        'title' => 'Jaws II',
        'category' => 'thriller',
        'price' => 5.99,
        'voteAverage' => 90,
        'numVotes' => 77,
        'imageFile' => 'stars5.png',
        'altText' => '5 star'
    ];

    $dvds[] = [
        'id' => 3,
        'title' => 'Shrek',
        'category' => 'comedy',
        'price' => 10.00,
        'voteAverage' => 50,
        'numVotes' => 5,
        'imageFile' => 'stars3.png',
        'altText' => '3 star'
    ];

    $dvds[] = [
        'id' => 4,
        'title' => 'Shrek II',
        'category' => 'comedy',
        'price' => 4.99,
        'voteAverage' => 0,
        'numVotes' => 0,
        'imageFile' => '',
        'altText' => ''
    ];

    $dvds[] = [
        'id' => 5,
        'title' => 'Alien',
        'category' => 'scifi',
        'price' => 19.00,
        'voteAverage' => 95,
        'numVotes' => 201,
        'imageFile' => 'stars5.png',
        'altText' => '5 star'
    ];

    require_once __DIR__ . '/../templates/list.php';
}

function sitemapAction()
{
    $pageTitle = 'Site Map';
    $sitemapLinkStyle = 'current_page';
    require_once __DIR__ . '/../templates/sitemap.php';
}
