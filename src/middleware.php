<?php
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response as SlimResponse;// to create new response

$app->add( function ( Request $req, RequestHandler $handler): Response  {

// ----------------------
// BEFORE (قبل الراوت)
// ----------------------
// مثال: فحص الهيدرز أو التوكين أو أي شيء
$auth = $req->getHeaderLine("user");
if ($auth === "admin") {
  // لازم تبعت الريكوست للـ handler علشان يكمل ع الراوت
  $response = $handler->handle( $req );


// ----------------------
// AFTER (بعد الراوت)
// ----------------------
// مثال: تعديل الريسبونس بعد الراوت
  $response->getBody()->write(" \nsuccess Check for 0xbedo Header\n");
  return $response;

}else{
  $res = new SlimResponse(403);
  $res->getBody()->write("\n403: Forbidden You Not An admin");
  return $res;

}



});