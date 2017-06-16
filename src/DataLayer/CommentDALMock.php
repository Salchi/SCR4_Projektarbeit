<?php

namespace DataLayer;

use Domain\Comment;

class CommentDALMock implements CommentDAL {

    private $comments = array();

    public function __construct() {
        for ($i = 0; $i < 1000; $i++) {
            $this->comments[] = new Comment($i, 1, 'user', 'wow ' . $i);
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

    private function getAllCommentsWith($searchString){
        $result = array();

        foreach ($this->comments as $c) {
            if (strpos($c->getText(), $searchString) !== false) {
                $result[] = $c;
            }
        }
        
        return $result;
    }
    
    public function getAllCommentsWithPaginationWith($searchString, $offset, $numOfElements){
        return array_slice($this->getAllCommentsWith($searchString), $offset, $numOfElements);
    }
    
    public function getNumberOfCommentsWith($searchString){
        return sizeof($this->getAllCommentsWith($searchString));
    }
    
    public function getNewestComment(){
        return $this->comments[0];
    }

}
