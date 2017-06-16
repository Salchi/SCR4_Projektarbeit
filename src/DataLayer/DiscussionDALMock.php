<?php

namespace DataLayer;

use Domain\Discussion;

class DiscussionDALMock implements DiscussionDAL {

    private $posts;

    public function __construct() {
        for ($i = 0; $i < 100; $i++) {
            $this->posts[$i] = new Discussion(0, 'test' . $i, 'user', array());
        }
    }

    public function getWithPagination($offset, $numOfElements){
        return array_slice($this->posts,  max($offset, 0), $numOfElements);
    }

    public function getNumberOfDiscussions(){
        return sizeof($this->posts);
    }
}
