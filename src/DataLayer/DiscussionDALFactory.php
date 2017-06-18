<?php

namespace DataLayer;

require 'DbConfiguration.php';

class DiscussionDALFactory {
    private function __construct() {
        
    }

    public static function getDAL() {
        return new DiscussionDALDb(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
    }

}
