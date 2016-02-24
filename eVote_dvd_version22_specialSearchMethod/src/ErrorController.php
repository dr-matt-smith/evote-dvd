<?php
namespace Itb;

class ErrorController
{
    public function messagesAction(\Twig_Environment $twig, $erorrMessage)
    {
        $templateName = 'error';
        $argsArray = [
            'errorMessage' => 'there was a problem adding your message to the database ...'
        ];

        $template = 'messages';
        $htmlOutput = $twig->render($template . '.html.twig', $argsArray);
        print $htmlOutput;
    }

}