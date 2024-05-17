<?php

namespace app\controllers;

// deny acess to app files and folders access.
defined('ROOTPATH') or exit('Access Denied!');
use app\core\Controller;

class NotFound404 extends Controller
{
    public function index()
    {
        echo  "404 error page not found";
    }
}
