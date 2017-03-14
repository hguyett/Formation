<?php
session_start();

///////////////
// Functions //
///////////////

function classAutoLoader($class)
{
    require $class . '.php';
}

function loadCharacter(String $name, CharactersManager $manager)
{
    $characterData = $manager->get($name);
    $characterClass = $characterData['class'];
    $character = new $characterClass($characterData);
    return $character;
}

/**
 * Create a character.
 * @param  String            $name    Name for the new character.
 * @param  CharactersManager $manager Database Characters manager.
 */
function createCharacter(String $name, CharactersManager $manager)
{
    $character = new $_POST['classSelection'](array('name' => $name));
    $NameIsAvailable = $manager->add($character);
    if (!$NameIsAvailable) {
        include 'welcome_form.html';
        echo '<p>Un personnage existe déjà avec ce nom.</p>' . PHP_EOL;
    } else {
        useCharacter($name, $manager);
    }
}

//createCharacter($_POST['characterName'], $manager);
function useCharacter(String $name, CharactersManager $manager)
{
    try {
        loadCharacter($name, $manager);
        if (isset($name) and is_string($name) and !empty($name)) {
            $_SESSION['character'] = $name;
        }
        include 'game_form.php';

        include 'character_list.php';
    } catch (Exception $e) {
        include 'welcome_form.html';
        echo '<p>Ce personnage n\'existe pas.</p>' . PHP_EOL;
    }
}

/******************************
 * ---------- MAIN ---------- *
 ******************************/

// Chargement dynamique des classes PHP
spl_autoload_register('classAutoLoader');

// Gestion de l'écran d'accueil
require 'Character.php';
require 'CharactersManager.php';
$pdo = new PDO('mysql:host=localhost;dbname=combat_minigame;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$manager = new CharactersManager($pdo);
if (isset($_POST['characterName']) and is_string($_POST['characterName']) and !empty($_POST['characterName'])) {
    // Créer le personnage -> Affichage du formulaire de création
    if (isset($_POST['create_character'])) {
        include 'create_character_form.php';
    // Utiliser un personnage existant -> Lancement du jeu
    } elseif (isset($_POST['use_character'])) {
        useCharacter($_POST['characterName'], $manager);
    }

// Création du personnage
} elseif (isset($_POST['create_character_submit'])) {
    createCharacter($_POST['createCharacterName'], $manager);

// Gestion du jeu
} elseif (isset($_POST['hit_character']) or isset($_POST['use_skill']) or isset($_POST['use_skill_submit'])) {
    //Gestion des coups
    if (isset($_POST['hit_character']) and isset($_POST['targetName']) and is_string($_POST['targetName'])) {
        try {
            $target = loadCharacter($_POST['targetName'], $manager);
            $character = loadCharacter($_SESSION['character'], $manager);
            $character->hit($target);
            $manager->update($target);
            echo '<p>' . $character->name() . ' frappe ' . $target->name() . ' et lui inflige ' . $character::HIT_DAMAGES . ' points de dégats.' . '</p>';
            if ($target->damages() >= $character::HEALTH_POINTS) {
                echo $target->name() . ' est mort !';
                $manager->delete($target);
            }
            useCharacter($_SESSION['character'], $manager);
        } catch (Exception $e) {
            echo('Ce personnage n\'existe pas.');
            useCharacter($_SESSION['character'], $manager);
        }
    //Gestion des sorts
    } elseif (isset($_POST['use_skill'])) {
        include 'skill_selection_form.php';
    }
    elseif (isset($_POST['use_skill_submit'])) {
        $skill = $_POST['skillsList'];
        echo htmlspecialchars($_SESSION['character'], ENT_QUOTES, 'utf-8') . ' utilise ' . htmlspecialchars($skill, ENT_QUOTES, 'utf-8') . ' sur ' . htmlspecialchars($_POST['skillTarget'], ENT_QUOTES, 'utf-8') . '.';
        $target = loadCharacter($_POST['skillTarget'], $manager);
        $character = loadCharacter($_SESSION['character'], $manager);
        $character->$skill($target);
        $manager->update($target);
        $manager->update($character);
        useCharacter($_SESSION['character'], $manager);
    }
} else {
    include 'welcome_form.html';
}
