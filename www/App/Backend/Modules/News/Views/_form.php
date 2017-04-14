<form action="" method="post">
  <p>
    <label>Auteur</label>
    <input type="text" name="author" value="<?= isset($news) ? $news['author'] : '' ?>" /><br />

    <label>Titre</label><input type="text" name="title" value="<?= isset($news) ? $news['title'] : '' ?>" /><br />

    <label>Contenu</label><textarea rows="8" cols="60" name="content"><?= isset($news) ? $news['content'] : '' ?></textarea><br />
<?php
if(isset($news) && !$news->isNew())
{
?>
    <input type="hidden" name="id" value="<?= $news['id'] ?>" />
    <input type="submit" value="Modifier" name="modifier" />
<?php
}
else
{
?>
    <input type="submit" value="Ajouter" />
<?php
}
?>
  </p>
</form>
