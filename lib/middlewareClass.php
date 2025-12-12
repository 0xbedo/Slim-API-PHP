<?php
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;// for middleware

class MiddlewareClass{
  public function __invoke( Request $req, RequestHandler $handler ){
    $res = $handler->handle( $req );
    $res->getBody()->write("[+]Mid Class[+]\n");
    return $res;

}
}