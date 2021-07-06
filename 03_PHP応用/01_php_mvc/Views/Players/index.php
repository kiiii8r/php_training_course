<?php
require_once(ROOT_PATH .'Controllers/PlayerController.php');
$player = new PlayerController();
$params = $player->index(); 
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>オブジェクト指向 - 選手一覧</title>
  <link rel="stylesheet" type="text/css" href="/css/base.css">
  <link rel="stylesheet" type="text/css" href="/css/style.css">
</head>

<body>

  <h2>選手一覧</h2>
  <table>
    <tr>
      <th>No</th>
      <th>背番号</th>
      <th>ポジション</th>
      <th>名前</th>
      <th>所属</th>
      <th>国</th>
      <th>誕生日</th>
      <th>身長</th>
      <th>体重</th>
    </tr>
    <?php foreach($params['players'] as $player): ?>
    <tr>
      <td><?=$player['id'] ?></td>
      <td><?=$player['uniform_num'] ?></td>
      <td><?=$player['position'] ?></td>
      <td><?=$player['name'] ?></td>
      <td><?=$player['club'] ?></td>
      <td><?=$player['country'] ?></td>
      <td><?=$player['birth'] ?></td>
      <td><?=$player['height'] ?></td>
      <td><?=$player['weight'] ?></td>
      <td><a href="view.php?id=<?= $player['id']?>">詳細</a></td>
      <td><a id='click' href=?del=<?= $player['id']; ?> onclick="return confirm(' 本当に削除しますか？')">削除</a></td>
    </tr>
    <?php endforeach; ?>
  </table>


  <div class='paging_box'>
    <div class=' paging'>
      <?php
    for($i=0; $i<=$params['pages']; $i++) {
      if(isset($_GET['page']) && $_GET['page'] == $i) {
        echo $i+1;
      } else {
        echo "<a href='?page=". $i. "'>". ($i+1). "</a>";
      }
    }
    ?>
    </div>
  </div>
</body>

</html>