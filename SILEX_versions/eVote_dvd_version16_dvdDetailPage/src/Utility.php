<?php
namespace Itb;

class Utility
{
    /**
     * add namespace to the string, after exploding controller name from action
     *
     * examples:
     * input:   Itb, main/index
     * output:  Itb\MainController::indexAction
     *
     * input:   Mattsmithdev\Samples, hello/name
     * output:  Mattsmithdev\Samples\HelloController::nameAction
     *
     * @param string $namespace
     * @param string $shortName controller and action name sepaerate by "/"
     * @return string namespace, controller class name plus :: plus action name
     */
    public static function controller($namespace, $shortName)
    {
        list($shortClass, $shortMethod) = explode('/', $shortName, 2);

        $shortClassCapitlise = ucfirst($shortClass);

        $namespaceClassAction = sprintf($namespace . '\\' . $shortClassCapitlise . 'Controller::' . $shortMethod . 'Action');

        return $namespaceClassAction;
    }
}


