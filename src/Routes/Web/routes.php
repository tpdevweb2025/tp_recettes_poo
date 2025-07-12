<?php

use Slim\Psr7\Request;
use Slim\Psr7\Response;

$app->get("/", function (Request $request, Response $response) {
    $response->getBody()->write("Hello World");
    return $response->withStatus(200);
});
