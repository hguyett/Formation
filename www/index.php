<?php
class Nombre
{
  private $_nbr;

  public function __construct($nbr)
  {
    $this->_nbr = $nbr;
  }

  public function getNbr()
  {
    return $this->_nbr;
  }
}

$closure = function() {
  var_dump($this->_nbr + 5);
};

$two = new Nombre(2);
$three = new Nombre(3);

$test = $closure->call($two);
$test2 = $closure->call($three);
echo $test;
echo $two->getNbr();
