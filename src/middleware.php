<?php
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response as SlimResponse;// to create new response
use Tuupola\Middleware\HttpBasicAuthentication;

// old middleware
/*
$app->add( function ( Request $req, RequestHandler $handler): Response  {

// ----------------------
// BEFORE (قبل الراوت)
// ----------------------
// مثال: فحص الهيدرز أو التوكين أو أي شيء
// $auth = $req->getHeaderLine("user");
$auth = $req->getHeaderLine("user");
if ($auth === "admin") {
  // لازم تبعت الريكوست للـ handler علشان يكمل ع الراوت
  $response = $handler->handle( $req );


// ----------------------
// AFTER (بعد الراوت)
// ----------------------
// مثال: تعديل الريسبونس بعد الراوت
  $response->getBody()->write(" \nsuccess Check for admin Header\n");
  return $response;

}else{
  $res = new SlimResponse(403);
  $res->getBody()->write("\n403: Forbidden You Not An admin");
  return $res;

}});*/

// Basic Auth Middleware
class BasicAuthMiddleware {
  private static array $users = [
    "0xbedo"=>"123456",
    "user"=>"123456",
    "admin"=>"123456"
];
  public static function create(): HttpBasicAuthentication{
    $bacicAuth = new HttpBasicAuthentication(options: [
      'realm' => 'protected api',
      'authenticator' => static function (array $args){
        $user = $args["user"] ?? '';
        $password = $args["password"] ?? '';
        return isset(self::$users[$user]) && self::$users[$user] === $password;
    }]);
return $bacicAuth;
  }
}

    // if( $user === '0xbedo' && $password === '123456'){
    //   return true;
    // }else{
    //   return false;
    // }