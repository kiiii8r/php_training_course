<?php

// 不正アクセス対策
session_start();
if(!isset($_SESSION['access_flg']) && $_SESSION['access_flg'] !== 7485 || !isset($_GET["id"])){
  header("Location:./contact.php");
}

$_SESSION['access_flg'] = 2387;

// サニタイズ
function h($str) {
  return htmlspecialchars($str, ENT_QUOTES, "UTF-8");
}

// DB接続
require '../db/db_connection.php';

try{

  // SQLトランザクション開始
  $pdo->beginTransaction();

  // DB情報取得 SQLインジェクション対策済み
  $stmt = $pdo->prepare('SELECT * FROM contacts WHERE id = :id');
  $id = $_GET["id"];
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);
  $stmt->execute();

  $resurt = $stmt->fetch(PDO::FETCH_ASSOC);

  // バリデーション
  $validation = false;

  require 'validation.php';

  if( $validation === true ){
    if(!($name_alert || $kana_alert || $phone_alert || $email_alert ||  $inquiry_alert)) {

      // SQLトランザクションコミット
      $pdo->commit();
      header("Location:./update.php", true, 307);
    }
  }

} catch (PDOException $e){

  // SQLトランザクションロールバック
  $pdo->rollback();
  echo "エラーが発生しました。". $e -> getMessage();
  exit();
}
?>


<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <title>Lesson Sample Site</title>
  <link rel="stylesheet" href="../css/style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

  <?php include 'shared/header.html' ?>

  <section>
    <div class="contact_box">
      <h2>編集画面</h2>
      <form action="edit.php?id=<?= $id ?> " method="post" id="formVal">
        <h3>下記の項目をご記入の上編集ボタンを押してください</h3>
        <p>送信頂いた件につきましては、当社より折り返しご連絡を差し上げます。<br>
          なお、ご連絡までに、お時間を頂く場合もございますので予めご了承ください。<br>
          <span class="required">*</span>は必須項目となります。
        </p>
        <input type="hidden" name="id" value="<?= $id ?>">
        <dl>
          <dt><label for="name">氏名</label><span class="required">*</span></dt>
          <div class="error">
            <?php 
              if($name_alert) {
                echo $name_alert;
              }  
            ?>
          </div>
          <dd><input type="text" name="name" id="name" placeholder="山田太郎" value="<?= h($resurt['name']) ?>"></dd>

          <dt><label for="kana">フリガナ</label><span class="required">*</span></dt>
          <div class="error">
            <?php 
            if($kana_alert) {
              echo $kana_alert;
            }  
          ?>
          </div>
          <dd><input type=" text" name="kana" id="kana" placeholder="ヤマダタロウ" value="<?= h($resurt['kana']) ?>"></dd>

          <dt><label for="phone">電話番号</label></dt>
          <div class="error">
            <?php 
            if($phone_alert) {
              echo $phone_alert;
            }  
          ?>
          </div>
          <dd><input type="text" name="phone" id="phone" placeholder="09012345678" value="<?= h($resurt['phone']) ?>">
          </dd>

          <dt><label for="email">メールアドレス</label><span class="required">*</span></dt>
          <div class="error">
            <?php 
            if($email_alert) {
              echo $email_alert;
            }  
          ?>
          </div>
          <dd><input type="text" name="email" id="email" placeholder="test@test.co.jp"
              value="<?= h($resurt['email']) ?>">
          </dd>
        </dl>

        <h3><label for="body">お問い合わせ内容をご記入ください<span class="required">*</span></label></h3>
        <div class="error">
          <?php 
          if($inquiry_alert) {
            echo $inquiry_alert;
          }  
        ?>
        </div>
        <dl class="inquiry">
          <dd><textarea name="inquiry" id="inquiry" maxlength"1000 cols="100"
              rows="5"><?= h($resurt['inquiry']); ?></textarea>
          </dd>
          <dd><button class="send" type="submit">編　集</button></dd>
        </dl>

      </form>
    </div>
  </section>
  <a href="contact.php">投稿一覧へ</a>

  <?php include 'shared/footer.html' ?>

  <script src=" https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>
  <script type="text/javascript" src="../js/script.js"></script>
  <script type="text/javascript" src="../js/validation.js"></script>

</body>

</html>