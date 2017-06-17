<?php

namespace DataLayer;

class DiscussionDALFactory {
    private function __construct() {
        
    }

    public static function getDAL() {
        return new DiscussionDALDb('localhost', 'root', '', 'projektarbeit');
    }

}
