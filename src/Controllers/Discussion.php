<?php

namespace Controllers;

use BusinessLogic\DiscussionManager;
use BusinessLogic\CommentManager;
use BusinessLogic\AuthentificationManager;
use Privileges\PrivilegeManager;

class Discussion extends \MVC\Controller {

    const PARAM_PAGE_NUMBER = 'pnr';
    const PARAM_ID = 'id';
    const PARAM_DISCUSSION_NAME = 'n';
    const DEFAULT_PAGES_TO_DISPLAY = 5;

    public function GET_Index() {
        $pageNumber = $this->hasParam(self::PARAM_PAGE_NUMBER) ? $this->getParam(self::PARAM_PAGE_NUMBER) : 1;
        $totalPages = DiscussionManager::getNumberOfPages();
        $pagesToDisplay = min(self::DEFAULT_PAGES_TO_DISPLAY, $totalPages);

        return $this->renderView('overview', array(
                    'newestComment' => CommentManager::getNewestComment(),
                    'discussions' => DiscussionManager::getAllPostsOnPage($pageNumber),
                    'paginationModel' => array(
                        'baseUri' => \MVC\MVC::buildActionLink('Index', 'Discussion', array()),
                        'currentPageNumber' => $pageNumber,
                        'paramNamePageNumber' => self::PARAM_PAGE_NUMBER,
                        'pagesToDisplay' => $pagesToDisplay,
                        'pivot' => ceil($pagesToDisplay / 2),
                        'totalPages' => $totalPages,
                        'defaultPagesToDisplay' => self::DEFAULT_PAGES_TO_DISPLAY
                    )
        ));
    }

    public function GET_Detail() {
        if ($this->hasParam(self::PARAM_ID)) {
            return $this->renderView('detail', array(
                        'newestComment' => CommentManager::getNewestComment(),
                        'discussion' => DiscussionManager::getDiscussion($this->getParam(self::PARAM_ID)),
                        'redirectUrl' => '?' . $_SERVER['QUERY_STRING']
            ));
        }

        return $this->redirect('Index', 'Discussion');
    }

    public function POST_Delete() {
        if ($this->hasParam(self::PARAM_ID) && AuthentificationManager::isAuthenticated()) {
            $discussion = DiscussionManager::getDiscussion($this->getParam(self::PARAM_ID));

            if (PrivilegeManager::isAuthenticatedUserOriginator($discussion->getOriginator())) {
                DiscussionManager::deleteDiscussion($discussion);
            }
        }

        return $this->redirect('Index', 'Discussion');
    }

    public function GET_Add() {
        if (PrivilegeManager::isAuthenticatedUserAllowedToAdd()) {
            return $this->renderView('addDiscussion', array('name' => ''));
        }

        return $this->redirect('Index', 'Discussion');
    }

    private function checkParam($name) {
        $errors = array();
        if (strlen($name) <= 0) {
            $errors[] = 'Name is requried.';
        }
        return $errors;
    }

    public function POST_Add() {
        if (PrivilegeManager::isAuthenticatedUserAllowedToAdd() &&
                $this->hasParam(self::PARAM_DISCUSSION_NAME)) {
            
            $name = $this->getParam(self::PARAM_DISCUSSION_NAME);
            $errors = $this->checkParam($name);

            if (sizeof($errors) > 0) {
                return $this->renderView('addDiscussion', array(
                            'name' => '',
                            'errors' => $errors
                ));
            }
            
            DiscussionManager::addDiscussion($name);
        }
        
        return $this->redirect('Index', 'Discussion');
    }

}
