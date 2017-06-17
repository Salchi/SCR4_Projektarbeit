<?php

namespace Privileges;

use BusinessLogic\AuthentificationManager;

class PrivilegeManager {
    public static function isAuthenticatedUserAllowedToDeleteDiscussion($discussion){
        return $discussion !== null && AuthentificationManager::isAuthenticated() && 
                $discussion->getOriginator() === AuthentificationManager::getAuthenticatedUser()->getUsername();
    }
}
