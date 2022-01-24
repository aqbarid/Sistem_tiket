<?php
require_once("autoload.php");
use Dotenv\Dotenv;
use Libraries\Router;
use Whoops\Run as WoopsRun;
use Whoops\Handler\PrettyPageHandler;
// use Illuminate\Http\Request;

// start session
session_start();

$basepath = __DIR__;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Request::capture();

$whoops = new WoopsRun;
$whoops->pushHandler(new PrettyPageHandler);
$whoops->register();


Router::bootstrap($basepath, function($ex) {
  header('Content-Type: text/html; charset=utf-8');
  echo '404 - Page Not Found';
});

require_once("route.php");