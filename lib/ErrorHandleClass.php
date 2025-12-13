<?php

use Psr\Http\Message\ResponseInterface as Response;

class ErrorHandle{
  public function error(Response $res , string $message, int $status){
    $paylod = json_encode([
      'status' => 'error',
      'message'=> $message
    ]);

    $res->getBody()->write($paylod);
    return $res->withStatus($status)->withHeader("Content-Type","application/json");
}
}