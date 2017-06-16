<?php

namespace Controllers;

use BusinessLogic\SearchManager;

class Search extends \MVC\Controller {

    const PARAM_SEARCH_STRING = 'searchString';
    const PARAM_PAGE_NUMBER = 'pnr';
    const DEFAULT_PAGES_TO_DISPLAY = 5;

    public function GET_Search() {
        if ($this->hasParam(self::PARAM_SEARCH_STRING)) {
            return $this->renderWithResult($this->getParam(self::PARAM_SEARCH_STRING));
        }

        return $this->renderView('search', array(
                    'searchString' => '',
                    'result' => null
        ));
    }

    private function checkParam($searchString) {
        $errors = array();

        if ($searchString === null || strlen($searchString) === 0) {
            $errors[] = 'Search string is required.';
        }

        return $errors;
    }

    private function renderWithResult($searchString) {
        $pageNumber = $this->hasParam(self::PARAM_PAGE_NUMBER) ? $this->getParam(self::PARAM_PAGE_NUMBER) : 1;
        $numberOfComments = SearchManager::getNumberOfComments($searchString);
        $totalPages = ceil($numberOfComments / SearchManager::PAGE_SIZE);
        $pagesToDisplay = min(self::DEFAULT_PAGES_TO_DISPLAY, $totalPages);

        return $this->renderView('search', array(
                    'searchString' => $searchString,
                    'numberOfComments' => $numberOfComments,
                    'result' => SearchManager::getAllCommentsOnPageWith($searchString, $pageNumber),
                    'paginationModel' => array(
                        'baseUri' => \MVC\MVC::buildActionLink('Search', 'Search', array(self::PARAM_SEARCH_STRING => $searchString)),
                        'currentPageNumber' => $pageNumber,
                        'paramNamePageNumber' => self::PARAM_PAGE_NUMBER,
                        'pagesToDisplay' => $pagesToDisplay,
                        'pivot' => ceil($pagesToDisplay / 2),
                        'totalPages' => $totalPages,
                        'defaultPagesToDisplay' => self::DEFAULT_PAGES_TO_DISPLAY
                    )
        ));
    }

    public function POST_Search() {
        $searchString = $this->getParam(self::PARAM_SEARCH_STRING);
        $errors = $this->checkParam($searchString);

        if (sizeof($errors) === 0) {
            return $this->renderWithResult($searchString);
        }

        return $this->renderView('search', array(
                    'errors' => $errors,
                    'searchString' => $searchString,
                    'result' => array()
        ));
    }

}
