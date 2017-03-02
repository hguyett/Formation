<?php
    $database = new PDO('mysql:host=localhost;dbname=blog;charset=utf8','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
?><!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Commentaires</h1>
<?php
if (isset($_GET['ID']) and (int)$_GET['ID']>0) {
    try {
        $data = $database->query('SELECT * FROM commentaries WHERE ID=' . $_GET['ID'] . ' ORDER BY Date_commented');
    } catch (Exception $e) {
        die('Error while loading articles : ' . $e->getMessage());
    }
    if (isset($data)){
        while ($record = $data->fetch()) {?>
    <h2>Commentaire de <?php echo $record['Author'] ?></h2>
    <p>Publié le <time datetime="<?php echo $record['Date_commented'] ?>"><?php echo $record['Date_commented'] ?></time></p>
    <p><?php echo $record['Content']; ?></p>
<?php   }
    }

} else {
    echo 'L\'article demandé est introuvable.';

}
?>

</body>
</html>
