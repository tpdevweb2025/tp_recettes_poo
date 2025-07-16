# Projet TP Recettes version POO

## Étapes pour instancier le projet

### Étape 1 : Cloner le projet

Cloner le projet à partir du dépôt Git :

```shell
https://github.com/tpdevweb2025/tp_recettes_poo
```

### Étape 2 : Installer les dépendances

Installez les dépendances nécessaires à l'aide de Composer :

```shell
composer install
```

### Étape 3 : Installer les données SQL

Importez les données SQL dans votre base de données en éxécutant les instructions contenues dans le fichier `data/save.sql`

### Étape 4 : Configurer l'environnement

Configurez les variables de votre connexion PDO dans le fichier `src/App/Db/DataBase.php`.

### Étape 5 : Lancer le serveur PHP

Lancez le serveur PHP sur le dossier public à l'aide de la commande suivante :

```shell
php -S localhost:8000 -t public
```

Ouvrez votre navigateur et accédez à l'adresse

```shell
http://localhost:8000
```

pour accéder à votre application.

## Remarques

- Assurez-vous d'avoir PHP et Composer installés sur votre système.
- Modifiez les valeurs des variables PDO pour correspondre à votre configuration.
