<?php
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
  if (!preg_match('/^[0-9]{2,4}[0-9]{2,4}[0-9]{3,4}$/',$_POST['phone']) && (!empty($_POST['phone']))) {
    $phone_alert = "正しい電話番号を入力してください。";
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

  $validation = true;
}
?>