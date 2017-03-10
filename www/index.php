<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form method="post" action="">
        <p><label for="characterName">Nom du personnage : </label><input type="text" name="characterName" value=""></p>
        <p><input type="submit" value="Créer le personnage" name="create_character"></p>
        <p><input type="submit" value="Utiliser un personnage existant" name="use_character"></p>
    </form>
<?php include ('main.php'); ?>
</body>
</html>
