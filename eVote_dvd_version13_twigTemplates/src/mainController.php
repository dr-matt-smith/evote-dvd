<?php

function aboutAction(Twig_Environment $twig)
{
    $argsArray = [
        'pageTitle' => 'About Us',
        'aboutLinkStyle' => 'current_page'
    ];

    $template = 'about';
    print $twig->render($template . '.html.twig', $argsArray);
}

function contactAction(Twig_Environment $twig)
{
    $argsArray = [
        'pageTitle' => 'Contact Us',
        'contactLinkStyle' => 'current_page'
    ];

    $template = 'contact';
    print $twig->render($template . '.html.twig', $argsArray);
}

function indexAction(Twig_Environment $twig)
{
    $argsArray = [
        'pageTitle' => 'Home Page',
        'indexLinkStyle' => 'current_page'
    ];

    $template = 'index';
    print $twig->render($template . '.html.twig', $argsArray);
}

function listAction(Twig_Environment $twig)
{

    $d = new \Itb\Dvd(1, 'Jaws', 'thriller', 10.00, 5, 1, 'starsHalf.png', 'half star');


    $dvdRepository = new Itb\DvdRepository();
    $dvds = $dvdRepository->getAll();

    $argsArray = [
        'pageTitle' => 'DVD listings',
        'listLinkStyle' => 'current_page',
        'dvds' => $dvds
    ];

    $template = 'list';
    print $twig->render($template . '.html.twig', $argsArray);
}

function sitemapAction(Twig_Environment $twig)
{
    $argsArray = [
        'pageTitle' => 'Site Map',
        'sitemapLinkStyle' => 'current_page'
    ];

    $template = 'sitemap';
    print $twig->render($template . '.html.twig', $argsArray);
}
