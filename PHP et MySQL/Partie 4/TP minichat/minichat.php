<?php
try {
    $database = new PDO('mysql:host=localhost;dbname=minichat;charset=utf8','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
?>

        <form action="minichat_POST.php" method="post">
            <p><label for="Pseudo">Pseudo : </label><input type="text" name="Pseudo" maxlength="30" size="30"></p>
            <p><label for="Message">Message : <br><textarea name="Message" rows="2" cols="80"></textarea></label></p>
            <p><input type="submit" value="Envoyer"></p>
        </form>

<div class="messages">
<?php
    $data = $database->query('select * from Messages ORDER BY ID LIMIT 20');
    while ($record = $data->fetch()) {
        echo '<p>' . $record['Pseudo'] . ' : ' . $record['Message'] . '</p>';
    }
$data->closeCusor();
 ?>
</div>
