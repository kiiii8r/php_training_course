<?php
  session_start();

  // 不正アクセス対策
  if(!isset($_SESSION['access_flg']) && $_SESSION['access_flg'] !== 7485 || !isset($_GET["id"])){
    header("Location:./contact.php");
  }
  
  // DB接続
  require '../db/db_connection.php';

  // 削除処理
  try{
    // SQLトランザクション開始
    $pdo->beginTransaction();

    $stmt = $pdo->prepare('DELETE FROM contacts WHERE id = :id');
   
    $id = $_GET["id"];
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    
    // SQLトランザクションコミット
    $pdo->commit();
    $message = "削除しました。";
    
  } catch(PDOException $e){

    // SQLトランザクションロールバック
    $pdo->rollback();
    $message = '削除できませんでした。' . $e->getMessage() . "\n";
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
      <a href="contact.php">お問い合わせフォームへ</a>
    </div>
  </div>

  <?php include 'shared/footer.html' ?>

  <script src=" https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>
  <script type="text/javascript" src="../js/script.js"></script>

</body>

</html>