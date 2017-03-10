<?php

///////////////
// Functions //
///////////////

function createCharacter(String $name, CharactersManager $manager)
{
    $character = new Character(array('name' => $name));
    $manager->add($character);

}

/******************************
 * ---------- MAIN ---------- *
 ******************************/

if (isset($_POST['characterName']) and is_string($_POST['characterName']) and !empty($_POST['characterName'])) {
    require 'Character.php';
    require 'CharactersManager.php';
    $pdo = new PDO('mysql:host=localhost;dbname=combat_minigame;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $manager = new CharactersManager($pdo);
    if (isset($_POST['create_character'])) {
        createCharacter($_POST['characterName'], $manager);
    } elseif (isset($_POST['use_character'])) {
        # code...
    }
}
