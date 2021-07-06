<?php
require_once(ROOT_PATH .'/Models/Db.php');

class Goal extends Db{
  private $table = 'goals g';

  public function findGoalById($id = 0):Array {
    $sql = 'SELECT (SELECT c.name FROM countries c WHERE c.id = p.enemy_country_id) enemy_country, p.kickoff, g.goal_time FROM ' .$this->table;
    $sql .= ' LEFT JOIN pairings p ON g.pairing_id = p.id WHERE g.player_id = :id';
    $sql .= ' ORDER BY p.kickoff ASC';
    $sth = $this->dbh->prepare($sql);
    $sth->bindParam(':id', $id, PDO::PARAM_INT);
    $sth->execute();
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }
}