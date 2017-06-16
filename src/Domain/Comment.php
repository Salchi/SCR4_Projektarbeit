<?php

namespace Domain;

class Comment extends Entity{
    private $originator;
    private $text;
    private $creationDate;
    private $discussionId;
    
    public function __construct($id, $discussionId, $originator, $text) {
        parent::__construct($id);

        $this->originator = $originator;
        $this->text = $text;
        $this->discussionId = $discussionId;
        $this->creationDate = date(Discussion::DATE_FORMAT);
    }
    
    public function getDiscussionId(){
        return $this->discussionId;
    }
    public function getOriginator(){
        return $this->originator;
    }
    public function getText(){
        return $this->text;
    }
    public function getCreationDate(){
        return $this->creationDate;
    }
}
