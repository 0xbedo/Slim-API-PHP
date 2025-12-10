<?php
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

$app->get("/response", function (Request $req, Response $res){
  $out = [];
// 
  $out["Status Code old"] = $res->getStatusCode();
  // $res->getBody()->write(json_encode($out));
  // edit in status code
  // $out["Status Code"] = $newResponse->getStatusCode();

  // Change Status add header
  $newResponse  = $res->withStatus(302);
  $newResponse= $newResponse->withHeader("X-NewHeader","0xbedo");
  $out["Status Code"] = $newResponse->getStatusCode();
  $out["hasHeader"]   = $newResponse->hasHeader("X-NewHeader");

 //Headers
  $headers = $newResponse->getHeaders();
  
  foreach ($headers as $name => $values) {
    $out[$name] = implode(", ", $values);
  }



  $newResponse->getBody()->write(json_encode($out, JSON_PRETTY_PRINT));
  return $newResponse->withHeader('Content-Type', 'application/json');;
}); 