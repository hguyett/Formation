<?php
function recuperer_news(): array
{
    $database = new PDO('mysql:host=localhost;dbname=tests;charset=utf8;', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));    $newsList = $database->query("SELECT id, auteur, titre, DATE_FORMAT(date, '%d/%m/%Y %Hh') AS date_formatee, contenu FROM news ORDER BY date DESC");

    $newsList = $database->query("SELECT id, auteur, titre, DATE_FORMAT(date, '%d/%m/%Y %Hh') AS date_formatee, contenu FROM news ORDER BY date DESC");

    return $newsList->fetchall();
}
