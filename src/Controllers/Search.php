<?php

namespace Controllers;

use BusinessLogic\CommentManager;
use BusinessLogic\AuthentificationManager;

class Search extends \MVC\Controller {

    const PARAM_SEARCH_STRING = 'searchString';
    const PARAM_PAGE_NUMBER = 'pnr';
    const DEFAULT_PAGES_TO_DISPLAY = 5;

    public function GET_Search() {
        $searchString = $this->getParam(self::PARAM_SEARCH_STRING);

        if (sizeof($this->checkParam($searchString)) === 0) {
            return $this->renderWithResult($searchString);
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
        $numberOfComments = CommentManager::getNumberOfComments($searchString);
        $totalPages = ceil($numberOfComments / CommentManager::PAGE_SIZE);
        $pagesToDisplay = min(self::DEFAULT_PAGES_TO_DISPLAY, $totalPages);

        return $this->renderView('search', array(
                    'searchString' => $searchString,
                    'numberOfComments' => $numberOfComments,
                    'result' => CommentManager::getAllCommentsOnPageWith($searchString, $pageNumber),
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

    public function GET_FetchResult() {
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
