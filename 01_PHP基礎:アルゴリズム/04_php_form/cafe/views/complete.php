<?php
session_start();

// 不正アクセス対策
if(!isset($_SESSION['access_flg']) && $_SESSION['access_flg'] !== 2387 || !isset($_SESSION['name']) || !isset($_SESSION['kana']) || !isset($_SESSION['email']) || !isset($_SESSION['inquiry']) ){
  header("Location:./contact.php");
}

// DB接続 保存
require '../db/insert.php';

insertContact($_SESSION);

$_SESSION = array();
session_destroy();
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
      <h2>お問い合わせ</h2>
      <div class="complete">
        <p>お問い合わせ頂きありがとうございます。<br>
          送信頂いた件につきましては、当社より折り返しご連絡を差し上げます。<br>
          なお、ご連絡までに、お時間を頂く場合もございますので予めご了承ください。</p>
        <a href="index.php">トップへ戻る</a>
      </div>
    </div>
  </section>

  <?php include 'shared/footer.html' ?>

  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>
  <script type="text/javascript" src="../js/script.js"></script>

</body>