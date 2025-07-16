<?php

namespace App\Repositories;

use PDO;
use App\Db\DataBase;
use App\Models\Ingredient;

class IngredientRepository
{
    public static function all()
    {
        $req = DataBase::getConnection()->prepare('SELECT * FROM ingredients');
        $req->execute();
        return $req->fetchAll(PDO::FETCH_CLASS, 'App\Models\Ingredient');
    }

    public static function find(Ingredient $ingredient)
    {
        $req = DataBase::getConnection()->prepare('SELECT * FROM ingredients WHERE id = ?');
        $req->execute([$ingredient->getId()]);
        $req->setFetchMode(PDO::FETCH_CLASS, Ingredient::class);
        $ingredient = $req->fetch();

        return $ingredient;
    }
    public static function findById($id)
    {
        $req = DataBase::getConnection()->prepare('SELECT * FROM ingredients WHERE id = ?');
        $req->execute([$id]);
        $req->setFetchMode(PDO::FETCH_CLASS, Ingredient::class);
        $ingredient = $req->fetch();

        return $ingredient;
    }

    public static function store(Ingredient $ingredient)
    {
        $req = DataBase::getConnection()->prepare('INSERT INTO ingredients (name) VALUES (?)');
        $req->execute([$ingredient->getName()]);
    }
}
