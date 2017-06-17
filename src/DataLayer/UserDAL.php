<?php

namespace DataLayer;

interface UserDAL {

    function get($username);
    function isPasswordValid($username, $password);
    function add($user, $passwordHash);
}
