<?php
try {
    $database = new PDO('mysql:host=localhost;dbname=blog;charset=utf8','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
    die('Error while connecting to database : ' . $e->getMessage());
}
?><!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <header>
        <h1>Mon blog</h1>
    </header>
<?php
    try {
        $data = $database->query('SELECT * FROM articles ORDER BY DATE_published LIMIT 5');
    } catch (Exception $e) {
        die('Error while loading articles : ' . $e->getMessage());
    }
    while ($record = $data->fetch()) {
/*Impression des articles du blog*/ ?>
    <article>
        <h1><?php echo $record['Title']; ?></h1>
        <p>Publié le <time datetime="<?php echo $record['Date_published'] ?>"><?php echo $record['Date_published'] ?></time></p>
        <p><?php echo $record['Content']; ?></p>
    </article>
    <p><a href="./commentaries.php?ID=<?php echo $record['ID']; ?>">Lire les commentaires</a></p>
<?php } ?>
</body>
</html>
