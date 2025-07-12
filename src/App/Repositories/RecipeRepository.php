<?php

namespace App\Repositories;

use PDO;
use App\Db\DataBase;
use App\Models\Recipe;

class RecipeRepository
{
    public static function all()
    {
        $req = DataBase::getConnection()->prepare('SELECT * FROM recipes');
        $req->execute();
        $recipes = $req->fetchAll(PDO::FETCH_CLASS, 'App\Models\Recipe');

        return array_map(function (Recipe $recipe) {
            foreach (self::getIngredients($recipe) as $ingredient):
                $recipe->addIngredient($ingredient->name, $ingredient->quantity, $ingredient->unity);
            endforeach;
            return $recipe;
        }, $recipes);
    }

    public static function find(Recipe $recipe)
    {
        $req = DataBase::getConnection()->prepare('SELECT * FROM recipes WHERE id = ?');
        $req->execute([$recipe->getId()]);
        $req->setFetchMode(PDO::FETCH_CLASS, Recipe::class);
        $recipe = $req->fetch();
        foreach (self::getIngredients($recipe) as $ingredient):
            $recipe->addIngredient($ingredient->name, $ingredient->quantity, $ingredient->unity);
        endforeach;

        return $recipe;
    }
    public static function findById($id)
    {
        $req = DataBase::getConnection()->prepare('SELECT * FROM recipes WHERE id = ?');
        $req->execute([$id]);
        $req->setFetchMode(PDO::FETCH_CLASS, Recipe::class);
        $recipe = $req->fetch();
        foreach (self::getIngredients($recipe) as $ingredient):
            $recipe->addIngredient($ingredient->name, $ingredient->quantity, $ingredient->unity);
        endforeach;

        return $recipe;
    }

    public static function getRecipesByIngredient($ingredient)
    {
        $req = DataBase::getConnection()->prepare('SELECT recipes.* FROM recipes JOIN ingredients_recipes ON recipes.id = ingredients_recipes.recipe_id JOIN ingredients ON ingredients.id = ingredients_recipes.ingredient_id WHERE ingredients.name LIKE :name');
        $req->execute(['name' => "%$ingredient%"]);
        $recipes = $req->fetchAll(PDO::FETCH_CLASS, 'App\Models\Recipe');

        return array_map(function (Recipe $recipe) {
            foreach (self::getIngredients($recipe) as $ingredient):
                $recipe->addIngredient($ingredient->name, $ingredient->quantity, $ingredient->unity);
            endforeach;
            return $recipe;
        }, $recipes);
    }

    public static function getRecipesByDuration($maxDuration)
    {
        $req = DataBase::getConnection()->prepare('SELECT * FROM recipes WHERE duration <= :duration');
        $req->execute(['duration' => $maxDuration]);
        $recipes = $req->fetchAll(PDO::FETCH_CLASS, 'App\Models\Recipe');

        return array_map(function (Recipe $recipe) {
            foreach (self::getIngredients($recipe) as $ingredient):
                $recipe->addIngredient($ingredient->name, $ingredient->quantity, $ingredient->unity);
            endforeach;
            return $recipe;
        }, $recipes);
    }

    private static function getIngredients(Recipe $recipe)
    {
        $req = DataBase::getConnection()->prepare('SELECT ingredients.name, ingredients_recipes.quantity, ingredients_recipes.unity FROM ingredients_recipes JOIN ingredients ON ingredients.id = ingredients_recipes.ingredient_id WHERE ingredients_recipes.recipe_id = :id');
        $req->execute(['id' => $recipe->getId()]);
        return $req->fetchAll(PDO::FETCH_OBJ);
    }
}
