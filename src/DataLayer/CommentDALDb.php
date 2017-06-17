<?php

namespace DataLayer;

use Domain\Comment;
use BusinessLogic\PrivilegeManager;

class CommentDALDb extends DbDALBase implements CommentDAL {

    public function __construct($server, $userName, $password, $database) {
        parent::__construct($server, $userName, $password, $database);
    }

    public function getAllForDiscussion($discussionId) {
        $comments = array();
        $con = $this->getConnection();
        $stat = $this->executeStatement($con, 'SELECT id, text, creationDate, FK_originator 
            FROM comment
            WHERE FK_discussion = ?
            ORDER BY creationDate, id DESC', function($s) use($discussionId) {
            $s->bind_param('i', $discussionId);
        });

        $stat->bind_result($id, $text, $creationDate, $originator);

        while ($stat->fetch()) {
            $comments[] = new Comment($id, $discussionId, $originator, $text, $creationDate);
        }

        $stat->close();
        $con->close();
        return $comments;
    }

    private function getAllCommentsWith($searchString) {
        $comments = array();
        $con = $this->getConnection();
        $stat = $this->executeStatement($con, 'SELECT id, text, creationDate, FK_originator, FK_discussion
            FROM comment
            WHERE text LIKE CONCAT(\'%\',?,\'%\')
            ORDER BY creationDate, id DESC', function($s) use($searchString) {
            $s->bind_param('s', $searchString);
        });

        $stat->bind_result($id, $text, $creationDate, $originator, $discussionId);

        while ($stat->fetch()) {
            $comments[] = new Comment($id, $discussionId, $originator, $text, $creationDate);
        }

        $stat->close();
        $con->close();
        return $comments;
    }

    public function getAllCommentsWithPaginationWith($searchString, $offset, $numOfElements) {
        $comments = array();
        $con = $this->getConnection();
        $stat = $this->executeStatement($con, 'SELECT id, text, creationDate, FK_originator, FK_discussion
            FROM comment
            WHERE text LIKE CONCAT(\'%\',?,\'%\')
            ORDER BY creationDate, id DESC
            LIMIT ?,?', function($s) use($searchString, $offset, $numOfElements) {
            $s->bind_param('sii', $searchString, $offset, $numOfElements);
        });

        $stat->bind_result($id, $text, $creationDate, $originator, $discussionId);

        while ($stat->fetch()) {
            $comments[] = new Comment($id, $discussionId, $originator, $text, $creationDate);
        }

        $stat->close();
        $con->close();
        return $comments;
    }

    public function getNumberOfCommentsWith($searchString) {
        $con = $this->getConnection();

        
        $stat = $this->executeStatement($con, 
            'SELECT count(id)
            FROM comment c
            WHERE text LIKE CONCAT(\'%\',?,\'%\')',
            function($s) use($searchString)
            {
                $s->bind_param('s', $searchString);
            });

        $stat->bind_result($count);

        while ($stat->fetch()) {
            return $count;
        }

        $stat->close();
        $con->close();
        return 0;
    }

    public function getNewestComment() {
        $con = $this->getConnection();
        $stat = $this->executeStatement($con, 'SELECT id, text, creationDate, FK_originator, FK_discussion
            FROM comment
            ORDER BY creationDate, id DESC
            LIMIT 1', function($s) {
            
        });

        $stat->bind_result($id, $text, $creationDate, $originator, $discussionId);

        while ($stat->fetch()) {
            return new Comment($id, $discussionId, $originator, $text, $creationDate);
        }

        $stat->close();
        $con->close();
        return null;
    }

    public function get($id) {
        $con = $this->getConnection();
        $stat = $this->executeStatement($con, 'SELECT id, text, creationDate, FK_originator, FK_discussion
            FROM comment
            WHERE id = ?', function($s) use($id) {
            $s->bind_param('i', $id);
        });

        $stat->bind_result($id, $text, $creationDate, $originator, $discussionId);

        while ($stat->fetch()) {
            return new Comment($id, $discussionId, $originator, $text, $creationDate);
        }

        $stat->close();
        $con->close();
        return null;
    }

    public function delete($id) {
        $comment = $this->get($id);

        if ($comment != null && PrivilegeManager::isAuthenticatedUserOriginator($comment->getOriginator())) {
            $con = $this->getConnection();
            $stat = $this->executeStatement($con, 'DELETE FROM comment WHERE id = ?', function($s) use($id) {
                $s->bind_param('i', $id);
            });

            $stat->close();
            $con->close();
        }
    }

    public function add($comment) {
        if (PrivilegeManager::isAuthenticatedUserAllowedToAdd()) {
            $text = $comment->getText();
            $originator = $comment->getOriginator();
            $creationDate = $comment->getCreationDate();
            $discussionId = $comment->getDiscussionId();

            $con = $this->getConnection();

            $stat = $this->executeStatement($con, 'INSERT INTO comment (text, creationDate, FK_originator, FK_discussion) VALUES(?,?,?,?)', 
                    function($s) use($text, $creationDate, $originator, $discussionId) {
                $s->bind_param('sssi', $text, $creationDate, $originator, $discussionId);
            });

            $stat->close();
            $con->close();
        }
    }

}
