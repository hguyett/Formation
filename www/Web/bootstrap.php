<?php
use OCFram\Application;
const DEFAULT_APP = 'Frontend';

if (!isset($_GET['app']) or !file_exists(__DIR__ . '/../App/' . $_GET['app'])) {
    $_GET['app'] = DEFAULT_APP;
}

$OCFramLoader = new SplClassLoader('OCFram', __DIR__ . '/../lib');
$OCFramLoader->register();

$appLoader = new SplClassLoader('App', __DIR__ . '/../');
$appLoader->register();

$modelLoader = new SplClassLoader('Model', __DIR__ . '/../lib/vendors');
$modelLoader->register();

$entityLoader = new SplClassLoader('Entity', __DIR__ . '/../lib/vendors');
$entityLoader->register();


$appClass = 'App\\'.$_GET['app'].'\\'.$_GET['app'].'Application';

/**
 * @var Application $app
 */

$app = new $appClass;
$app->run();
