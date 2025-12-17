<?php

use Psr\Http\Message\ResponseInterface as Response;

class ErrorHandle{
  public function error(Response $res , string $message, int $status, array $extra = []): Response{
    $paylod = [
      'status' => 'error',
      'message'=> $message
    ];
    if(!empty($extra)){
      $paylod['errors'] = $extra; 
    }

    $res->getBody()->write(json_encode($paylod, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
    return $res->withStatus($status)->withHeader("Content-Type","application/json");
}
}