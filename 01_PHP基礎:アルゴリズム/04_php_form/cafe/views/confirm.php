<?php
session_start();

// 不正アクセス対策
if(!isset($_SESSION['access_flg']) && $_SESSION['access_flg'] !== 7485 || !isset($_POST['name']) || !isset($_POST['kana']) || !isset($_POST['email']) || !isset($_POST['inquiry']) ){
  header("Location:./contact.php");
}

$_SESSION['access_flg'] = 2387;

function h($str) {
  return htmlspecialchars($str, ENT_QUOTES, "UTF-8");
}

$_SESSION['name']    = h($_POST["name"]);
$_SESSION['kana']    = h($_POST["kana"]);
$_SESSION['phone']   = h($_POST["phone"]);
$_SESSION['email']   = h($_POST["email"]);
$_SESSION['inquiry'] = h($_POST["inquiry"]);

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
      <form action="complete.php" method="post">
        <p>下記の内容をご確認の上送信ボタンを押してください</p>
        <p>内容を訂正する場合は戻るを押してください。</p>
        <dl class="confirm">
          <dt>氏名</dt>
          <?php echo "<dd>". h($_POST["name"]). "</dd>" ?>
          <dt>フリガナ</dt>
          <?php echo "<dd>". h($_POST["kana"]). "</dd>" ?>
          <dt>電話番号</dt>
          <?php echo "<dd>". h($_POST["phone"]). "</dd>" ?>
          <dt>メールアドレス</dt>
          <?php echo "<dd>". h($_POST["email"]). "</dd>" ?>
          <dt>お問い合わせ内容</dt>
          <?php echo "<dd>". nl2br(h($_POST["inquiry"])). "</dd>" ?>

          <dt class="confirm_btn">
            <button class="send" type="submit">送　信</button>
            <a class="back" href=" javascript:void(0)" onclick="javascript:history.back()">戻る</a>
          </dt>
        </dl>
      </form>
    </div>
  </section>

  <?php include 'shared/footer.html' ?>

  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>
  <script type="text/javascript" src="../js/script.js"></script>

</body>