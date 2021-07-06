<?php
require_once(ROOT_PATH .'/Models/Player.php');
require_once(ROOT_PATH .'/Models/Goal.php');
require_once(ROOT_PATH .'/Models/Country.php');

class PlayerController {
  private $request; // リクエストパラメータ(GET,POST)
  private $Player; // Playerモデル
  private $Goal; // Goalモデル
  private $Country; // Countryモデル
  
  public function __construct() {
    // リクエストパラメータの取得
    $this->request['get'] = $_GET;
    $this->request['post'] = $_POST;
    
    // モデルオブジェクトの生成
    $this->Player = new Player();

    // 別モデルと連携
    $dbh= $this->Player->get_db_handler();
    $this->Goal = new Goal($dbh);
    $this->Country = new Country($dbh);
  }
  
  // 選手一覧
  public function index() {
    $page = 0;
    if(isset($this->request['get']['page'])) {
      $page = $this->request['get']['page'];
    }
    
    // 論理削除
    $url = htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES, 'UTF-8');
    if(strpos($url, 'del')){
      $id = filter_input(INPUT_GET,"del");
      $this->Player->delete($id);
      $this->Player->playersTmp();
    }
    
    $players = $this->Player->findAll($page); 
    $players_count = $this->Player->countAll();
    $params = [
      'players' => $players,
      'pages' => $players_count / 20
    ];
    
    return $params;
  }

  // 選手詳細
  public function view() {
    if(empty($this->request['get']['id'])) {
      echo '指定のパラメータが不正です。このページを表示できません。';
      exit;
    }

    // 論理削除
    $url = htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES, 'UTF-8');
    if(strpos($url, 'del')){
      $id = filter_input(INPUT_GET,"del");
      $this->Player->delete($id);
      $this->Player->playersTmp();
    }

    $player = $this->Player->findById($this->request['get']['id']);
    $goals = $this->Goal->findGoalById($this->request['get']['id']);
    $params = [
      'player' => $player,
      'goals' => $goals
     ];
    return $params;
  }

  public function edit() {
    if(empty($this->request['get']['id'])) {
      echo '指定のパラメータが不正です。このページを表示できません。';
      exit;
    }

    // バリデーション
 
    $alert = null;
    
    if($_POST){ 
   
    require '../validate.php';
      
      if(!($alert)) {
        $this->Player->update($this->request['get']['id']);
        $this->Player->playersTmp();
        header("Location:./view.php?id=". $this->request['get']['id']);
      }
    }
    
    $player = $this->Player->findById($this->request['get']['id']);
    $position = $this->Player->findPosition();
    $goals = $this->Goal->findGoalById($this->request['get']['id']);
    $countries = $this->Country->findCountry();
    $params = [
      'player' => $player,
      'position' => $position,
      'goals' => $goals,
      'countries' => $countries,
      'alert' => $alert
     ];
    return $params;
  }
} 
?>