<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Search a city in France</title>
</head>
<body>
    <form class="" action="index.html" method="post">
        <label for="city">Ville : </label><input type="text" name="city" id="city" value="" autocomplete="off">
        <input type="submit" name="submit" value="Rechercher">
        <div id="autocomplete"></div>
    </form>
    <script src="citiesAutoCompleter.js" charset="utf-8"></script>
</body>
</html>
