<?php

namespace DataLayer;

use Domain\Post;

class PostDALMock implements PostDAL {

    private $posts;

    public function __construct() {
        $this->posts = array(
            new Post(0, 'test', 'user', array()),
            new Post(1, 'test2', 'user', array()),
            new Post(2, 'test3', 'user', array()),
            new Post(3, 'test4', 'user', array())
        );
    }

    function getWithPagination($offset, $numOfElements){
        return array_slice($this->posts,  max($offset, 0), $numOfElements);
    }

}
