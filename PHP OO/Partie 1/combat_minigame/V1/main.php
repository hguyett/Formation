<?php
session_start();

///////////////
// Functions //
///////////////

/**
 * Create a character.
 * @param  String            $name    Name for the new character.
 * @param  CharactersManager $manager Database Characters manager.
 */
function createCharacter(String $name, CharactersManager $manager)
{
    $character = new Character(array('name' => $name));
    $NameIsAvailable = $manager->add($character);
    if (!$NameIsAvailable) {
        include 'welcome_form.html';
        echo '<p>Un personnage existe déjà avec ce nom.</p>' . PHP_EOL;
    } else {
        useCharacter($name, $manager);
    }
}

function useCharacter(String $name, CharactersManager $manager)
{
    try {
        $character = new Character($manager->get($name));
        if (isset($_POST['characterName']) and is_string($_POST['characterName']) and !empty($_POST['characterName'])) {
            $_SESSION['character'] = $_POST['characterName'];
        }
        include 'game_form.php';

        $charactersList = $manager->getList();
        echo '<table>';
        echo '<tr><th>Nom</th><th>Dégats</th></tr>' . PHP_EOL;
        foreach ($charactersList as $array => $charactersEntry) {
            echo '<tr>';
            foreach ($charactersEntry as $key => $value) {
                echo '<td>' . $value . '</td>';
            }
            echo '</tr>' . PHP_EOL;
        }
        echo '</table>';
    } catch (Exception $e) {
        include 'welcome_form.html';
        echo '<p>Ce personnage n\'existe pas.</p>' . PHP_EOL;
    }
}

/******************************
 * ---------- MAIN ---------- *
 ******************************/

// Création ou sélection d'un nouveau personnage.
require 'Character.php';
require 'CharactersManager.php';
$pdo = new PDO('mysql:host=localhost;dbname=combat_minigame;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$manager = new CharactersManager($pdo);
if (isset($_POST['characterName']) and is_string($_POST['characterName']) and !empty($_POST['characterName'])) {
    // Création d'un personnage.
    if (isset($_POST['create_character'])) {
        createCharacter($_POST['characterName'], $manager);
    // Sélection d'un personnage.
    } elseif (isset($_POST['use_character'])) {
        useCharacter($_POST['characterName'], $manager);
    }
// Frapper un personnage.
} elseif (isset($_POST['hit_character'])) {
    if (isset($_POST['targetName']) and is_string($_POST['targetName'])) {
        try {
            $target = new Character($manager->get($_POST['targetName']));
            $character = new Character($manager->get($_SESSION['character']));
            $character->hit($target);
            $manager->update($target);
            echo '<p>' . $character->name() . ' frappe ' . $target->name() . ' et lui inflige ' . Character::HIT_DAMAGES . ' points de dégats.' . '</p>';
            if ($target->damages() >= Character::HEALTH_POINTS) {
                echo $target->name() . ' est mort !';
                $manager->delete($target);
            }
            useCharacter($_SESSION['character'], $manager);
        } catch (Exception $e) {
            echo('Ce personnage n\'existe pas.');
            useCharacter($_SESSION['character'], $manager);
        }
    }
} else {
    include 'welcome_form.html';
}
