<?php
session_start();

// 不正アクセス対策
if(!isset($_SESSION['access_flg']) && $_SESSION['access_flg'] !== 7485 || (!isset($_SESSION['form'])) ){
  header("Location:./contact.php");
}

$_POST = $_SESSION['form'];

$_SESSION['access_flg'] = 2387;

// サニタイズ
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
      <div class="confirm_box">
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
          <div class="conf_inq">
            <?php echo "<dd>". nl2br(h($_POST["inquiry"])). "</dd>" ?>
          </div>
          <dt class="confirm_btn">

            <div class="confirm_send">
              <form action="complete.php" method="post">
                <button type="submit" class="send">送　信</button>
              </form>
            </div>

            <div class="confirm_back">
              <form action=" contact.php" method="post">
                <input type="hidden" name="name" value="<?= h($_POST['name']) ?>">
                <input type="hidden" name="kana" value="<?= h($_POST['kana']) ?>">
                <input type="hidden" name="phone" value="<?= h($_POST['phone']) ?>">
                <input type="hidden" name="email" value="<?= h($_POST['email']) ?>">
                <input type="hidden" name="inquiry" value="<?=h($_POST['inquiry']) ?>">
                <input type="hidden" name="back" value=true>

                <!-- contact.phpに戻るを認識させる -->
                <input type="submit" class="back" value="戻　る">
              </form>
            </div>

          </dt>
        </dl>

      </div>
    </div>
  </section>


  <?php include 'shared/footer.html' ?>

  <script src=" https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>
  <script type="text/javascript" src="../js/script.js"></script>

</body>