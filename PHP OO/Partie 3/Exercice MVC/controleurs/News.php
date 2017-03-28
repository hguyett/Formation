<?php
/* C'est en tout début de fichier que l'on vérifie les autorisations. Les
news sont visibles par tous, mais si vous voulez en restreindre l'accès, c'est
ici que cela se passe. */

//On inclut le modèle
include(dirname(__FILE__) . '/../modeles/news.php');

/* On effectue ici diverses actions, comme supprimer des news, par exemple. ;)
Il n'y en aura aucune dans ce tutoriel pour rester simple, mais libre à vous d'en rajouter. */

//On récupère les news
$newsList = recuperer_news();

//On inclut la vue
include(dirname(__FILE__) . '/../vues/news.php');
?>
