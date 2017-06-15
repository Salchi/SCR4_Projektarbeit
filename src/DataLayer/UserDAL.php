<?php

namespace DataLayer;

interface UserDAL {

    function get($username);
    function isPasswordValid($username, $password);

}
