<?php
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

$app->get("/middleware", function (Request $request, Response $response) {

  // $request = $request->withHeader("0xbedo","admin");

  $response->getBody()->write(" This is Your Route \n");

  return $response->withHeader('Content-Type', 'application/json');
});