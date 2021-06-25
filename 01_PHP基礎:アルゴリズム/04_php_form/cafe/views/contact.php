<?php
function h($str) {
  return htmlspecialchars($str, ENT_QUOTES, "UTF-8");
}

session_start();

// 不正アクセス対策
$_SESSION['access_flg'] = 7485;

$name    = null;
$kana    = null;
$phone   = null;
$email   = null;
$inquiry = null;
  
$name_alert = null;
$kana_alert = null;
$phone_alert = null;
$email_alert = null;
$inquiry_alert = null;


// 送信データをチェック
if ($_POST) {
  
  // 氏名
  $name = h($_POST['name']);
  if (empty($_POST['name'])) {
    $name_alert = '氏名は必須項目です。';
  } else if (!(mb_strlen($_POST['name']) <= 10)) {
    $name_alert = '氏名は10字以内でご入力ください。';
  }
  
  // カナ
  $kana = h($_POST['kana']);
  if (empty($_POST['kana'])) {
    $kana_alert = 'フリガナは必須項目です。';
  } else if (!(mb_strlen($_POST['kana']) <= 10)) {
    $kana_alert = 'フリガナは10字以内でご入力ください。';
  }

  // 電話番号
  $phone = h($_POST['phone']);
  if (!preg_match('/^[0-9]{2,4}[0-9]{2,4}[0-9]{3,4}$/',$_POST['phone'])) {
    $phone_alert = "電話番号は0-9の数字のみでご入力ください。";
  }

  // メール
  $email = h($_POST['email']);
  if (empty($_POST['email'])) {
    $email_alert = 'Eメールは必須項目です。';
  } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $email_alert= '正しいEメールアドレスを指定してください。';
  }
  
  // お問い合わせ内容
  $inquiry = h($_POST['inquiry']);
  if (empty($_POST['inquiry'])) {
    $inquiry_alert = 'お問い合わせ内容は必須項目です。';
  }

  if(!($name_alert || $kana_alert || $phone_alert || $email_alert ||  $inquiry_alert)) {
    header("Location:./confirm.php", true, 307);
  }
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
      <h2>お問い合わせ</h2>
      <form action="contact.php" method="post" id="formVal">
        <h3>下記の項目をご記入の上送信ボタンを押してください</h3>
        <p>送信頂いた件につきましては、当社より折り返しご連絡を差し上げます。<br>
          なお、ご連絡までに、お時間を頂く場合もございますので予めご了承ください。<br>
          <span class="required">*</span>は必須項目となります。
        </p>
        <dl>
          <dt><label for="name">氏名</label><span class="required">*</span></dt>
          <div class="error">
            <?php 
              if($name_alert) {
                echo $name_alert;
              }  
            ?>
          </div>
          <dd><input type="text" name="name" id="name" placeholder="山田太郎" value="<?= $name ?>"></dd>

          <dt><label for="kana">フリガナ</label><span class="required">*</span></dt>
          <div class="error">
            <?php 
            if($kana_alert) {
              echo $kana_alert;
            }  
          ?>
          </div>
          <dd><input type=" text" name="kana" id="kana" placeholder="ヤマダタロウ" value="<?= $kana ?>"></dd>

          <dt><label for="phone">電話番号</label></dt>
          <div class="error">
            <?php 
            if($phone_alert) {
              echo $phone_alert;
            }  
          ?>
          </div>
          <dd><input type="text" name="phone" id="phone" placeholder="09012345678" value="<?= $phone ?>"></dd>

          <dt><label for="email">メールアドレス</label><span class="required">*</span></dt>
          <div class="error">
            <?php 
            if($email_alert) {
              echo $email_alert;
            }  
          ?>
          </div>
          <dd><input type="text" name="email" id="email" placeholder="test@test.co.jp" value="<?= $email ?>"></dd>
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
          <dd><textarea name="inquiry" id="inquiry" maxlength"1000 cols="100" rows="5"=><?= $inquiry ?></textarea>
          </dd>
          <dd><button class="send" type="submit">送　信</button></dd>
        </dl>

      </form>
    </div>
  </section>

  <?php include 'shared/footer.html' ?>

  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>
  <script type="text/javascript" src="../js/script.js"></script>
  <script type="text/javascript" src="../js/validation.js"></script>

</body>