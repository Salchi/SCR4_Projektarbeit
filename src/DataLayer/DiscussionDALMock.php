<?php

namespace DataLayer;

use Domain\Discussion;
use Domain\Comment;
use Privileges\PrivilegeManager;

class DiscussionDALMock implements DiscussionDAL {

    private $discussions;

    public function __construct() {
        for ($i = 0; $i < 100; $i++) {
            $this->discussions[$i] = new Discussion($i, 'test' . $i, 'user', CommentDALFactory::getDAL()->getAllForDiscussion($i));
        }
    }

    public function getWithPagination($offset, $numOfElements) {
        return array_slice($this->discussions, max($offset, 0), $numOfElements);
    }

    public function getNumberOfDiscussions() {
        return sizeof($this->discussions);
    }

    public function get($id) {
        return array_key_exists($id, $this->discussions) ? $this->discussions[$id] : null;
    }

    public function delete($id) {
        if (array_key_exists($id, $this->discussions) &&
                PrivilegeManager::isAuthenticatedUserOriginator($this->get($id)->getOriginator())) {
            unset($this->discussions[$id]);
        }
    }

}
