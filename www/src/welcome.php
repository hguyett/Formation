<h1>News bulletin</h1>
<h2>Liste des 5 derniers articles</h2>
<?php
$database = DBFactory::getMysqlConnectionWithPDO();
$newsArray = $database->getList(5);
foreach ($newsArray as $News) {
    /**
     * @var News $News
     */
?>
<article>
    <h1><?php echo nl2br(htmlspecialchars($News->getTitle(), ENT_QUOTES, 'utf-8')); ?></h1>
    <p>Rédigé par <em><?php echo htmlspecialchars($News->getAuthor(), ENT_QUOTES, 'utf-8'); ?></em> le <time datetime="<?php echo htmlspecialchars($News->getDateAdded()->format(DateTime::COOKIE), ENT_QUOTES, 'utf-8'); ?>"><?php echo htmlspecialchars(strftime('%A %e %B %G à %H:%M', $News->getDateAdded()->getTimestamp()), ENT_QUOTES, 'utf-8'); ?></time></p>
    <p><?php echo nl2br(htmlspecialchars($News->getContent(), ENT_QUOTES, 'utf-8')); ?></p>
</article>
<?php
}
?>
