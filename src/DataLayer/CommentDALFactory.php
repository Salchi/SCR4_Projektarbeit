<?php

namespace DataLayer;

class CommentDALFactory {

    private function __construct() {
        
    }

    public static function getDAL() {
        return new CommentDALDb('localhost', 'root', '', 'projektarbeit');
    }

}
