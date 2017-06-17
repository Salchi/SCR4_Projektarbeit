<?php

namespace BusinessLogic;

use DataLayer\UserDALFactory;
use Domain\User;

class RegistrationManager {
    private function __construct() {
    }
    
    public static function userExists($username){
        return UserDALFactory::getDAL()->get($username) !== null;
    }
    
    public static function registerUser($username, $password){
        UserDALFactory::getDAL()->add(new User($username), password_hash($password, PASSWORD_BCRYPT));
        return AuthentificationManager::authenticate($username, $password);
    }
}
