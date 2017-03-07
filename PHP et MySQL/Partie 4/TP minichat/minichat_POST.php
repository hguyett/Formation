<?php
try {
    // Connecting to database
    $database = new PDO('mysql:host=localhost;dbname=minichat_hguyett;charset=utf8','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}

try {
    // Inserting message
    $query = $database->prepare('INSERT INTO messages(Pseudo, Message, Time_posted) VALUES (?, ?, NOW())');
    $query->execute(array($_POST['Pseudo'], $_POST['Message']));
    setcookie('Pseudo', $_POST['Pseudo'], time() + 3600*24*30, NULL, NULL, FALSE, TRUE);
} catch (Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
header('Location: index.php');
