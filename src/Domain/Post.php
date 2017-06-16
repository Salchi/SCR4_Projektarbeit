<?php

namespace Domain;

class Post extends Entity {
    
    private $name;
    private $creationDate;
    private $originator;
    private $comments;

    public function __construct($id, $name, $originator, $comments) {
        parent::__construct($id);
        
        $this->name = $name;
        $this->creationDate = date();
        $this->originator = $originator;
        $this->comments = $comments;
    }

}
