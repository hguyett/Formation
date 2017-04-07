<p>Par <em><?= $news['author'] ?></em>, le <?= $news['dateAdded']->format('d/m/Y à H\hi') ?></p>
<h2><?= $news['title'] ?></h2>
<p><?= nl2br($news['content']) ?></p>

<?php if (isset($news['dateEdited'])) { ?>
  <p style="text-align: right;"><small><em>Modifiée le <?= $news['dateEdited']->format('d/m/Y à H\hi') ?></em></small></p>
<?php } ?>
