<?php

namespace Controllers;

use BusinessLogic\AuthentificationManager;
use BusinessLogic\CommentManager;
use BusinessLogic\ic\PrivilegeManager;

class Comment extends \MVC\Controller {

    const PARAM_COMMENT_ID = 'cid';
    const PARAM_REDIRECT = 'red';
    const PARAM_COMMENT_TEXT = 'ct';
    const PARAM_DISCUSSION_ID = 'did';

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

    public function GET_Add() {
        if ($this->hasParam(self::PARAM_DISCUSSION_ID) && PrivilegeManager::isAuthenticatedUserAllowedToAdd()) {
            return $this->renderView('addComment', array(
                        'currUser' => AuthentificationManager::getAuthenticatedUser(),
                        'text' => '',
                        'discussionId' => $this->getParam(self::PARAM_DISCUSSION_ID),
                        'redirectUrl' => $this->hasParam(self::PARAM_REDIRECT) ? $this->getParam(self::PARAM_REDIRECT) : null
            ));
        }
        return $this->redirect('Index', 'Discussion');
    }

    private function checkParam($commentText) {
        $errors = array();
        if (strlen($commentText) <= 0) {
            $errors[] = 'Text is required.';
        }
        return $errors;
    }

    public function POST_Add() {
        if (PrivilegeManager::isAuthenticatedUserAllowedToAdd() &&
                $this->hasParam(self::PARAM_DISCUSSION_ID) &&
                $this->hasParam(self::PARAM_COMMENT_TEXT)) {

            $commentText = $this->getParam(self::PARAM_COMMENT_TEXT);
            $discussionId = $this->getParam(self::PARAM_DISCUSSION_ID);

            $errors = $this->checkParam($commentText);

            if (sizeof($errors) > 0) {
                return $this->renderView('addComment', array(
                            'currUser' => AuthentificationManager::getAuthenticatedUser(),
                            'text' => '',
                            'discussionId' => $discussionId,
                            'redirectUrl' => $this->hasParam(self::PARAM_REDIRECT) ? $this->getParam(self::PARAM_REDIRECT) : null,
                            'errors' => $errors
                ));
            }

            CommentManager::addComment($discussionId, $commentText);

            if ($this->hasParam(self::PARAM_REDIRECT) && $this->getParam(self::PARAM_REDIRECT) != null) {
                return $this->redirectToUrl($this->getParam(self::PARAM_REDIRECT));
            }
        }
        return $this->redirect('Index', 'Discussion');
    }

}
