<?php

namespace DataLayer;

use Domain\User;

class UserDALDb extends DbDALBase implements UserDAL {

    public function __construct($server, $userName, $password, $database) {
        parent::__construct($server, $userName, $password, $database);
    }

    public function get($username) {
        $con = $this->getConnection();
        $stat = $this->executeStatement($con, 
            'SELECT username
            FROM user
            WHERE username = ?',
            function($s) use($username)
            {
                $s->bind_param('s', $username);
            });

        $stat->bind_result($un);

        while($stat->fetch())
        {
            return new User($un);
        }

        $stat->close();
        $con->close();
        return null;
    }

    public function isPasswordValid($username, $password) {
        $con = $this->getConnection();
        $stat = $this->executeStatement($con, 
            'SELECT password
            FROM user
            WHERE username = ?',
            function($s) use($username)
            {
                $s->bind_param('s', $username);
            });

        $stat->bind_result($hash);

        while($stat->fetch())
        {
            return password_verify($password, $hash);
        }

        $stat->close();
        $con->close();
        return false;
    }

    function add($user, $passwordHash) {
        $username = $user->getUsername();
        
        $con = $this->getConnection();
        $stat = $this->executeStatement($con, 
            'INSERT INTO user (username, password) VALUES (?, ?)',
            function($s) use($username, $passwordHash)
            {
                $s->bind_param('ss', $username, $passwordHash);
            });

        $stat->close();
        $con->close();
    }

}
