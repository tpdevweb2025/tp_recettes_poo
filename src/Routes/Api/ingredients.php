<?php

use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteCollectorProxy;
use App\Repositories\IngredientRepository;

$app->group('/api/ingredients', function (RouteCollectorProxy $api) {
    $api->get("", function (Request $request, Response $response) {
        $response->getBody()->write(json_encode(IngredientRepository::all()));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    });

    $api->get("/{id}", function (Request $request, Response $response, array $args) {
        $ingredient = IngredientRepository::findById($args['id']);
        $response->getBody()->write(json_encode($ingredient));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    });
});
