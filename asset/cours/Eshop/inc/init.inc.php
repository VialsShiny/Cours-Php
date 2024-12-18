<?php
/*
 * Configuration du Site
 */

// Charger les variables d'environnement

function LoadEnv($filePatch = '.env')
{
    if (!file_exists($filePatch)) {
        throw new Exception("File not found: $filePatch");
    }

    // ignore les commentaires dans .env
    $lines = file($filePatch, FILE_IGNORE_NEW_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) {
            continue;
        }

        // récupérer les variables d'environnement et les rendre exploitables PHP
        [$key, $value] = explode('=', $line, 2);

        // suprimer les espaces et définir la variable d'environnement
        $key = trim($key);
        $value = trim($value);
        putenv("$key=$value");

        /* Optionel, pour rendre les variables d'environnement accesibles dans les super globales  */
        $_ENV[$key] = $value;
        $_SERVER[$key] = $value;
    }
}

// Charger les varaibles d'environnnement
try {
    LoadEnv(__DIR__ . '\.env');
} catch (Exception $e) {
    die('Erreur :' . $e->getMessage());
}

// Connexion BDD
try {
    $pdo = new PDO(
        'mysql:host=' . getenv('DB_HOST') . ';dbname=' . getenv('DB_NAME'),
        getenv('DB_USER'),
        getenv('DB_PASS'),
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // pour afficher les messages d'erreur SQL
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4', // définition du jeu de caractères des échanges avec la BDD
        ]
    );
} catch (Exception $e) {
    die('Erreur de connexion à la BDD: ' . $e->getMessage());
}

/*
 * Session
 */
session_start();

/*
 * Constante qui contient le chemin du site
 */
define('RACINE_SITE', '/Cours_Php/asset/cours/Eshop/');

/*
 * Variable d'affichage
 */
$contenu = '';
$contenue_gauche = '';
$contenue_droite = '';

/*
 * Inclusion des fonctions du sites
 */

require_once 'functions.inc.php';
