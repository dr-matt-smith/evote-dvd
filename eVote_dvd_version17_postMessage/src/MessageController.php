<?php
namespace Itb;

class MessageController
{

    public function submitAction($twig)
    {
        // now sanitise with filter_var()
        $text = filter_input(INPUT_POST, 'text', FILTER_SANITIZE_STRING);
        $user = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_STRING);

        $message = new Message();
        $message->setText($text);
        $message->setUser($user);

        $argsArray = [
            'message' => $message,
        ];

        $template = 'confirmMessage';
        $htmlOutput = $twig->render($template . '.html.twig', $argsArray);
        print $htmlOutput;
    }
}