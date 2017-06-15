<?php

namespace Controllers;

class User extends \MVC\Controller {
    function GET_Login()
    {
        return $this->renderView('login', array());
    }
    
    function GET_Register()
    {
        return $this->renderView('register', array());
    }
}
