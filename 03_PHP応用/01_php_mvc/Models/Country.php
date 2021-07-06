<?php
require_once(ROOT_PATH .'/Models/Db.php');

class Country extends Db{
  
  public function findCountry():Array {
    $sql = 'SELECT * FROM countries';
    $sth = $this->dbh->prepare($sql);
    $sth->execute();
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }
}