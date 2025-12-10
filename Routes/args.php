<?php
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;




// API Using args GET
$app->get('/usersargs/{id}/{name}', function (Request $request, Response $response, $args)  {
    //usersargs/1/bedo
    $name = $args['name'];
    $id = $args['id'];
    $response->getBody()->write("MR: ".$name." your id Is:  ".$id);
    return $response; 
});
// API Using args GET Using query Paramter
$app->get('/usersparam', function (Request $request, Response $response)  {
    //usersparam?id=1&name=bedo
    $queryParams = $request->getQueryParams();
    $name = $queryParams['name'];
    $id =   $queryParams['id'];
    $response->getBody()->write("MR: ".$name." your id Is:  ".$id);
    return $response; 
});