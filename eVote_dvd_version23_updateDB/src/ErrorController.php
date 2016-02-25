<?php
namespace Itb;

class ErrorController
{
    public function messagesAction(\Twig_Environment $twig, $erorrMessage)
    {
        $templateName = 'error';
        $argsArray = [
            'errorMessage' => $erorrMessage
        ];

        $template = 'messages';
        $htmlOutput = $twig->render($template . '.html.twig', $argsArray);
        print $htmlOutput;
    }

}