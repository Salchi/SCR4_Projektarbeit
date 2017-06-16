<?php

namespace DataLayer;

class CommentDALFactory {

    private static $dal = null;
    
    private function __construct() {
        
    }

    public static function getDAL() {
        if (self::$dal === null){
            self::$dal = new CommentDALMock();
        }
        return self::$dal;
    }

}
