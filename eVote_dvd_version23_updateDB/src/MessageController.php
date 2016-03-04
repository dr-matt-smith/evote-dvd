<?php
namespace Itb;

class MessageController
{
    public function messagesAction(\Twig_Environment $twig)
    {
//        $messageRepository = new MessageRepository();
        $messageRepository = new DatabaseTableRepository('Message', 'messages');

        $messages = $messageRepository->getAll();

        $argsArray = [
            'messages' => $messages,
        ];

        $template = 'messages';
        $htmlOutput = $twig->render($template . '.html.twig', $argsArray);
        print $htmlOutput;
    }

    public function messagesAsJSONAction(\Twig_Environment $twig)
    {
//        $messageRepository = new MessageRepository();
        $messageRepository = new DatabaseTableRepository('Message', 'messages');

        $messages = $messageRepository->getAll();

        $argsArray = [
            'messages' => $messages,
        ];

        $template = 'messagesAsJSON';
        $htmlOutput = $twig->render($template . '.json.twig', $argsArray);
        print $htmlOutput;
    }


    public function submitAction($twig)
    {
        // now sanitise with filter_var()
        $text = filter_input(INPUT_POST, 'text', FILTER_SANITIZE_STRING);
        $user = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_STRING);

        // get Unix timestamp for the current time
        $now = new \DateTime();
        $timestamp = $now->getTimestamp();

        // create message object
        $message = new Message();
        $message->setText($text);
        $message->setUser($user);
        $message->setTimestamp($timestamp);

        // use MessageRepository to store new Message object
//        $messageRepository = new MessageRepository();
        $messageRepository = new DatabaseTableRepository('Message', 'messages');
        if($messageRepository->create($message)){
            $this->messagesAction($twig);
        } else {
            $errorMessage = 'there was a problem adding your message to the database ...';
            $errorController = new ErrorController();
            $errorController->messagesAction($twig, $errorMessage);
        }
    }


    public function deleteAction($twig)
    {
        // now sanitise with filter_var()
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

        // use MessageRepository to store new Message object
//        $messageRepository = new MessageRepository();
        $messageRepository = new DatabaseTableRepository('Message', 'messages');

        if($messageRepository->delete($id)){
            $this->messagesAction($twig);
        } else {
            $errorMessage = 'there was a problem delete message with id ' . $id . 'to the database ...';
            $errorController = new ErrorController();
            $errorController->messagesAction($twig, $errorMessage);
        }

    }

    public function messageEditAction(\Twig_Environment $twig)
    {
        // now sanitise with filter_var()
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

        $messageRepository = new DatabaseTableRepository('Message', 'messages');

        $message = $messageRepository->getOneById($id);

        $argsArray = [
            'message' => $message,
        ];

        $template = 'messageEdit';
        $htmlOutput = $twig->render($template . '.html.twig', $argsArray);
        print $htmlOutput;
    }

    public function updateAction($twig)
    {
        // now sanitise with filter_var()
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
        $text = filter_input(INPUT_POST, 'text', FILTER_SANITIZE_STRING);
        $user = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_STRING);

        // get Unix timestamp for the current time
        $now = new \DateTime();
        $timestamp = $now->getTimestamp();

        // create message object
        $message = new Message();
        $message->setText($text);
        $message->setUser($user);
        $message->setTimestamp($timestamp);

        // use MessageRepository to store new Message object
//        $messageRepository = new MessageRepository();
        $messageRepository = new DatabaseTableRepository('Message', 'messages');
        if($messageRepository->update($message, $id)){
            $this->messagesAction($twig);
        } else {
            $errorMessage = 'there was a problem editing your message in the database ...';
            $errorController = new ErrorController();
            $errorController->messagesAction($twig, $errorMessage);
        }
    }


}