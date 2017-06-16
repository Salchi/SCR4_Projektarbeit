<?php

namespace DataLayer;

use Domain\Discussion;
use Domain\Comment;

class DiscussionDALMock implements DiscussionDAL {

    private $discussions;

    public function __construct() {
        for ($i = 0; $i < 100; $i++) {
            $comments = array();
            $rand = rand(0, 50);
            for ($j = 0; $j < $rand; $j++) {
                $comments[] = new Comment($i * 100 + $j, 'user', 'comment wuhu ' . $j);
            }
            $this->discussions[$i] = new Discussion($i, 'test' . $i, 'user', $comments);
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
