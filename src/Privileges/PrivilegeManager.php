<?php

namespace Privileges;

use BusinessLogic\AuthentificationManager;

class PrivilegeManager {
    public static function isAuthenticatedUserOriginator($originator){
        return AuthentificationManager::isAuthenticated() && 
                $originator === AuthentificationManager::getAuthenticatedUser()->getUsername();
    }
}
