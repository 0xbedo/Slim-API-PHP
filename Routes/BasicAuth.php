<?php
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;


$app->get("/token", function (Request $request, Response $response){

  $headers = $request->getHeaders();
  $out=[];
  foreach($headers as $header => $value){
    $out[$header] = $value;
  }
  $out['auth'] = $request->getHeaderLine("Authorization");

  $out['encode'] = substr($out['auth'],6 );
  $out['decode'] = base64_decode($out['encode']);
  [$user,$pass] = explode(':', $out['decode'],2);
  $out['user'] = $user;
  
  $response->getBody()->write(json_encode( "Welcome: "."".$out['user']));
  return $response->withAddedHeader("Content-Type","application/json");
})->add(BasicAuthMiddleware::create());