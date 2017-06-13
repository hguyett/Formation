<?php
header('Content-Type: text/javascript');
header('Access-Control-Allow-Origin: *');

$file = realpath('../data/towns.txt');
if (file_exists($file)) {
    $data = unserialize(file_get_contents($file));
} else {
    exit('Data file is missing.');
}

if (isset($_GET['city-autocomplete'])) {
    $search = '#^' . $_GET['city-autocomplete'] . '#i';
    $matches = preg_grep($search, $data);
} else {
    exit('Search term is not set.');
}

$matches = implode('|', $matches);
echo $matches;
?>
