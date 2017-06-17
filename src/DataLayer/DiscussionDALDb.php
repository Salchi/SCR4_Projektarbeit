<?php

namespace DataLayer;

use Domain\Discussion;
use Domain\Comment;
use BusinessLogic\PrivilegeManager;

class DiscussionDALDb implements DiscussionDAL {

    public function __construct($server, $userName, $password, $database) {
        parent::__construct($server, $userName, $password, $database);
    }

    public function getWithPagination($offset, $numOfElements) {
        return array();
    }

    public function getNumberOfDiscussions() {
        $con = $this->getConnection();
        $res = $this->executeQuery($con, 'SELECT count(id) FROM discussion');

        while ($count = $res->fetchObject()) {
            return $count;
        }

        $res->close();
        $con->close();
        return 0;
    }

    public function get($id) {
        $discussions = array();
        $con = $this->getConnection();
        $stat = $this->executeStatement($con, 
            'SELECT name, FK_originator, creationDate 
            FROM discussion
            WHERE id = ?',
            function($s) use($id)
            {
                $s->bind_param('i', $id);
            });

        $stat->bind_result($id, $name, $originator, $creationDate);

        while($stat->fetch())
        {
            $discussions[] = new Discussion($id, $name, $originator, $creationDate, CommentDALFactory::getDAL()->getAllForDiscussion($id));
        }

        $stat->close();
        $con->close();
        return $discussions;
    }

    public function delete($id) {
        $con = $this->getConnection();
        $stat = $this->executeStatement($con, 'DELETE discussion WHERE id = ?', function($s) use($id) {
            $s->bind_param('i', $id);
        });

        $stat->close();
        $con->close();
    }

    public function add($discussion) {
        $name = $discussion->getName();
        $originator = $discussion->getOriginator();
        $creationDate = $discussion->getCreationDate();

        $con = $this->getConnection();
        
        $stat = $this->executeStatement($con, 'INSERT INTO discussion (name, FK_originator, creationDate) VALUES(?,?,?)', 
                function($s) use($name, $originator, $creationDate) {
            $s->bind_param('sss', $name, $originator, $creationDate);
        });
        
        $discussionId = $stat->insert_id;
        $stat->close();
        $con->close();
        
        foreach ($discussion->getComments() as $comment) {
            $comment->setDiscussionId($discussionId);
            CommentDALFactory::getDAL()->add($comment);
        }
    }

}
