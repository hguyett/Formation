<?php
// Modification d'une entrée dans la base de données

try {
    $database = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$database->query('UPDATE jeux_video SET possesseur = \'Florent\' WHERE ID=1');
