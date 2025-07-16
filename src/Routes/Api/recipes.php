<?php

use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteCollectorProxy;
use App\Repositories\RecipeRepository;

$app->group('/api/recipes', function (RouteCollectorProxy $api) {
    $api->get("/search/duration/{duration}", function (Request $request, Response $response, array $args) {
        $response->getBody()->write(json_encode(RecipeRepository::getRecipesByDuration($args['duration'])));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    });

    $api->get("/search/ingredient/{ingredient}", function (Request $request, Response $response, array $args) {
        $response->getBody()->write(json_encode(RecipeRepository::getRecipesByIngredient($args['ingredient'])));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    });

    $api->get("", function (Request $request, Response $response) {
        $response->getBody()->write(json_encode(RecipeRepository::all()));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    });

    $api->get("/{id}", function (Request $request, Response $response, array $args) {
        $recipe = RecipeRepository::findById($args['id']);
        $response->getBody()->write(json_encode($recipe));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    });
});
