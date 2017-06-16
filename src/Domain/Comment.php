<?php

namespace Domain;

class Comment extends Entity{
    private $originator;
    private $text;
    private $creationDate;
    
    public function __construct($id, $originator, $text) {
        parent::__construct($id);

        $this->originator = $originator;
        $this->text = $text;
        $this->creationDate = date(Discussion::DATE_FORMAT);
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
