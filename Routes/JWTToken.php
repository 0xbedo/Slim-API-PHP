<?php
use Firebase\JWT\JWT;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;


$app->get("/JWTToken", function (Request $request, Response $response){

    $now = new DateTimeImmutable();
    $future = $now->modify('+1 minute');;
$payload = [
  "iat" => $now->getTimestamp(),
  "exp" =>$future->getTimestamp(),
  "sub" => "test JWT"
];

$secret = "JWTF0r0Xbedo";
$token = JWT::encode($payload, $secret, "HS512");
$data = [
        'status' => 'OK',
        'token' => $token
    ];
$response->getBody()->write(json_encode($data , JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
return $response->withStatus(201)->withHeader('Content-Type',"application/json");



});