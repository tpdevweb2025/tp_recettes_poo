<?php

use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

$twig = Twig::create(__DIR__ . '/../../App/Views', ['cache' => false]);
$app->add(TwigMiddleware::create($app, $twig));

require "recipes.php";
require "ingredients.php";
