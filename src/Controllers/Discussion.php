<?php

namespace Controllers;

use BusinessLogic\DiscussionManager;

class Discussion extends \MVC\Controller {

    const PARAM_PAGE_NUMBER = 'pnr';
    const PARAM_ID = 'id';
    const DEFAULT_PAGES_TO_DISPLAY = 5;

    public function GET_Index() {
        $pageNumber = $this->hasParam(self::PARAM_PAGE_NUMBER) ? $this->getParam(self::PARAM_PAGE_NUMBER) : 1;
        $totalPages = DiscussionManager::getNumberOfPages();
        $pagesToDisplay = min(self::DEFAULT_PAGES_TO_DISPLAY, $totalPages);

        return $this->renderView('overview', array(
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
                'discussion' => DiscussionManager::getDiscussion($this->getParam(self::PARAM_ID))
            ));
        }
        
        return $this->GET_Index();
    }
}