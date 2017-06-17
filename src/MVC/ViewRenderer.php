<?php

namespace MVC;

final class ViewRenderer {

    private function __construct() {
        
    }

    public static function renderView($view, $model) {
        require(MVC::getViewPath() . "/$view.inc");
    }

    private static function htmlOut($string) {
        echo(htmlentities($string));
    }
    
    private static function getUrl($action, $controller, $params = null){
        return MVC::buildActionLink($action, $controller, $params);
    }

    private static function actionLink($content, $action, $controller, $params = null, $cssClass = null) {
        $cc = $cssClass != null ? " class=\"$cssClass\"" : "";
        $url = self::getUrl($action, $controller, $params);
        $link = <<<LINK
<a href="$url"$cc>
LINK;
        echo($link);
        self::htmlOut($content);
        echo('</a>');
    }

    private static function addParamsToUrl($url, $params) {
        $result = $url;

        foreach ($params as $key => $value) {
            if (strpos($result, "?") !== false) {
                $result .= "&" . http_build_query(array($key => $value));
            } else {
                $result .= "?" . http_build_query(array($key => $value));
            }
        }

        return $result;
    }

    private static function beginActionForm($action, $controller, $method = 'get', $params = null, $cssClass = null, $onSubmit = null) {
        $cc = $cssClass != null ? " class=\"$cssClass\"" : "";
        $os = $onSubmit != null ? " onsubmit=\"$onSubmit\"" : "";
        $form = <<<FORM
<form method="$method" action="?"$cc$os>
	<input type="hidden" name="c" value="$controller">
	<input type="hidden" name="a" value="$action">
FORM;

        echo($form);

        if (is_array($params)) {
            foreach ($params as $name => $value) {
                $form = <<<FORM
<input type="hidden" name="$name" value="$value">
FORM;
                echo($form);
            }
        }
    }

    private static function endActionForm() {
        echo('</form>');
    }

}
