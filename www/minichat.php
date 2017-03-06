<?php
// Connecting to database
try {
    $database = new PDO('mysql:host=localhost;dbname=minichat;charset=utf8','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
?>
<!--  Formulaire d'envoi de message -->
        <form action="minichat_POST.php" method="post">
            <p><label for="Pseudo">Pseudo : </label><input type="text" name="Pseudo" value=<?php

// Set last psuedo as default pseudo value
if (isset($_COOKIE['Pseudo'])) {
    echo $_COOKIE['Pseudo'];
} else {
    echo '""';
} ?>></p>
            <p><label for="Message">Message : </label><textarea name="Message" rows="3"></textarea></p>
            <p><input type="submit" value="Envoyer"></p>
        </form>

<?php
// Loading data
    $data = $database->query('select *, TIME(Time_posted) AS Hour_posted, DATE_FORMAT(Time_posted, \'%e/%c/%Y\') AS Date_posted from messages ORDER BY Time_posted LIMIT 30');
    $datePosted = NULL;
    while ($record = $data->fetch()) {
        // Delimiting days
        if (!(isset($datePosted))) {
            $datePosted = $record['Date_posted'];
            ?>            <?php
            echo '<div class="day-wrapper">' . PHP_EOL;
            ?>                <?php
            echo '<h1>' . htmlspecialchars($record['Date_posted']) . '</h1>' . PHP_EOL;
        }
        elseif ($record['Date_posted'] != $datePosted) {
            $datePosted = $record['Date_posted'];
            ?>            <?php
            echo '</div>' . PHP_EOL;
            ?>            <?php
            echo '<div class="day-wrapper">' . PHP_EOL;
            ?>                <?php
            echo '<h1>' . htmlspecialchars($record['Date_posted']) . '</h1>' . PHP_EOL;
        }

        // Displaying messages
        ?>                <?php
        echo '<p>[' . $record['Hour_posted'] . '] ' . htmlspecialchars($record['Pseudo']) . ' : ' . htmlspecialchars($record['Message']) . '</p>' . PHP_EOL;
    }
$data->closeCursor();
 ?>
            </div>
