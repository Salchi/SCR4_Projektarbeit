<?php

namespace MVC;

class Controller {

    public final function hasParam($id) {
        return isset($_REQUEST[$id]);
    }

    public final function getParam($id, $defaultValue = null) {
        return isset($_REQUEST[$id]) ? $_REQUEST[$id] : $defaultValue;
    }

    private final function addToModel($key, $value, $model){
        if (!array_key_exists($key, $model)) {
            $model[$key] = $value;
        }
        
        return $model;
    }
    
    public final function renderView($view, $model = array()) {
        $model = $this->addToModel('currUser', \BusinessLogic\AuthentificationManager::getAuthenticatedUser(), $model);
        $model = $this->addToModel('newestComment', \BusinessLogic\CommentManager::getNewestComment(), $model);
        ViewRenderer::renderView($view, $model);
    }

    public static function buildActionLink($action, $controller, $params) {
        return MVC::buildActionLink($action, $controller, $params);
    }

    public final function redirectToUrl($url) {
        header("Location: $url");
    }

    public final function redirect($action, $controller, $params = null) {
        $this->redirectToUrl($this->buildActionLink($action, $controller, $params));
    }

}
