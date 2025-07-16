<?php

use Slim\Views\Twig;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use App\Repositories\RecipeRepository;


$app->get('/recipes', function (Request $request, Response $response, array $args) {
    $view = Twig::fromRequest($request);
    return $view->render($response, 'recipes/index.twig', [
        "recipes" => RecipeRepository::all()
    ]);
});

$app->get('/recipes/add', function (Request $request, Response $response, array $args) {
    $view = Twig::fromRequest($request);
    return $view->render($response, 'recipes/create.twig');
});
$app->post('/recipes/add', function (Request $request, Response $response, array $args) {
    $recipe = new \App\Models\Recipe();
    $recipe->setName($request->getParsedBody()['name']);
    $recipe->setDescription($request->getParsedBody()['description']);
    $recipe->setDuration($request->getParsedBody()['duration']);
    $recipe->setDifficulty($request->getParsedBody()['difficulty']);

    RecipeRepository::store($recipe);

    return $response->withHeader('Location', '/recipes')->withStatus(302);
});
$app->get('/recipes/{id}', function (Request $request, Response $response, array $args) {
    $view = Twig::fromRequest($request);
    // dd(RecipeRepository::findById($args['id']));
    return $view->render($response, 'recipes/show.twig', [
        "recipe" => RecipeRepository::findById($args['id'])
    ]);
});
