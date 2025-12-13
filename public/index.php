<?php
// use Psr\Http\Message\ServerRequestInterface as Request;
// use Psr\Http\Message\ResponseInterface as Response;
use DI\Container;
use Slim\Factory\AppFactory;


require __DIR__ . '/../vendor/autoload.php';

$container = new Container();
AppFactory::setContainer($container);
$app = AppFactory::create();
$app->addBodyParsingMiddleware();

$app->setBasePath('/Slim-API-PHP/public');
$app->addRoutingMiddleware();
$errorMiddleware = $app->addErrorMiddleware(true, true, true);
require __DIR__ .'/../src/DependencyInjection.php';
require __DIR__ .'/../lib/JsonService.php';
require __DIR__ .'/../src/middleware.php';
require __DIR__ .'/../lib/middlewareClass.php';
require __DIR__ .'/../lib/ErrorHandleClass.php';
require_once __DIR__ .'/../Routes/args.php';
require_once __DIR__ .'/../Routes/GroupRoutes.php';
require_once __DIR__ .'/../Routes/jsonResponse.php';
require_once __DIR__ .'/../Routes/MultiMethods.php';
require_once __DIR__ .'/../Routes/put_deletee.php';
require_once __DIR__ .'/../Routes/regularExp.php';
require_once __DIR__ .'/../Routes/simple.php';
require_once __DIR__ .'/../Routes/RequestObject.php';
require_once __DIR__ .'/../Routes/ResponseObject.php';
require_once __DIR__ .'/../Routes/testMiddleware.php';
require_once __DIR__ .'/../Routes/CallServices.php';
require_once __DIR__ .'/../Routes/BasicAuth.php';
require_once __DIR__ .'/../Routes/UploadFiles.php';









// Run app
$app->run();