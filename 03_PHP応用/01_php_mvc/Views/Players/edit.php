<?php
require_once(ROOT_PATH .'Controllers/PlayerController.php');
$player = new PlayerController();
$params = $player->edit(); 
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
  <form action="edit.php?id=<?= $params['player']['id'] ?>" method="post">
    <table>
      <tr>
        <th>No</th>
        <td><?=$params['player']['id'] ?></td>
      </tr>
      <tr>
        <th>背番号</th>
        <td><input type="text" name="uniform_num" value="<?=$params['player']['uniform_num'] ?>">
          <div class="error">
            <?php 
              if($params['alert']) {
                echo $params['alert']['uniform_num_alert'];
              }  
            ?>
          </div>
        </td>
      </tr>
      <tr>
        <th>ポジション</th>
        <td>
          <select name="position" value="<?=$params['player']['position'] ?>">
            <?php foreach($params['position'] as $player):?>
            <option value="<?= $player['position'] ?>"
              <?= $params['player']['position'] === $player['position'] ? 'selected' : '' ?>>
              <?= $player['position'] ?></option>
            <?php endforeach;?>
          </select>
        </td>
      </tr>
      <tr>
        <th>名前</th>
        <td><input type="text" name="name" value="<?=$params['player']['name'] ?>">
          <div class="error">
            <?php 
              if($params['alert']) {
                echo $params['alert']['name_alert'];
              }  
            ?>
          </div>
        </td>
      </tr>
      <tr>
        <th>所属</th>
        <td><input type="text" name="club" value="<?=$params['player']['club'] ?>">
          <div class="error">
            <?php 
              if($params['alert']) {
                echo $params['alert']['club_alert'];
              }  
            ?>
          </div>
        </td>
      </tr>
      <tr>
        <th>国</th>
        <td>
          <select name="country_id">
            <?php foreach($params['countries'] as $country):?>
            <option value="<?= $country['id'] ?>"
              <?= $params['player']['country_id'] === $country['id'] ? 'selected': '' ;?>>
              <?= $country['name'] ?></option>
            <?php endforeach;?>
          </select>
        </td>
      </tr>
      <tr>
        <th>誕生日</th>
        <td><input type=" text" name="birth" value="<?=$params['player']['birth'] ?>">
          <div class="error">
            <?php 
              if($params['alert']) {
                echo $params['alert']['birth_alert'];
              }  
            ?>
          </div>
        </td>
      </tr>
      <tr>
        <th>身長</th>
        <td><input type="text" name="height" value="<?=$params['player']['height'] ?>">cm
          <div class="error">
            <?php 
              if($params['alert']) {
                echo $params['alert']['height_alert'];
              }  
            ?>
          </div>
        </td>
      </tr>
      <tr>
        <th>体重</th>
        <td><input type="text" name="weight" value="<?=$params['player']['weight'] ?>">kg
          <div class="error">
            <?php 
              if($params['alert']) {
                echo $params['alert']['weight_alert'];
              }  
            ?>
          </div>
        </td>
      </tr>

      <tr>
        <th></th>
        <td>
          <button type="submit" class="edit" id="confirm">編　集</button>
        </td>
      </tr>
    </table>
  </form>

  <div class="top">
    <a href="index.php">トップへ戻る</a>
  </div>
  <script src=" https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>
  <script>
  $("#confirm").click(function() {
    if (!confirm('本当に編集よろしいですか？')) {
      return false;
    }
  });
  </script>
</body>

</html>