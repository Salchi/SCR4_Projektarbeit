<?php

namespace BusinessLogic;

use DataLayer\UserDALFactory;

final class AuthentificationManager {

    private function __construct() {
        
    }

    const SESSION_USER_ID = 'userId';

    public static function authenticate($username, $password) {
        self::signOut();

        if (UserDALFactory::getDAL()->isPasswordValid($username, $password)) {
            SessionManager::storeValue(self::SESSION_USER_ID, UserDALFactory::getDAL()->get($username)->getUsername());
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
        return self::isAuthenticated() ? UserDALFactory::getDAL()->get(SessionManager::getValue(self::SESSION_USER_ID)) : null;
    }

}
