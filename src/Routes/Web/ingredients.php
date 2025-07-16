<?php

use Slim\Views\Twig;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use App\Models\Ingredient;
use App\Repositories\RecipeRepository;
use App\Repositories\IngredientRepository;

$app->get('/ingredients', function (Request $request, Response $response, array $args) {
    $view = Twig::fromRequest($request);
    return $view->render($response, 'ingredients/index.twig', [
        "ingredients" => IngredientRepository::all()
    ]);
});

$app->get('/ingredients/add', function (Request $request, Response $response, array $args) {
    $view = Twig::fromRequest($request);
    return $view->render($response, 'ingredients/create.twig');
});

$app->get('/ingredients/{id}', function (Request $request, Response $response, array $args) {
    $view = Twig::fromRequest($request);
    $recipes = RecipeRepository::getRecipesByIngredientId($args['id']);
    return $view->render($response, 'ingredients/show.twig', [
        "ingredient" => IngredientRepository::findById($args['id']),
        "recipes" => $recipes
    ]);
});



$app->post('/ingredients/add', function (Request $request, Response $response, array $args) {
    $ingredient = new Ingredient;
    $ingredient->setName($request->getParsedBody()['name']);
    // dd($ingredient);

    IngredientRepository::store($ingredient);

    return $response->withHeader('Location', '/ingredients')->withStatus(302);
});
