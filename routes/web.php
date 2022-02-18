<?php

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

$router->get("/install",["as" => "install", "uses" => "Admin\InstallController@Index"]);
$router->post("/install",["as" => "install", "uses" => "Admin\InstallController@Index"]);

$router->group(["namespace" => "Index","middleware"=>"cache"], function () use ($router) {
    $router->get('/', ["as" => "index.home", "uses" => "IndexController@Index"]);
    $router->get('/list/{channel}-{kind}-{area}-{year}-{pageno}.html', ["as" => "index.list", "uses" => "IndexController@List"]);
    $router->get('/play-{url}.html', ["as" => "index.play", "uses" => "IndexController@Play"]);
    $router->get('/search', ["as" => "index.search", "uses" => "IndexController@Search"]);
});

$router->group(["namespace" => "Auth"], function () use ($router) {
    $router->get('/easyvod/login', ["as" => "admin.login", "uses" => "AuthController@showLogin"]);
    $router->post('/easyvod/login', ["as" => "admin.login", "uses" => "AuthController@Login"]);
    $router->get('/easyvod/captcha', ["as" => "admin.captcha", "uses" => "AuthController@CaptchaInfo"]);
    $router->get('/easyvod/logout', ["as" => "admin.logout","middleware"=>"auth", "uses" => "AuthController@LogOut"]);
    $router->post('/easyvod/changepass', ["as" => "admin.changepass","middleware"=>"auth", "uses" => "AuthController@ChangePass"]);
});

$router->group(["namespace" => "Admin", "middleware" => "auth"], function () use ($router) {
    $router->get('/easyvod/admin', ["as" => "admin.index", "uses" => "AdminController@Index"]);
    $router->get('/easyvod/console', ["as" => "admin.console", "uses" => "AdminController@Console"]);
    $router->get('/easyvod/config', ["as" => "admin.config", "uses" => "AdminController@WebConfig"]);
    $router->post('/easyvod/config', ["as" => "admin.config", "uses" => "AdminController@WebConfig"]);
    $router->get('/easyvod/link', ["as" => "admin.link", "uses" => "AdminController@Link"]);
    $router->post('/easyvod/link', ["as" => "admin.link", "uses" => "AdminController@Link"]);
    $router->get('/easyvod/player', ["as" => "admin.player", "uses" => "AdminController@Player"]);
    $router->post('/easyvod/player', ["as" => "admin.player", "uses" => "AdminController@Player"]);
    $router->get('/easyvod/source', ["as" => "admin.source", "uses" => "AdminController@Source"]);
    $router->post('/easyvod/source', ["as" => "admin.source", "uses" => "AdminController@Source"]);
    $router->get('/easyvod/cache', ["as" => "admin.cache", "uses" => "AdminController@WebCache"]);
    $router->post('/easyvod/cache', ["as" => "admin.cache", "uses" => "AdminController@WebCache"]);
});
