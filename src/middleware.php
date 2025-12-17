<?php
use JimTools\JwtAuth\Decoder\FirebaseDecoder;
use JimTools\JwtAuth\Middleware\JwtAuthentication;
use JimTools\JwtAuth\Options;
use JimTools\JwtAuth\Secret;
use JimTools\JwtAuth\Rules\RequestPathRule;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response as SlimResponse;// to create new response
use Tuupola\Middleware\HttpBasicAuthentication;

// $error = $container->get('ErrorOperation');
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
/*   ==================   */
// JWT Token 


$options = new Options(
    isSecure: false,
    relaxed : ['localhost'],
    header: 'Authorization',
    regexp: '/Bearer\s+(.*)$/i',
    attribute: 'token'
);
$secret = new Secret('JWTF0r0Xbedo','HS512');
$rules = [new RequestPathRule(
  paths: [ '/'],
  ignore: ['/Slim-API-PHP/public/JWTToken']
)];
/* ===========================
   JWT DECODER
=========================== */

// $decoder = new FirebaseDecoder($secret); 
$decoder = new FirebaseDecoder($secret); 
$app->add( new  JwtAuthentication($options, $decoder, $rules));


