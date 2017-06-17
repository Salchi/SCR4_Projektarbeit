<?php

namespace Controllers;

use BusinessLogic\AuthentificationManager;
use BusinessLogic\CommentManager;
use Privileges\PrivilegeManager;

class Comment extends \MVC\Controller {

    const PARAM_COMMENT_ID = 'cid';
    const PARAM_REDIRECT = 'red';

    public function POST_Delete() {
        if ($this->hasParam(self::PARAM_COMMENT_ID) && AuthentificationManager::isAuthenticated()) {
            $comment = CommentManager::getComment($this->getParam(self::PARAM_COMMENT_ID));

            if (PrivilegeManager::isAuthenticatedUserOriginator($comment->getOriginator())) {
                CommentManager::deleteComment($comment);
            }
        }
        if ($this->hasParam(self::PARAM_REDIRECT)) {
            return $this->redirectToUrl($this->getParam(self::PARAM_REDIRECT));
        }

        return $this->redirect('Index', 'Discussion');
    }

}
