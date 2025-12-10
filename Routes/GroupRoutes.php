<?php
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Routing\RouteCollectorProxy;

//Group of Routes
$app->group("/apiv1", function(RouteCollectorProxy $app){
    $app->get('/users', function(Request $req , Response $res) {
        $res->getBody()->write('this data for all Users');
        return $res;
    });
    $app->get('/users/{id:[0-9]+}', function(Request $req , Response $res, $args) {
        $id = $args['id'] ?? null;
        $res->getBody()->write("this data User ID: $id");
        return $res;
    });
    $app->put('/users/{id:[0-9]+}', function(Request $req , Response $res, $args) {
        $id = $args['id'] ?? null;
        $res->getBody()->write("the Persoinal data for  User ID: $id, updated successfully");
        return $res;
    });
    $app->post('/users/{id:[0-9]+}/post', function(Request $req , Response $res, $args) {
        $id = $args['id'] ?? null;
        $res->getBody()->write("User $id, Created a New POST");
        return $res;
    });
    $app->delete('/users/{id:[0-9]+}', function(Request $req , Response $res, $args) {
        $id = $args['id'] ?? null;
        $res->getBody()->write("User $id, Your Account Will be deleted after 30 days");
        return $res;
    });

});

//Nested Group of Routes
$app->group("/api",function(RouteCollectorProxy $apigroup) {
    $apigroup->group("/v1/users/{id:[0-9]+}",function(RouteCollectorProxy $group) {
        // declere methods can use in this recource
        $group->map(['GET','POST','PUT'],"",function(Request $req , Response $res , $args){
            $id = $args["id"] ?? null;
            $method = $req->getMethod();
            if( $method === "GET") {
                $res->getBody()->write("Hello User: $id");
                return $res;
            }
            if( $method === "POST") {
                $res->getBody()->write("Hello User: $id, Your data was updated");
                return $res;
            }
            if( $method === "PUT") {
                $res->getBody()->write("Hello User: $id, Your avatar Was Uploaded");
                return $res;
            }
        });
    });
    $apigroup->group("/v1/admins/{id:[0-9]+}",function(RouteCollectorProxy $group) {
        // declere methods can use in this recource
        $group->map(['GET','PUT','DELETE'],'',function(Request $req , Response $res , $args){
            $UserId = $args["id"] ?? null;
            $method = $req->getMethod();
            if( $method === "GET") {
                $res->getBody()->write("This Data For User: $UserId");
                return $res;
            }
            if( $method === "PUT") {
                $res->getBody()->write("User $UserId, His role Was Updated");
                return $res;
            }
            if( $method === "DELETE") {
                $res->getBody()->write("Uesr $UserId, Was Delted Successfully");
                return $res;

            }
        });
    });
});