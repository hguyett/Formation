<?php

///////////////
// Functions //
///////////////

function classAutoLoader(String $className)
{
    $classFileName = 'lib/' . $className . '.class.php';
    if (file_exists($classFileName)) include $classFileName;
}

/*******************************
 *                             *
 * ---------- Main ----------  *
 *                             *
 *******************************/

// Load class dynamicly

spl_autoload_register('classAutoLoader');

date_default_timezone_set('Europe/Brussels');
setlocale(LC_ALL, 'fr');

if (!isset($_GET['page'])) $_GET['page'] = 'home';

switch ($_GET['page']) {
    case 'admin':
        include 'src/admin.php';
        break;

    case 'home':
        //no break

    default:
        include 'src/header.php';
        include 'src/welcome.php';
        break;
}
