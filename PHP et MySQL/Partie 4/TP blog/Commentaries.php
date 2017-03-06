<?php
    $database = new PDO('mysql:host=localhost;dbname=blog;charset=utf8','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
?><!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Commentaires</h1>
    </header>
<?php
$articleFound = TRUE;
if (isset($_GET['ID']) and (int)$_GET['ID']>0) {
    try {
        $query = $database->prepare('SELECT *, DATE_FORMAT(Date_commented, \'%d/%m/%Y à %Hh%i\') AS Date_commented_fr FROM commentaries WHERE ID=? ORDER BY Date_commented');
        $query->execute(array($_GET['ID']));
        $data = $query;
    } catch (Exception $e) {
        die('Error while loading articles : ' . $e->getMessage());
    }
} else {
    $articleFound = FALSE;
}

if (isset($data) and ($data->rowCount() > 0)){
    $record = NULL;
    while ($record = $data->fetch()) {
        /*Écriture des commentaires en html*/ ?>
<h2>Commentaire de <?php echo $record['Author'] ?></h2>
<p>Publié le <time datetime="<?php echo $record['Date_commented'] ?>"><?php echo $record['Date_commented_fr'] ?></time></p>
<p><?php echo $record['Content']; ?></p>
<?php
    }
$data->closeCursor();
} else {
    $articleFound = FALSE;
}

if (!$articleFound) {
    echo '<p>L\'article demandé est introuvable.</p>';
}
?>

</body>
</html>
