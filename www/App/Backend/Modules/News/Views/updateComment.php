<form action="" method="post">
  <p>
    <label>Auteur</label><input type="text" name="author" value="<?= htmlspecialchars($comment['author'], ENT_QUOTES, 'utf-8') ?>" /><br />

    <label>Contenu</label><textarea name="content" rows="7" cols="50"><?= htmlspecialchars($comment['content'], ENT_QUOTES, 'utf-8') ?></textarea><br />

    <input type="hidden" name="news" value="<?= htmlspecialchars($comment['news'], ENT_QUOTES, 'utf-8') ?>" />
    <input type="submit" value="Modifier" />
  </p>
</form>
