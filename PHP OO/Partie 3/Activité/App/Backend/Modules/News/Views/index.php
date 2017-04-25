<p style="text-align: center">Liste des news :</p>

<table>
    <tr>
        <th>Auteur</th>
        <th>Titre</th>
        <th>Date d'ajout</th>
        <th>Dernière modification</th>
        <th>Action</th>
    </tr>
<?php
foreach ($newsList as $news)
{
    ?>
    <tr>
        <td><?php echo htmlspecialchars($news['author'], ENT_QUOTES, 'utf-8'); ?></td>
        <td><?php echo htmlspecialchars($news['title'], ENT_QUOTES, 'utf-8'); ?></td>
        <td><?php echo htmlspecialchars($news['dateAdded']->format('d/m/Y à H\hi'), ENT_QUOTES, 'utf-8'); ?></td>
        <td><?php echo isset($news['dateEdited']) ? htmlspecialchars($news['dateEdited']->format('d/m/Y à H\hi'), ENT_QUOTES, 'utf-8') : '-' ; ?></td>
        <td><a href="news-update-<?php echo htmlspecialchars($news['id']) ?>.html"><img src="/images/update.png" alt="Modifier" /></a> <a href="news-delete-<?php echo htmlspecialchars($news['id']) ?>.html"><img src="/images/delete.png" alt="Supprimer" /></a></td>
    </tr>
<?php
}
?>
</table>
