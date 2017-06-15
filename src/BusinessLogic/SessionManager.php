<?php

namespace BusinessLogic;

final class SessionManager {

    private function __construct() {
        
    }

    private static $isCreated = false;

    private static function create() {
        if (!self::$isCreated) {
            self::$isCreated = session_start();
        }

        return self::$isCreated;
    }

    public static function hasValue($key) {
        return self::create() && isset($_SESSION[$key]);
    }

    public static function getValue($key) {
        if (self::create()) {
            return $_SESSION[$key];
        } else
            return null;
    }

    public static function storeValue($key, $value) {
        if (self::create()) {
            $_SESSION[$key] = $value;
        }
    }

    public static function deleteValue($key) {
        if (self::create()) {
            unset($_SESSION[$key]);
        }
    }

}
