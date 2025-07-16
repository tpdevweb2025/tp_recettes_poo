<?php

namespace App\Models;

use JsonSerializable;

class Recipe implements JsonSerializable
{
    private $id;
    private $name;
    private $description;
    private $duration;
    private $difficulty;
    private $ingredients = [];

    public function __construct() {}

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function addIngredient(int $id, string $ingredient, int $quantity, string $unit): void
    {
        $this->ingredients[] = [
            'id' => $id,
            'ingredient' => $ingredient,
            'quantity' => $quantity,
            'unit' => $unit,
        ];
    }

    public function getIngredients(): array
    {
        return $this->ingredients;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getDuration(): int
    {
        return $this->duration;
    }

    public function getDifficulty(): string
    {
        return $this->difficulty;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setDuration(int $duration): void
    {
        $this->duration = $duration;
    }

    public function setDifficulty($difficulty): void
    {
        $this->difficulty = $difficulty;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'duration' => $this->duration,
            'difficulty' => $this->difficulty,
            'ingredients' => $this->ingredients,
        ];
    }
}
