<?php

namespace app\controllers;

use app\core\Controller;
use app\models\User;

class Home extends Controller
{
    public function index()
    {

        $this ->view('publicviews/home');
    }
}