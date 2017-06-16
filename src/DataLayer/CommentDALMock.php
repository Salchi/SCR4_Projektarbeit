<?php

namespace DataLayer;

use Domain\Comment;

class CommentDALMock implements CommentDAL {

    private $comments = array();

    public function __construct() {
        for ($i = 0; $i < 1000; $i++) {
            $this->comments[] = new Comment($i, rand(0, 100), 'user', 'wow ' . $i);
        }
    }

    public function getAllForDiscussion($discussionId) {
        $result = array();
        foreach ($this->comments as $c) {
            if ($c->getDiscussionId() === $discussionId) {
                $result[] = $c;
            }
        }

        return $result;
    }

}
