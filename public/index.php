<?php
use Psr\Http\Message\ServerRequestInterface as Request;
use JimTools\JwtAuth\Exceptions\AuthorizationException;
use DI\Container;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

// 1. إعداد الكونتينر (يجب أن يكون في البداية)
$container = new Container();

/* ===========================
   LOAD CLASSES (يفضل تحميل الكلاسات في البداية)
=========================== */
require __DIR__ .'/../lib/ErrorHandleClass.php';
require __DIR__ .'/../lib/JsonService.php';
require __DIR__ .'/../lib/middlewareClass.php';

/* ===========================
   DEPENDENCY INJECTION
   (حمل تعريفات الكونتينر هنا قبل إنشاء التطبيق)
=========================== */
// تأكد أن هذا الملف يحتوي على $container->set('ErrorOperation', ...)
require __DIR__ .'/../src/DependencyInjection.php';

// ربط الكونتينر بالتطبيق
AppFactory::setContainer($container);
$app = AppFactory::create();

// إعدادات المسار والبودي
$app->setBasePath('/Slim-API-PHP/public');
$app->addBodyParsingMiddleware();
$app->addRoutingMiddleware();


/* ===========================
   GLOBAL MIDDLEWARES (JWT)
   (الترتيب: يجب إضافة JWT أولاً)
=========================== */
require __DIR__ .'/../src/middleware.php';


/* ===========================
   ERROR MIDDLEWARE & HANDLERS
   (الترتيب: يجب إضافة هذا الجزء في النهاية ليمسك الأخطاء)
=========================== */
// 1. إضافة الميدل وير الخاص بالأخطاء
$errorMiddleware = $app->addErrorMiddleware(true, true, true);

// 2. استدعاء ملف الهاندلر (الذي يعرف المتغير $customJwtErrorHandler)
require __DIR__ . '/../src/handlers.php';

// 3. ربط الهاندلر (تأكد أن اسم المتغير مطابق للموجود في handlers.php)
// غالباً احنا سميناه $customJwtErrorHandler في الخطوات السابقة
$errorMiddleware->setErrorHandler(
    \JimTools\JwtAuth\Exceptions\AuthorizationException::class,
    $jwtErrorHandler
);


/* ===========================
   ROUTES
=========================== */
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
require_once __DIR__ .'/../Routes/JWTToken.php';

// Run app
$app->run();