<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
require_once __DIR__.'/../server.php';
require_once(__DIR__.'/../oauth2.php');

$app = new \Slim\App;
$app->get('/hello/{name}', function (Request $request, Response $response) {
    $name = $request->getAttribute('name');
    $response->getBody()->write("Hello, $name");

    return $response;
});

 $app->post('/token', function ($request, $response, $args) {
        $oauth2 = new OAuth2();
        // $response->getBody()->write("done");

        $oauth2->server->handleTokenRequest(OAuth2\Request::createFromGlobals())->send();
        //return $response;
        die;
});
$app->run();