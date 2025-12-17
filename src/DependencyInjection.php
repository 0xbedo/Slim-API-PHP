<?php
use \Firebase\JWT\JWT;// JWT token

// adding service to he contianer


$container->set(name: "JsonOperation", value: function ($c): JsonService {
  $json = new JsonService();
  return $json;
});

$container->set(name:"ErrorOperation", value: function ( ){
  $error = new ErrorHandle();
  return $error;
});

$container->set(name:"JWT", value: function ( ){
  $JWT = new JWT();
  return $JWT;
});