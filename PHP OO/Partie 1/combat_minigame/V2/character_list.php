<?php
$charactersList = $manager->getList();
echo '<table>';
echo '<tr><th>Nom</th><th>Classe</th><th>Dégats</th></tr>' . PHP_EOL;
foreach ($charactersList as $array => $charactersEntry) {
    echo '<tr>';
    foreach ($charactersEntry as $key => $value) {
        echo '<td>' . $value . '</td>';
    }
    echo '</tr>' . PHP_EOL;
}
echo '</table>';
