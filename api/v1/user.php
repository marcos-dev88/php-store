<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

/** @var AppFactory $app */
$app->get('/user', function (Request $request, Response $response) {
    $responseJson = [
        'test_text' => 'test'
    ];
    $response->getBody()->write(json_encode($responseJson));
//   $response->getBody()->write("{value:Test}");
   return $response;
});