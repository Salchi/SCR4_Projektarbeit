<?php

namespace MVC;

final class MVC {

    private function __construct() {
        
    }

    const PARAM_CONTROLLER = 'c';
    const PARAM_ACTION = 'a';
    const DEFAULT_CONTROLLER = 'Discussion';
    const DEFAULT_ACTION = 'Index';
    const CONTROLLER_NAMESPACE = '\\Controllers';

    public static function getViewPath() {
        return 'views';
    }

    public static function buildActionLink($action, $controller, $params) {
        $res = '?' . self::PARAM_CONTROLLER . '=' . rawurlencode($controller) . '&'
                . self::PARAM_ACTION . '=' . rawurlencode($action);

        if (is_array($params)) {
            foreach ($params as $name => $value) {
                $res .= '&' . rawurlencode($name) . '=' . rawurlencode($value);
            }
        }

        return $res;
    }

    public static function handleRequest() {
        // determine controller class
        $controllerName = isset($_REQUEST[self::PARAM_CONTROLLER]) ? $_REQUEST[self::PARAM_CONTROLLER] : self::DEFAULT_CONTROLLER;

        $controller = self::CONTROLLER_NAMESPACE . "\\$controllerName";

        // determine http method and action
        $method = $_SERVER['REQUEST_METHOD'];
        $action = isset($_REQUEST[self::PARAM_ACTION]) ? $_REQUEST[self::PARAM_ACTION] : self::DEFAULT_ACTION;

        // instantiate controller and call according action method
        $m = $method . '_' . $action;
        (new $controller)->$m();
    }

}
