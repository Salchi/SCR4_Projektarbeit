<?php

namespace BusinessLogic;

use \DataLayer\DataLayerFactory;

final class AuthentificationManager {

    private function __construct() {
        
    }

    const SESSION_USER_ID = 'userId';

    public static function authenticate($username, $password) {
        self::signOut();

        $user = DataLayerFactory::getDataLayer()->getUserForUserNameAndPassword($username, $password);

        if ($user != null) {
            SessionManager::storeValue(self::SESSION_USER_ID, $user->getId());
            return true;
        }

        return false;
    }

    public static function signOut() {
        SessionManager::deleteValue(self::SESSION_USER_ID);
    }

    public static function isAuthenticated() {
        return SessionManager::hasValue(self::SESSION_USER_ID);
    }

    public static function getAuthenticatedUser() {
        return self::isAuthenticated() ? DataLayerFactory::getDataLayer()->getUser(SessionManager::getValue(self::SESSION_USER_ID)) : null;
    }

}
