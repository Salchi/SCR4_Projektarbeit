<?php

namespace DataLayer;

use Domain\Discussion;
use BusinessLogic\PrivilegeManager;

class DiscussionDALDb extends DbDALBase implements DiscussionDAL {

    public function __construct($server, $userName, $password, $database) {
        parent::__construct($server, $userName, $password, $database);
    }

    public function getWithPagination($offset, $numOfElements) {
        $discussions = array();
        $con = $this->getConnection();
        $stat = $this->executeStatement($con, 'SELECT id, name, FK_originator, creationDate 
            FROM discussion
            ORDER BY creationDate DESC
            LIMIT ?,?', function($s) use($offset, $numOfElements) {
            $s->bind_param('ii', $offset, $numOfElements);
        });

        $stat->bind_result($id, $name, $originator, $creationDate);

        while ($stat->fetch()) {
            $discussions[] = new Discussion($id, $name, $originator, $creationDate, CommentDALFactory::getDAL()->getAllForDiscussion($id));
        }

        $stat->close();
        $con->close();
        return $discussions;
    }

    public function getNumberOfDiscussions() {
        $con = $this->getConnection();
        $res = $this->extecuteQuery($con, 'SELECT count(id) as cnt FROM discussion');

        while ($result = $res->fetch_object()) {
            return $result->cnt;
        }

        $res->close();
        $con->close();
        return 0;
    }

    public function get($id) {
        $con = $this->getConnection();
        $stat = $this->executeStatement($con, 'SELECT id, name, FK_originator, creationDate 
            FROM discussion
            WHERE id = ?', function($s) use($id) {
            $s->bind_param('i', $id);
        });

        $stat->bind_result($id, $name, $originator, $creationDate);

        while ($stat->fetch()) {
            return new Discussion($id, $name, $originator, $creationDate, CommentDALFactory::getDAL()->getAllForDiscussion($id));
        }

        $stat->close();
        $con->close();
        return null;
    }

    public function delete($id) {
        $discussion = $this->get($id);

        if ($discussion != null && PrivilegeManager::isAuthenticatedUserOriginator($discussion->getOriginator())) {
            $con = $this->getConnection();
            $stat = $this->executeStatement($con, 'DELETE FROM discussion WHERE id = ?', function($s) use($id) {
                $s->bind_param('i', $id);
            });

            $stat->close();
            $con->close();
        }
    }

    public function add($discussion) {
        if (PrivilegeManager::isAuthenticatedUserAllowedToAdd()) {
            $name = $discussion->getName();
            $originator = $discussion->getOriginator();
            $creationDate = $discussion->getCreationDate();

            $con = $this->getConnection();

            $stat = $this->executeStatement($con, 'INSERT INTO discussion (name, FK_originator, creationDate) VALUES(?,?,?)', function($s) use($name, $originator, $creationDate) {
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

}
