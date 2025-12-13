<?php
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
// adding service to he contianer


$container->set(name: "JsonOperation", value: function ($c): JsonService {
  $json = new JsonService();
  return $json;
});

$container->set(name:"ErrorOperation", value: function ( ){
  $error = new ErrorHandle();
  return $error;
});