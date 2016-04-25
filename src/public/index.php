<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
require_once __DIR__.'/../server.php';
require_once(__DIR__.'/../oauth2.php');





$settings = require __DIR__ . '/../settings.php';
$app = new \Slim\App(["settings" => $settings]);
require __DIR__ . '/../dependencies.php';
require __DIR__ . '/../routes.php';

 
$app->run();