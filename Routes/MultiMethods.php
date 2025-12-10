<?php
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;


//Multiable Resource
$app->map(['PUT','GET'],'/MultiMethod/{id}',function(Request $req , Response $res , $args){
    $id = $args['id'];
    $method = $req->getMethod();
    if($method === "PUT"){
        $res->getBody()->write("This ID $id will be updated.");
    }
      if ($method === 'GET') {
        $res->getBody()->write("Your  ID is $id " );
    }
    return $res;
});
