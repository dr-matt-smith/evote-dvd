<?php
//----- autoload any classes we are using ------
require_once __DIR__ . '/../vendor/autoload.php';

//------- load in main controller functions -------
require_once __DIR__ . '/../src/mainController.php';

//----- Twig setup --------------
$templatesPath = __DIR__ . '/../templates';
$loader = new Twig_Loader_Filesystem($templatesPath);
$twig = new Twig_Environment($loader);
