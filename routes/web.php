<?php

use Illuminate\Http\Request;

use Illuminate\Validation\ValidationException;

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Methods: GET,POST,PUT,PATCH,DELETE');
header('Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers,Authorization,X-Requested-With');
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
  header('HTTP/1.1 200 OK');
  exit();
}

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function () use ($router) {

$router->get('orders', 'Api\OrdersController@getAll');
$router->get('order/{id}', 'Api\OrdersController@getOrder');
$router->post('orders/update', '\App\Http\Controllers\Api\OrdersController@update');
$router->delete('orders/delete', '\App\Http\Controllers\Api\OrdersController@deleteOrder');
$router->post('orders/create', '\App\Http\Controllers\Api\OrdersController@store');

});
