<?php

namespace App\Models;

class Recipe
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

    public function addIngredient(string $ingredient, int $quantity, string $unit): void
    {
        $this->ingredients[] = [
            'ingredient' => $ingredient,
            'quantity' => $quantity,
            'unit' => $unit,
        ];
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getDuration(): int
    {
        return $this->duration;
    }

    public function getDifficulty(): int
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

    public function setDifficulty(int $difficulty): void
    {
        $this->difficulty = $difficulty;
    }
}
