<p>Par <em><?= $news['author'] ?></em>, le <?= $news['dateAdded']->format('d/m/Y à H\hi') ?></p>
<h2><?= $news['title'] ?></h2>
<p><?= nl2br($news['content']) ?></p>

<?php if (isset($news['dateEdited'])) { ?>
  <p style="text-align: right;"><small><em>Modifiée le <?= $news['dateEdited']->format('d/m/Y à H\hi') ?></em></small></p>
<?php } ?>

<p><a href="insert-comment-<?= $news['id'] ?>.html">Ajouter un commentaire</a></p>

<?php
if (empty($comments))
{
?>
<p>Aucun commentaire n'a encore été posté. Soyez le premier à en laisser un !</p>
<?php
}

foreach ($comments as $comment)
{
?>
  <fieldset>
    <legend>
      Posté par <strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['date']->format('d/m/Y à H\hi') ?>
    </legend>
    <p><?= nl2br(htmlspecialchars($comment['content'])) ?></p>
  </fieldset>
<?php
}
?>

<p><a href="insert-comment-<?= $news['id'] ?>.html">Ajouter un commentaire</a></p>
