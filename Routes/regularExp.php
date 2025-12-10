<?php
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;


//regular expression test
$app->get('/regular/{name:[a-zA-Z]+}/{id:[0-9]+}', function (Request $request, Response $response,$args)  {
    $name = $args['name'] ?? null;
    $id = $args['id'] ?? null;
    $response->getBody()->write("Hello, $name This is Your ID: $id" );
    return $response;
});