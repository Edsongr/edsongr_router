<?php 

require __DIR__.'/../vendor/autoload.php';

require_once __DIR__ .'/../demo/Controller/UserController.php';
require_once __DIR__ .'/../src/Edson/EdsongrRouter/Route.php';

use Edson\EdsongrRouter\Route;

$router = new Route();

$router->get('/', 'UserController@index');
$router->get('/$id', 'UserController@get');
$router->post('/', 'UserController@store'); 
$router->put('/', 'UserController@update');
$router->delete('/$id', 'UserController@delete');

$router->run();
