<?php
require_once(ROOT_PATH .'Controllers/PlayerController.php');
$player = new PlayerController();
$params = $player->view(); 
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>オブジェクト指向 - 選手詳細</title>
  <link rel="stylesheet" type="text/css" href="/css/base.css">
  <link rel="stylesheet" type="text/css" href="/css/style.css">
</head>

<body>

  <h2>選手詳細</h2>
  <table>
    <tr>
      <th>No</th>
      <td><?=$params['player']['id'] ?></td>
    </tr>
    <tr>
      <th>背番号</th>
      <td><?=$params['player']['uniform_num'] ?></td>
    </tr>
    <tr>
      <th>ポジション</th>
      <td><?=$params['player']['position'] ?></td>
    </tr>
    <tr>
      <th>名前</th>
      <td><?=$params['player']['name'] ?></td>
    </tr>
    <tr>
      <th>所属</th>
      <td><?=$params['player']['club'] ?></td>
    </tr>
    <tr>
      <th>国</th>
      <td><?=$params['player']['country'] ?></td>
    </tr>
    <tr>
      <th>誕生日</th>
      <td><?=$params['player']['birth'] ?></td>
    </tr>
    <tr>
      <th>身長</th>
      <td><?=$params['player']['height'] ?>cm</td>
    </tr>
    <tr>
      <th>体重</th>
      <td><?=$params['player']['weight'] ?>kg</td>
    </tr>

    <tr>
      <th>
        <a href="edit.php?id=<?= $params['player']['id'] ?>">編集</a>
        <a id='click' href=index.php?del=<?= $params['player']['id'] ?> onclick="return confirm(' 本当に削除しますか？')">削除</a>
      </th>
    </tr>
  </table>

  <!-- 得点履歴 -->
  <div class="points">
    <table>
      <tr>
        <th>得点履歴</th>
        <th>試合日時</th>
        <th>対戦相手</th>
        <th>ゴールタイム</th>
      </tr>

      <?php $point = 0; ?>
      <?php foreach($params['goals'] as $goal): ?>
      <?php $point++ ?>
      <tr>
        <td><?= $point . '点目' ?></td>
        <td><?= $goal['kickoff'] ?></td>
        <td><?= $goal['enemy_country'] ?></td>
        <td><?= $goal['goal_time'] ?></td>
      </tr>
      <?php endforeach; ?>
    </table>
  </div>
  <div class="top">
    <a href="index.php">トップへ戻る</a>
  </div>
</body>

</html>