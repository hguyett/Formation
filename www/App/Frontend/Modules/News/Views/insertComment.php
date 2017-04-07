<h2>Ajouter un commentaire</h2>
<form action="" method="post">
  <p>
    <label>Pseudo</label>
    <input type="text" name="author" value="<?= isset($comment) ? htmlspecialchars($comment['author']) : '' ?>" /><br />
    <label>Contenu</label>
    <textarea name="content" rows="7" cols="50"><?= isset($comment) ? htmlspecialchars($comment['content']) : '' ?></textarea><br />

    <input type="submit" value="Commenter" />
  </p>
</form>
