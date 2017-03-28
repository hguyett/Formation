<?php

//On démarre la session
session_start();

//On inclut le fichier s'il existe et s'il est spécifié
if (!empty($_GET['page']) && is_file($_GET['page'] . '.php'))
{
    include 'controleurs/' . $_GET['page'].'.php';
}
else
{
    include 'controleurs/news.php';
}
