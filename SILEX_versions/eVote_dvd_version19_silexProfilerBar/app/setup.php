<?php
//----- autoload any classes we are using ------
require_once __DIR__ . '/../vendor/autoload.php';

//----- autoload any classes we are using ------
require_once __DIR__ . '/config_db.php';

// my settings
// ------------
$myTemplatesPath = __DIR__ . '/../templates';

// setup Silex
// ------------
$app = new Silex\Application();

// register Twig with Silex
// ------------
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => $myTemplatesPath
));

//----- autoload any classes we are using ------
require_once __DIR__ . '/setup_monolog.php';

//------ providers ---- to setup Web Profiler Debug Toolbar --------
use Silex\Provider;

$app->register(new Provider\HttpFragmentServiceProvider());
$app->register(new Provider\ServiceControllerServiceProvider());
// (we already have registered Twig)

// --- do this LAST - after other Silex service providers ----
$app->register(new Provider\WebProfilerServiceProvider(), array(
    'profiler.cache_dir' => __DIR__.'/../cache/profiler',
    'profiler.mount_prefix' => '/_profiler', // this is the default
));

