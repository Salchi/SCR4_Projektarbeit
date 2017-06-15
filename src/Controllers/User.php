<?php

namespace Controllers;

use BusinessLogic\AuthentificationManager;
use BusinessLogic\RegistrationManager;

class User extends \MVC\Controller {

    const PARAM_USERNAME = 'un';
    const PARAM_PASSWORD = 'pwd';
    const PARAM_CONFIRMED_PASSWORD = 'confirmedPwd';

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
        return $this->renderView('register', array(
                    'username' => $this->getParam(self::PARAM_USERNAME)
        ));
    }

    function POST_Register() {
        $errors = array();

        $username = $this->getParam(self::PARAM_USERNAME);
        $password = $this->getParam(self::PARAM_PASSWORD);
        $confirmedPassword = $this->getParam(self::PARAM_CONFIRMED_PASSWORD);

        if (RegistrationManager::userExists($username)) {
            $errors[] = "User with name '" . $username . "' already exists.";
        }

        if (strlen($username) === 0) {
            $errors[] = "Username is required.";
        }

        if (strlen($password) === 0) {
            $errors[] = "Password is required.";
        }

        if ($password !== $confirmedPassword) {
            $errors[] = "Passwords don't match.";
        }

        if (sizeof($errors) === 0) {
            if (RegistrationManager::registerUser($username, $password)) {
                return $this->redirect('Index', 'Post');
            }
            $errors[] = 'Something went wrong.';
        }

        return $this->renderView('register', array(
                    'username' => $username,
                    'errors' => $errors
        ));
    }

}
