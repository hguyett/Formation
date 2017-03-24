<nav>
    <a href="../index.php">Retour à l'accueil</a>
</nav>
<h1>Espace d'administration</h1>
<?php

// Manage modify requests
//
$news = false;
if (isset($_GET['modify'])) {
    if (!$news = getNews($_GET['modify'])) {
        global $warnings;
        $warnings[]= 'L\'article spécifié n\'existe pas.';
    }
}

// Printing form
?>

<form action="index.php?page=admin" method="post">
    <fieldset>
        <legend>Ajouter ou modifier une News</legend>
        <p><label for="author">Auteur : </label><br><input type="text" name="author" value="<?php if ($news) echo htmlspecialchars($news->getAuthor(), ENT_QUOTES, 'utf-8')?>"></p>
        <p><label for="title">Titre : <br><input type="text" name="title" value="<?php if ($news) echo htmlspecialchars($news->getTitle(), ENT_QUOTES, 'utf-8')?>"></label></p>
        <p><label for="content">Contenu : <br><textarea name="content" rows="8" cols="80"><?php if ($news) echo htmlspecialchars($news->getContent(), ENT_QUOTES, 'utf-8')?></textarea></label></p>
        <input type="hidden" name="id" value="<?php if ($news) echo htmlspecialchars($news->getId(), ENT_QUOTES, 'utf-8') ?>">
        <p><input type="submit" name="save_news" value="<?php if (isset($_GET['modify'])) echo 'Modifier'; else echo 'Ajouter'; ?>"></p>
    </fieldset>
</form>
<p>Liste des news existantes :</p>
<table>
    <tr>
        <thead>
            <th>Auteur</th>
            <th>Titre</th>
            <th>Date d'ajout</th>
            <th>Date d'édition</th>
            <th>Actions</th>
        </thead>
    </tr>
<?php
$newsManager = DBFactory::getMysqlConnectionWithPDO();
$newsArray = $newsManager->getList();
foreach ($newsArray as $news) {
    /**
     * @var News $news
     */
?>
    <tr>
    <td><?php echo htmlspecialchars($news->getAuthor(), ENT_QUOTES, 'utf-8'); ?></td>
        <td><?php echo htmlspecialchars($news->getTitle(), ENT_QUOTES, 'utf-8'); ?></td>
        <td><?php echo htmlentities($news->getDateAdded()->format('d/m/Y - H:i:s T'), ENT_QUOTES, 'utf-8'); ?></td>
        <td><?php if ($news->getDateEdited() !== null) echo htmlentities($news->getDateEdited()->format('d/m/Y - H:i:s T'), ENT_QUOTES, 'utf-8'); else echo "N/a";?></td>
        <td><a href="index.php?page=admin&amp;modify=<?php echo htmlentities($news->getId(), ENT_QUOTES, 'utf-8'); ?>">Modifier</a> | <a href="index.php?page=admin&amp;delete=<?php echo htmlentities($news->getId(), ENT_QUOTES, 'utf-8'); ?>">Supprimer</a></td>
    </tr>
<?php
}
?>
</table>
