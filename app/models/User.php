<?php

namespace app\models;

// deny acess to app files and folders access.
defined('ROOTPATH') or exit('Access Denied!');
use app\core\Model;

class User
{
    use Model;
    protected $table = "users";
    protected $allowedColumns = [
        "name",
        "age",
    ];

}
