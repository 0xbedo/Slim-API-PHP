<?php
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

//PUT Resource
$app->put('/testput', function(Request $req , Response $res ){

    $data = $req->getParsedBody(); 
    $username = $data['username'];
    $password = $data['password'];

    $res->getBody()->write($username.' Your Password Is: '.$password);
    return $res;

});
//Delete Resource
$app->delete('/post/{id}', function(Request $req , Response $res ,$args){

    $data = $req->getParsedBody(); 
    $username = $data['username'];
    $postID = $args['id'];

    $res->getBody()->write($username.' Your Post Was Deleted ');
    return $res;
});
