<?php
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;// for middleware
use Slim\Psr7\Response as SlimResponse;// to create new response
$app->get("/middleware", function (Request $request, Response $response) {

  // $request = $request->withHeader("0xbedo","admin");

  $response->getBody()->write(" This is Your Route \n");

  return $response->withHeader('Content-Type', 'application/json');
});

//  middleware for Specifc endpoint  

$SecMiddleware = function (Request $req, RequestHandler $handler): Response{
// this Middleware for payment endoint Before Route Execution

// //handler to pass this

$auth = $req->getHeaderLine("payment");
if ($auth === "true") {
  $RoutedResponse = $handler->handle($req);
  $RoutedResponse->getBody()->write("[+] Check Done  [+]\n [+] Routed Done [+]");
  return $RoutedResponse;
}else{
  $newRes = new SlimResponse();
    $newRes->getBody()->write(string: "[+] You No't auth to go into payment [+]");
    return $newRes->withStatus( code: 403);
}};

$app->get('/payment', function (Request $req,Response $res){

  $res->getBody()->write(string: "[+] This is Payment Endpoint [+]\n-- After Pass Middleware -- \n");
  return $res;
})->add($SecMiddleware);