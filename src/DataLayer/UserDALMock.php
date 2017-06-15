<?php

use Domain;

class UserDALMock implements UserDAL {
    private $users = array();
    
    public function __construct() {
        foreach (array('user', 'salchi') as $username) {
            $this->users[$username] = new User($username);
        }
    }

    public function get($username) {
        return array_key_exists($username, $this->users) ? $this->users[$username] : null;
    }

}
