<?php

use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Psr7\Response;
use Psr\Container\ContainerInterface;
use Firebase\JWT\ExpiredException;
use JimTools\JwtAuth\Exceptions\AuthorizationException;

/** * هذا التعليق يخبر المحرر أن المتغير container موجود
 * @var ContainerInterface $container 
 */

$jwtErrorHandler = function (
    Request $request,
    Throwable $exception,
    bool $displayErrorDetails,
    bool $logErrors,
    bool $logErrorDetails
) use ($container) {

    // 1. استدعاء خدمة الـ ErrorOperation
    $errorService = $container->get('ErrorOperation');
    
    // 2. إنشاء Response جديد
    $response = new Response();

    // 3. الرسالة الافتراضية
    $message = 'Unauthorized access';
    $status  = 401;

    // الحصول على الخطأ الداخلي (السبب الحقيقي)
    $previousError = $exception->getPrevious();

    // =========================================================
    // 4. فحص نوع الخطأ وتغيير الرسالة
    // =========================================================
    
    // أ) فحص انتهاء الصلاحية (بالكلاس أو بنص الرسالة لضمان العمل)
    if (
        ($previousError instanceof ExpiredException) || 
        ($previousError && $previousError->getMessage() === 'Expired token')
    ) {
        $message = 'Token has expired';
    } 
    // ب) فحص عدم وجود التوكين
    elseif ($exception->getMessage() === 'Token not found.') {
        $message = 'Token not provided';
    }

    // 5. إرجاع الرد JSON
    return $errorService->error($response, $message, $status);
};

// =========================================================
// 5. ربط الهاندلر (إذا كان الميدل وير متاحاً)
// =========================================================
if (isset($errorMiddleware)) {
    $errorMiddleware->setErrorHandler(
        AuthorizationException::class,
        $jwtErrorHandler
    );
}