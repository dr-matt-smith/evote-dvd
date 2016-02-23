<?php
namespace Itb;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class MainController
{

    public function indexAction(Request $request, Application $app)
    {
        $templateName = 'index';
        return $app['twig']->render($templateName . '.html.twig', []);
    }

    public function contactAction(Request $request, Application $app)
    {
        $templateName = 'contact';
        return $app['twig']->render($templateName . '.html.twig', []);
    }

    public function aboutAction(Request $request, Application $app)
    {
        $templateName = 'about';
        return $app['twig']->render($templateName . '.html.twig', []);
    }

    public function sitemapAction(Request $request, Application $app)
    {
        $templateName = 'sitemap';
        return $app['twig']->render($templateName . '.html.twig', []);
    }

    public function listAction(Request $request, Application $app)
    {
        $dvdRepository = new DvdRepository();
        $dvds = $dvdRepository->getAll();

        $argsArray = [
            'dvds' => $dvds,
        ];

        $template = 'list';
        return $app['twig']->render($template . '.html.twig', $argsArray);
    }

    public function detailAction(Request $request, Application $app, $id)
    {
        $dvdRepository = new DvdRepository();
        $dvd = $dvdRepository->getOneById($id);

        $argsArray = [
            'dvd' => $dvd,
        ];

        $template = 'detail';
        return $app['twig']->render($template . '.html.twig', $argsArray);
    }

    /**
     * not found error page
     * @param \Silex\Application $app
     * @param             $message
     *
     * @return mixed
     */
    public static function error404(Application $app, $message)
    {
        $argsArray = [
            'name' => 'Fabien',
        ];
        $templateName = '404';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }
}