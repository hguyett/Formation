<?php
require __DIR__ . '/../lib/OCFram/SplClassLoader.php';

const DEFAULT_APP = 'Frontend';

if (!isset($_GET['app']) or !file_exists(__DIR__ . '/../App/' . $_GET['app'])) {
    $_GET['app'] = DEFAULT_APP;
}

$OCFramLoader = new SplClassLoader('OCFram', realpath(__DIR__ . '/../lib'));
$OCFramLoader->register();

$appLoader = new SplClassLoader('App', realpath(__DIR__ . '/../'));
$appLoader->register();

$modelLoader = new SplClassLoader('Model', realpath(__DIR__ . '/../lib/vendors'));
$modelLoader->register();

$entityLoader = new SplClassLoader('Entity', realpath(__DIR__ . '/../lib/vendors'));
$entityLoader->register();

$formBuilderLoader = new SplClassLoader('FormBuilder', realpath(__DIR__ . '/../lib/vendors'));
$formBuilderLoader->register();

$appClass = 'App\\' . $_GET['app'] . '\\' . $_GET['app'] . 'Application';

/**
 * @var Application $app
 */

$app = new $appClass;
$app->run();
