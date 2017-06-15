<?php

namespace Controllers;

class User extends \MVC\Controller {

    const PARAM_USERNAME = 'un';
    const PARAM_PASSWORD = 'pwd';
    
    function GET_Login() {
        return $this->renderView('login', array());
    }

    function POST_Login() {
        $a = $this->getParam(self::PARAM_USERNAME);
        $a .= '<br>' . $this->getParam(self::PARAM_PASSWORD);
        echo $a;
    }

    function GET_Register() {
        return $this->renderView('register', array());
    }

}
