<?php

use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteCollectorProxy;
use App\Repositories\RecipeRepository;
use App\Repositories\IngredientRepository;


$app->group('/api', function (RouteCollectorProxy $api) {

    $api->get("", function (Request $request, Response $response) {
        $response->getBody()->write("API v1.0.0");
        return $response->withStatus(200);
    });

    /* SEARCH ROUTES */
    $api->get("/recipes/search/duration/{duration}", function (Request $request, Response $response, array $args) {
        $response->getBody()->write(json_encode(RecipeRepository::getRecipesByDuration($args['duration'])));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    });

    $api->get("/recipes/search/ingredient/{ingredient}", function (Request $request, Response $response, array $args) {
        $response->getBody()->write(json_encode(RecipeRepository::getRecipesByIngredient($args['ingredient'])));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    });


    /* RECIPES ROUTES */
    $api->get("/recipes", function (Request $request, Response $response) {
        $response->getBody()->write(json_encode(RecipeRepository::all()));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    });

    $api->get("/recipes/{id}", function (Request $request, Response $response, array $args) {
        $recipe = RecipeRepository::findById($args['id']);
        $response->getBody()->write(json_encode($recipe));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    });

    /* INGREDIENTS ROUTES */
    $api->get("/ingredients", function (Request $request, Response $response) {
        $response->getBody()->write(json_encode(IngredientRepository::all()));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    });

    $api->get("/ingredients/{id}", function (Request $request, Response $response, array $args) {
        $ingredient = IngredientRepository::findById($args['id']);
        $response->getBody()->write(json_encode($ingredient));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    });
});
