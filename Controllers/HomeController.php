<?php

namespace Controllers;

use Core\ViewEngine\ViewInterface;

class HomeController
{
    public function index(ViewInterface $view)
    {
        $view->render();
    }
}