<?php
session_start();

// 不正アクセス対策
$_SESSION['access_flg'] = 7485;

// サニタイズ
function h($str) {
  return htmlspecialchars($str, ENT_QUOTES, "UTF-8");
}

$validation = false;
$back = false;

require 'validation.php';

if(!($name_alert || $kana_alert || $phone_alert || $email_alert ||  $inquiry_alert)) {
  if ($_POST) {
    if($_POST['back']){
    $back = $_POST['back'];
    }
  }

  if( $validation === true && $back === false){
    $_SESSION['form'] = $_POST;
    header('Location: confirm.php');
    exit();
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
          <dd><input type="text" name="name" id="name" placeholder="山田太郎"
              value="<?php if($_POST){echo $_POST['name'];} ?>"></dd>

          <dt><label for="kana">フリガナ</label><span class="required">*</span></dt>
          <div class="error">
            <?php 
            if($kana_alert) {
              echo $kana_alert;
            }  
          ?>
          </div>
          <dd><input type=" text" name="kana" id="kana" placeholder="ヤマダタロウ"
              value="<?php if($_POST){echo $_POST['kana'];} ?>"></dd>

          <dt><label for="phone">電話番号</label></dt>
          <div class="error">
            <?php 
            if($phone_alert) {
              echo $phone_alert;
            }  
          ?>
          </div>
          <dd><input type="text" name="phone" id="phone" placeholder="09012345678"
              value="<?php if($_POST){echo $_POST['phone'];} ?>"></dd>

          <dt><label for="email">メールアドレス</label><span class="required">*</span></dt>
          <div class="error">
            <?php 
            if($email_alert) {
              echo $email_alert;
            }  
          ?>
          </div>
          <dd><input type="text" name="email" id="email" placeholder="test@test.co.jp"
              value="<?php if($_POST){echo $_POST['email'];} ?>"></dd>
        </dl>

        <h3><label for=" body">お問い合わせ内容をご記入ください<span class="required">*</span></label></h3>
        <div class="error">
          <?php 
          if($inquiry_alert) {
            echo $inquiry_alert;
          }  
        ?>
        </div>
        <dl class="inquiry">
          <dd>
            <textarea name="inquiry" id="inquiry" maxlength"1000 cols="100"
              rows="5"><?php if($_POST){echo $_POST['inquiry'];} ?></textarea>
          </dd>
          <dd><button class="send" type="submit">送　信</button></dd>
        </dl>

      </form>
    </div>
    <?php require '../db/db_connection.php';

    // SELECT文を変数に格納
    $sql = "SELECT * FROM contacts";
    
    // SQLステートメントを実行し、結果を変数に格納
    $stmt = $pdo->query($sql);
    
    // foreach文で配列の中身を一行ずつ出力
    $contacts = $stmt->fetchALL();
    
    ?>

    <div class="cafe_data">
      <table>
        <tr>
          <th>システムID</th>
          <th>氏名</th>
          <th>フリガナ</th>
          <th>電話番号</th>
          <th>メールアドレス</th>
          <th>お問い合わせ内容</th>
          <th>送信日時</th>
          <th></th>
          <th></th>
        </tr>

        <?php foreach($contacts as $contact): ?>
        <tr>
          <td><?= $contact['id'] ?></td>
          <td><?= h($contact['name']) ?></td>
          <td><?= h($contact['kana']) ?></td>
          <td><?= h($contact['phone']) ?></td>
          <td><?= h($contact['email']) ?></td>
          <td><?= h($contact['inquiry']) ?></td>
          <td><?= $contact['created_at'] ?></td>
          <td><a href=edit.php?id=<?= $contact['id']; ?>>編集</a></td>
          <td><a href=delete.php?id=<?= $contact['id']; ?> onclick="return confirm('本当に削除しますか？')">削除</a></td>
        </tr>
        <?php endforeach; ?>
      </table>
    </div>
  </section>

  <?php include 'shared/footer.html' ?>

  <script src=" https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>
  <script type="text/javascript" src="../js/script.js"></script>
  <script type="text/javascript" src="../js/validation.js"></script>

</body>