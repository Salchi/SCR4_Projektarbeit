<?php

namespace DataLayer;

class UserDALFactory {

    private function __construct() {
        
    }

    public static function getDAL() {
        return new UserDALMock();
    }

}
