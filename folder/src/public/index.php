<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';

$app = new \Slim\App;

// Define routes
$app->get('/', function (Request $request, Response $response) {
    $response->getBody()->write("Hello, Chuck");

    return $response;
});

$app->run();
