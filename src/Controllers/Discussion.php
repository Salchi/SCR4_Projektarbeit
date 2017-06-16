<?php

namespace Controllers;

class Discussion extends \MVC\Controller {

    function GET_Index() {
        return $this->renderView('overview', array());
    }

    function GET_Search() {
        return $this->renderView('search', array());
    }

}
