<?php
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

$app->get("/request[/{name:[a-zA-Z]+}]", function(Request $req, Response $res , $args){

  $name = $args["name"] ?? null;
  $out = [];
  $out["method"] = $req->getMethod();
  $out["Port"] = $req->getUri()->getPort();
  $out["auth"] = $req->getUri()->getAuthority();
  $out["Path"] = $req->getUri()->getPath();
  $out["Host"] = $req->getUri()->getHost();
  $out["ParsedData"] = $req->getParsedBody();
  $out["Attribute"] = $req->getAttribute("name");

  //Headers
  $headers = $req->getHeaders();

  foreach ($headers as $name => $values) {
      $out[$name] = implode(", ", $values);
  }

  $res->getBody()->write(json_encode($out));
  return $res;
});
  // $out["Status Code"] = $res->getStatusCode();
  // $res->getBody()->write(json_encode($out));
  // edit in status code
  // $newResponse = $res->withStatus(302);
  // $out["Status Code"] = $newResponse->getStatusCode();
