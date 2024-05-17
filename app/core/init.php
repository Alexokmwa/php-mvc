<?php

// deny acess to app files and folders access.
defined('ROOTPATH') or exit('Access Denied!');

spl_autoload_register(function ($classname) {
    require $filename = "../".$classname.".php";
});
require 'config.php';
require 'functions.php';
require 'Database.php';
require 'Model.php';
require 'Controller.php';
require 'App.php';
