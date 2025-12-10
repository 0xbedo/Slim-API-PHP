<?php
// use Psr\Http\Message\ServerRequestInterface as Request;
// use Psr\Http\Message\ResponseInterface as Response;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();
$app->addBodyParsingMiddleware();

$app->setBasePath('/Slim-API-PHP/public');
$app->addRoutingMiddleware();
$errorMiddleware = $app->addErrorMiddleware(true, true, true);

require_once __DIR__ .'/../Routes/args.php';
require_once __DIR__ .'/../Routes/GroupRoutes.php';
require_once __DIR__ .'/../Routes/jsonResponce.php';
require_once __DIR__ .'/../Routes/MultiMethods.php';
require_once __DIR__ .'/../Routes/put_deletee.php';
require_once __DIR__ .'/../Routes/regularExp.php';
require_once __DIR__ .'/../Routes/simple.php';
require_once __DIR__ .'/../Routes/RequestObject.php';









// Run app
$app->run();