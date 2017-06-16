<?php

namespace Domain;

class Discussion extends Entity {

    const DATE_FORMAT = 'Y-m-d';
    
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
    
    public function __construct($id, $name, $originator, $comments) {
        parent::__construct($id);

        $this->name = $name;
        $this->creationDate = date(self::DATE_FORMAT);
        $this->originator = $originator;
        $this->comments = $comments;
    }

}
