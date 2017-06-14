<?php
namespace Controllers;

class Home extends \MVC\Controller
{
    function GET_Index()
    {
        return $this->renderView('test', array());
    }
}