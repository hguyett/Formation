<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Secrets</h1>
    <?php
    if (isset($_POST['username']) and isset($_POST['password'])) {
        if ($_POST['username']== "hguyett" and $_POST['password'] == "azerty") {
            ?>
            <h2>Voici les codes d'accès :</h2>
            <p><strong>CRD5-GTFT-CK65-JOPM-V29N-24G1-HH28-LLFV</strong></p>
            <?php
        }
    }
    else {
        echo "Vous n'avez pas l'autorisation nécessaire pour afficher ce contenu";
    }
    ?>
</body>
</html>
