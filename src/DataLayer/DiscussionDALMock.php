<?php

namespace DataLayer;

use Domain\Discussion;

class DiscussionDALMock implements DiscussionDAL {

    private $discussions;

    public function __construct() {
        for ($i = 0; $i < 100; $i++) {
            $this->discussions[$i] = new Discussion($i, 'test' . $i, 'user', array());
        }
    }

    public function getWithPagination($offset, $numOfElements){
        return array_slice($this->discussions,  max($offset, 0), $numOfElements);
    }

    public function getNumberOfDiscussions(){
        return sizeof($this->discussions);
    }
    
    public function get($id){
        return array_key_exists($id, $this->discussions) ? $this->discussions[$id] : null;
    }
}
