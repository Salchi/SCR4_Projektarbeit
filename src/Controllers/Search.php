<?php

namespace Controllers;

class Search extends \MVC\Controller {

    const PARAM_SEARCH_STRING = 'searchString';

    function GET_Search() {
        return $this->renderView('search', array('result' => array()));
    }

    function POST_Search() {
        return $this->renderView('search', array());
    }

}
