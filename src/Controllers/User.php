<?php

namespace Controllers;

use BusinessLogic\AuthentificationManager;

class User extends \MVC\Controller {

    const PARAM_USERNAME = 'un';
    const PARAM_PASSWORD = 'pwd';

    function GET_Login() {
        return $this->renderView('login', array(
                    'username' => $this->getParam(self::PARAM_USERNAME)
        ));
    }

    function POST_Login() {
        if (!AuthentificationManager::authenticate($this->getParam(self::PARAM_USERNAME), $this->getParam(self::PARAM_PASSWORD))) {
            return $this->renderView('login', array(
                        'username' => $this->getParam(self::PARAM_USERNAME),
                        'errors' => array('Invalid username or password.')
            ));
        }

        return $this->redirect('Index', 'Post');
    }

    function GET_Register() {
        return $this->renderView('register', array());
    }

}
