<?php

use App\Router;

require_once '../config/app.php';
require_once '../vendor/autoload.php';

session_start();

$url = $_SERVER['REQUEST_URI'];

$router = new Router();

$router->route($url);