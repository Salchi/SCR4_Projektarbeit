<?php

namespace DataLayer;

class DiscussionDALFactory {

    private static $dal = null;
    
    private function __construct() {
        
    }

    public static function getDAL() {
        if (self::$dal === null){
            self::$dal = new UserDALMock();
        }
        return self::$dal;
    }

}
