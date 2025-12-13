<?php
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

$app->get("/getservices", function (Request $request, Response $response){
  $myJson = $this->get('JsonOperation');

  $testarray = array("first"=>true , "test"=>false);
  $out = $myJson->encode($testarray);

  $response->getBody()->write($out);
  return $response->withHeader("Content-Type","application/json");
});