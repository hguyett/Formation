<?php
try {
    $database = new PDO('mysql:host=localhost;dbname=minichat;charset=utf8','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}

try {
    $query = $database->prepare('INSERT INTO messages(Pseudo, Message) VALUES (?, ?) ');
    $query->execute(array($_POST['Pseudo'], $_POST['Message']));
} catch (Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
header('Location: index.php');
