<?php

namespace DataLayer;

require 'DbConfiguration.php';

class CommentDALFactory {

    private function __construct() {
        
    }

    public static function getDAL() {
        return new CommentDALDb(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
    }

}
