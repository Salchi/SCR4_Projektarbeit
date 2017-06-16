<?php

namespace DataLayer;

use Domain\Discussion;

class DiscussionDALMock implements DiscussionDAL {

    private $posts;

    public function __construct() {
        $this->posts = array(
            new Discussion(0, 'test', 'user', array()),
            new Discussion(1, 'test2', 'user', array()),
            new Discussion(2, 'test3', 'user', array()),
            new Discussion(3, 'test4', 'user', array())
        );
    }

    function getWithPagination($offset, $numOfElements){
        return array_slice($this->posts,  max($offset, 0), $numOfElements);
    }

}
