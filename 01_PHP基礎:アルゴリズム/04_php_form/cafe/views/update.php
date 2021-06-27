<?php

  // 不正アクセス対策
  session_start();
  if(!isset($_SESSION['access_flg']) && $_SESSION['access_flg'] !== 2387 || !isset($_POST['name']) || !isset($_POST['kana']) || !isset($_POST['email']) || !isset($_POST['inquiry']) ){
    header("Location:./contact.php");
  }

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
    $stmt = $pdo->prepare('UPDATE contacts SET name = :name, kana = :kana, phone = :phone, email = :email, inquiry = :inquiry WHERE id = :id');

    $stmt->bindValue(':name',$_POST['name'],PDO::PARAM_STR);
    $stmt->bindValue(':kana',$_POST['kana'],PDO::PARAM_STR);
    $stmt->bindValue(':phone',$_POST['phone'],PDO::PARAM_STR);
    $stmt->bindValue(':email',$_POST['email'],PDO::PARAM_STR);
    $stmt->bindValue(':inquiry',$_POST['inquiry'],PDO::PARAM_STR);
    $stmt->bindValue(':id',$_POST['id'],PDO::PARAM_INT);

    $stmt->execute(); 
    
    // SQLトランザクションコミット
    $pdo->commit();
    $message = "情報を更新しました。";
    
    $_SESSION = array();
    session_destroy();
    
  } catch(PDOException $e){
    
    // SQLトランザクションロールバック
    $pdo->rollback();
    $message = '情報を更新できませんでした。' . $e->getMessage() . "\n";
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

  <div class="message_box">
    <div class="message">
      <?= $message ?>
    </div>

    <div class="contact_link">
      <a href="contact.php">投稿一覧へ</a>
    </div>
  </div>

  <?php include 'shared/footer.html' ?>

  <script src=" https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>
  <script type="text/javascript" src="../js/script.js"></script>

</body>

</html>