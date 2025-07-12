-- Active: 1750750848329@@127.0.0.1@3306@tp_recettes
CREATE TABLE `ingredients`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL
);

ALTER TABLE
    `ingredients` ADD UNIQUE `ingredients_name_unique`(`name`);

CREATE TABLE `recipes`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `description` TEXT NULL,
    `duration` INT NOT NULL,
    `difficulty` ENUM('facile', 'normale', 'difficile') NOT NULL
);

ALTER TABLE
    `recipes` ADD UNIQUE `recipes_name_unique`(`name`);

CREATE TABLE `ingredients_recipes`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `ingredient_id` INT UNSIGNED NOT NULL,
    `recipe_id` INT UNSIGNED NOT NULL,
    `quantity` DECIMAL(6, 2) NOT NULL,
    `unity` VARCHAR(255) NOT NULL
);

ALTER TABLE
    `ingredients_recipes` ADD CONSTRAINT `ingredients_recipes_recipe_id_foreign` FOREIGN KEY(`recipe_id`) REFERENCES `recipes`(`id`);
    
ALTER TABLE
    `ingredients_recipes` ADD CONSTRAINT `ingredients_recipes_ingredient_id_foreign` FOREIGN KEY(`ingredient_id`) REFERENCES `ingredients`(`id`);

-- 12 Ingredients
INSERT INTO `ingredients` (`name`) VALUES
('Farine'),
('Oeufs'),
('Lait'),
('Sucre'),
('Beurre'),
('Chocolat noir'),
('Pommes'),
('Poulet'),
('Riz'),
('Tomates'),
('Oignons'),
('Ail');

-- 5 Recipes
INSERT INTO `recipes` (`name`, `description`, `duration`, `difficulty`) VALUES
('Crêpes simples', 'Recette classique de crêpes légères et moelleuses, parfaites pour le petit-déjeuner ou le goûter.', 30, 'facile'),
('Gâteau au chocolat fondant', 'Un gâteau au chocolat riche et décadent, avec un cœur coulant.', 45, 'normale'),
('Tarte aux pommes', 'Une tarte aux pommes traditionnelle, croustillante et parfumée.', 60, 'normale'),
('Curry de poulet', 'Un curry de poulet savoureux et épicé, accompagné de riz.', 75, 'difficile'),
('Salade de tomates et mozzarella', 'Une salade fraîche et simple, idéale pour l''été.', 15, 'facile');

-- Crêpes simples (ID 1)
INSERT INTO `ingredients_recipes` (`recipe_id`, `ingredient_id`, `quantity`, `unity`) VALUES
(1, 1, 250.00, 'g'),
(1, 2, 3.00, 'unités'),
(1, 3, 500.00, 'ml'),
(1, 4, 50.00, 'g');

-- Gâteau au chocolat fondant (ID 2)
INSERT INTO `ingredients_recipes` (`recipe_id`, `ingredient_id`, `quantity`, `unity`) VALUES
(2, 6, 200.00, 'g'),
(2, 5, 150.00, 'g'),
(2, 1, 50.00, 'g');

-- Tarte aux pommes (ID 3)
INSERT INTO `ingredients_recipes` (`recipe_id`, `ingredient_id`, `quantity`, `unity`) VALUES
(3, 7, 4.00, 'unités'),
(3, 1, 200.00, 'g'),
(3, 4, 70.00, 'g');

-- Curry de poulet (ID 4)
INSERT INTO `ingredients_recipes` (`recipe_id`, `ingredient_id`, `quantity`, `unity`) VALUES
(4, 11, 2.00, 'unités'),
(4, 12, 3.00, 'gousses'),
(4, 10, 200.00, 'g');

-- Salade de tomates et mozzarella (ID 5)
INSERT INTO `ingredients_recipes` (`recipe_id`, `ingredient_id`, `quantity`, `unity`) VALUES
(5, 10, 3.00, 'unités'),
(5, 3, 125.00, 'g');

