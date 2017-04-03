<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php
function test(String $url, String $module, String $action, String $varsNames)
{
    print_r(func_get_args());
}

test('un', 'deux', 'trois', 'quatre');

 ?>
</body>
</html>
