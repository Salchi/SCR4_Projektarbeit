<?php

namespace Controllers;

use BusinessLogic\DiscussionManager;
use BusinessLogic\CommentManager;
use BusinessLogic\AuthentificationManager;
use Privileges\PrivilegeManager;

class Discussion extends \MVC\Controller {

    const PARAM_PAGE_NUMBER = 'pnr';
    const PARAM_ID = 'id';
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
                        'discussion' => DiscussionManager::getDiscussion($this->getParam(self::PARAM_ID))
            ));
        }

        return $this->redirect('Index', 'Discussion');
    }

    public function POST_Delete() {

        if ($this->hasParam(self::PARAM_ID) && AuthentificationManager::isAuthenticated()) {
            $discussion = DiscussionManager::getDiscussion($this->getParam(self::PARAM_ID));
            $authenticatedUser = AuthentificationManager::getAuthenticatedUser()->getUsername();

            if (PrivilegeManager::isAuthenticatedUserOriginator($discussion->getOriginator())) {
                DiscussionManager::deleteDiscussion($discussion);
            }
        }

        return $this->redirect('Index', 'Discussion');
    }

}
