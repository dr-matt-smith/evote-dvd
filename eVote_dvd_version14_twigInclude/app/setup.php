<?php
//----- autoload any classes we are using ------
require_once __DIR__ . '/../vendor/autoload.php';

// let's simply how we refer to our MainController class
use Itb\MainController;

//----- Twig setup --------------
$templatesPath = __DIR__ . '/../templates';
$loader = new Twig_Loader_Filesystem($templatesPath);
$twig = new Twig_Environment($loader);

// create an instance of our MainController class,
// for use in index.php
$mainController = new MainController();