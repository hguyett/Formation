<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Search a city in France</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form class="" action="#" method="post">
        <div class="line">
            <label for="city">Ville : </label>
            <div class="col">
                <input type="text" name="city" id="city" value="" autocomplete="off">
                <div id="autocomplete"></div>
            </div>
            <input type="submit" name="submit" id="submit" value="Rechercher">
        </div>
    </form>
    <script src="citiesAutoCompleter.js" charset="utf-8"></script>
</body>
</html>
