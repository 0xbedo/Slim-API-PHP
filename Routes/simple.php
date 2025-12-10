<?php
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;


// Define app routes
$app->get('/hello/{name}', function (Request $request, Response $response)  {
    $name = $request->getAttribute('name');
    $response->getBody()->write("Hello, $name" );
    return $response;
});
// new route
$app->get('/user/{id}', function (Request $request, Response $response, $args)  {
    $id = $args['id'];
    $response->getBody()->write("your id:  $id");
    return $response;
});

//POST API
$app->post('/test/demo',function(Request $req, Response $res){

    $data= $req->getParsedBody(); 


    $name = htmlspecialchars($data['name'], ENT_QUOTES, 'UTF-8');
    $phone = htmlspecialchars($data['phone'], ENT_QUOTES, 'UTF-8');
    $res->getBody()->write("Dear ". $name .", Your phone is: ". $phone );
    
    return $res;
});