<?php
require_once(ROOT_PATH .'/Models/Db.php');

class Player extends Db {
  private $table = 'players p, countries c';
  
  public function __construct($dbh = null) {
    parent::__construct($dbh);
  }

/**
 * playersテーブルからすべてデータを取得
 * 
 * @param integer $page ページ番号
 * @return Array $result 全選手データ
 */

  public function findAll($page = 0):Array {
    
    $sql = 'SELECT p.*, c.name country FROM players p LEFT JOIN countries c ON p.country_id = c.id WHERE del_flg != 1';
    $sql .= ' LIMIT 20 OFFSET '. (20 * $page);
    $sth = $this->dbh->prepare($sql);
    $sth->execute();
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }

  public function findPosition():Array {
    $sql = 'SELECT position FROM players GROUP BY position';
    $sth = $this->dbh->prepare($sql);
    $sth->execute();
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }

  public function findById($id = 0):Array {
    $sql = 'SELECT p.*, c.name country FROM ' .$this->table;
    $sql .= ' WHERE p.id = :id AND p.country_id= c.id';
    $sth = $this->dbh->prepare($sql);
    $sth->bindParam(':id', $id, PDO::PARAM_INT);
    $sth->execute();
    $result = $sth->fetch(PDO::FETCH_ASSOC);
    return $result;
  }

  /**
   * playersテーブルから全データを取得
   * 
   * @return Int $count 全選手件数
   */
  
  public function countAll():Int {
    $sql = 'SELECT count(*) as count FROM players';
    $sth = $this->dbh->prepare($sql);
    $sth->execute();
    $count = $sth->fetchColumn();
    return $count;
  }
  
  // 論理削除
  public function delete($id = 0):void {
    $sql = 'UPDATE players SET del_flg = 1 WHERE id = :id';
    $sth = $this->dbh->prepare($sql);
    $sth->bindParam(':id', $id, PDO::PARAM_INT);
    $sth->execute();
  }
  
  // 編集
  public function update($id = 0):void { 
    $sql = 'UPDATE players SET uniform_num = :uniform_num, position = :position, name = :name, club = :club, country_id = :country_id,  birth = :birth , height = :height , weight = :weight WHERE id = :id';
    $sth = $this->dbh->prepare($sql);
    $sth->bindParam(':id', $id, PDO::PARAM_INT);
    $sth->bindParam(':uniform_num', $_POST['uniform_num'],PDO::PARAM_INT);
    $sth->bindParam(':position', $_POST['position'],PDO::PARAM_STR);
    $sth->bindParam(':name', $_POST['name'],PDO::PARAM_STR);
    $sth->bindParam(':club', $_POST['club'],PDO::PARAM_STR);
    $sth->bindParam(':country_id', $_POST['country_id'],PDO::PARAM_INT);
    $sth->bindParam(':birth', $_POST['birth'],PDO::PARAM_STR);
    $sth->bindParam(':height', $_POST['height'],PDO::PARAM_INT);
    $sth->bindParam(':weight', $_POST['weight'],PDO::PARAM_INT);
    $sth->execute();
  }

  // players_tmpテーブル更新
  public function playersTmp():void {
    try {
    // SQLトランザクション開始
    $this->dbh->beginTransaction();

    // players_tmpテーブルデータ全削除
    $sql = 'DELETE FROM players_tmp';
    $sth = $this->dbh->prepare($sql);
    $sth->execute();

    // players_tmpテーブルデータ挿入(del_flg:1を除く)
    $sql = 'INSERT INTO players_tmp (country, uniform_num, position, name, club, birth, height, weight) SELECT c.name country, p.uniform_num, p.position, p.name, p.club, p.birth, p.height, p.weight FROM players p LEFT JOIN countries c ON c.id = p.country_id WHERE p.del_flg != 1';
  
    $sth = $this->dbh->prepare($sql);
    $sth->execute();

    // SQLトランザクションコミット
    $this->dbh->commit();
    
    } catch (PDOException $e){
      // SQLトランザクションロールバック
      $this->dbh->rollback();
      echo "エラーが発生しました。". $e -> getMessage();
      exit();
    }
  }
}