<?php

namespace Domain;

class Discussion extends Entity {
    
    private $name;
    private $creationDate;
    private $originator;
    private $comments;

    public function getName(){
        return $this->name;
    }
    public function getCreationDate(){
        return $this->creationDate;
    }
    public function getOriginator(){
        return $this->originator;
    }
    public function getComments(){
        return $this->comments;
    }
    
    public function __construct($id, $name, $originator, $creationDate, $comments) {
        parent::__construct($id);

        $this->name = $name;
        $this->creationDate = $creationDate;
        $this->originator = $originator;
        $this->comments = $comments;
    }

}
