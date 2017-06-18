<?php

namespace DataLayer;

require 'DbConfiguration.php';

class UserDALFactory {

    private function __construct() {
        
    }

    public static function getDAL() {
        return new UserDALDb(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
    }

}
