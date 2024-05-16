<?php

namespace app\models;

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
