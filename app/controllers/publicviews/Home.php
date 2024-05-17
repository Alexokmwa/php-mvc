<?php

namespace app\controllers;

// deny acess to app files and folders access.
defined('ROOTPATH') or exit('Access Denied!');

use app\core\Controller;
use app\models\User;

class Home extends Controller
{
    public function index()
    {

        $this ->view('publicviews/home');
    }
}
