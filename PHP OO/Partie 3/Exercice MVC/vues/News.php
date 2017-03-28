<h1>Les news du site</h1>

<?php
foreach($newsList as $news)
{
        echo '
        <div class="news">
                <h2>'.$news['titre'].'</h2>
                <p>News postée le '.str_replace(' ', ' à ', $news['date_formatee']).' par '.$news['auteur'].'</p>
                <p>'.$news['contenu'].'</p>
        </div>';
}
?>
