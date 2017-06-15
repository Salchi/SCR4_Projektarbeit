<?php

namespace Domain;

class User extends Entity {


    public function getUsername() {
        return $this->getId();
    }

    public function __construct($username) {
        parent::__construct($username);
    }

}
