<?php

namespace app\core;

// deny acess to app files and folders access.
defined('ROOTPATH') or exit('Access Denied!');

class App
{
    private $controller = 'Home';
    private $method = 'index';
    private function splitUrl()
    {
        $URL = $_GET['url'] ?? 'home';
        $URL = explode("/", trim($URL, "/"));
        return $URL;
    }
    public function loadController()
    {
        $URL = $this ->splitUrl();
        //select controller
        $controllerName =  ucfirst($URL[0]);

        // Array of directories to check for controller files
        $directories = [
            "../app/controllers/",
            "../app/controllers/publicviews/"
        ];

        $found = false;

        // Iterate over each directory and check if the file exists
        foreach ($directories as $directory) {
            $filename = $directory . $controllerName . ".php";
            if (file_exists($filename)) {
                require($filename);
                $this->controller = $controllerName;
                unset($URL[0]);
                $found = true;
                break;
            }
        }

        // If not found in any directory, load the NotFound404 controller
        if (!$found) {
            require("../app/controllers/NotFound404.php");
            $this->controller = "NotFound404";
        }
        // $filename = "../app/controllers/". $controllerName.".php";
        // if (file_exists($filename)) {
        //     require($filename);
        //     $this -> controller = ucfirst($URL[0]);
        // } else {
        //     $filename = "../app/controllers/NotFound404.php";
        //     require($filename);
        //     $this ->controller = "NotFound404";

        // }

        $controllerClass = "app\\controllers\\" . $this->controller;
        $controller = new $controllerClass();
        //select method
        if(!empty($URL[1])) {
            if (method_exists($controller, $URL[1])) {
                $this->method = $URL[1];
                unset($URL[1]);

            }
        }
        call_user_func_array([$controller, $this -> method], $URL);

    }
}
