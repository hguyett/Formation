<?php
class MaClasse
{
  private $position = 0;
  private $tableau = ['Premier élément', 'Deuxième élément', 'Troisième élément', 'Quatrième élément', 'Cinquième élément'];
}

$objet = new MaClasse;

foreach ($objet as $key => $value)
{
  echo $key, ' => ', $value, '<br />';
}
