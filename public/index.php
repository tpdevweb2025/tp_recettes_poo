<?php

use Middlewares\TrailingSlash;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpNotFoundException;
use Slim\Factory\AppFactory;

require_once __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();
$app->add(new TrailingSlash());
$errorMiddleware = $app->addErrorMiddleware(true, true, true);

require __DIR__ . '/../src/Routes/Api/routes.php';
require __DIR__ . '/../src/Routes/Web/routes.php';

$errorMiddleware->setErrorHandler(
    HttpNotFoundException::class,
    function (ServerRequestInterface $request, Throwable $exception, bool $displayErrorDetails) use ($app) {
        $response = $app->getResponseFactory()->createResponse();
        $response->getBody()->write('404 NOT FOUND');
        return $response->withStatus(404);
    }
);

$app->run();
