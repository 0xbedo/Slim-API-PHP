<?php
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;


// Json Response TEST
$app->get('/jsontest/{FirstNmae}/{LastNmae}', function(Request $req , Response $res , $args){

    $FirstNmae  = $args['FirstNmae'];
    $LastNmae   = $args['LastNmae'];

    $out = [];
    $out['Status']      = 200;
    $out['Message'] = 'This is JSON Response Test';
    $out['FirstNmae']   = $FirstNmae;
    $out['LastNmae']    = $LastNmae;

    $res->getBody()->write(json_encode($out));
    return $res;

});