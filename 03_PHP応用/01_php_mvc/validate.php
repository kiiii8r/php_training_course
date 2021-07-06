<?php

  
// ユニフォーム番号
$uniform_num = $_POST['uniform_num'];
if (empty($uniform_num)) {
  $alert['uniform_num_alert'] = 'ユニフォーム番号が空です。';
} else if (!(preg_match('/^[0-9]+$/', $uniform_num))) {
  $alert['uniform_num_alert'] = 'ユニフォーム番号は数字のみです。';
} else {
  $alert['uniform_num_alert'] = null;
}

// 名前
$name = $_POST['name'];
if (empty($name)) {
  $alert['name_alert'] = '名前が空です。';
} else {
  $alert['name_alert'] = null;
}

// 所属名
$club = $_POST['club'];
if (empty($club)) {
  $alert['club_alert'] = '所属名が空です。';
} else {
  $alert['club_alert'] = null;
}

// 誕生日
$birth = $_POST['birth'];
list($year, $month, $day) = explode('-', $birth);
if (empty($birth)) {
  $alert['birth_alert'] = '誕生日が空です。';
} else if (checkdate($month, $day, $year) == false) {
  $alert['birth_alert'] = '存在しない年月日です。';
} else {
  $alert['birth_alert'] = null;
}

// 身長
$height = $_POST['height'];
if (empty($height)) {
  $alert['height_alert'] = '身長が空です。';
} else if (!(preg_match('/^[0-9]+$/', $height))) {
  $alert['height_alert'] = '身長は数字のみです。';
}  else {
  $alert['height_alert'] = null;
}

// 体重
$weight = $_POST['weight'];
if (empty($weight)) {
  $alert['weight_alert'] = '体重が空です。';
} else if (!(preg_match('/^[0-9]+$/', $weight))) {
  $alert['weight_alert'] = '体重は数字のみです。';
}  else {
  $alert['weight_alert'] = null;
}

if(!($alert['uniform_num_alert'] || $alert['name_alert'] || $alert['club_alert'] || $alert['birth_alert'] || $alert['height_alert'] || $alert['weight_alert'])){
  $alert = array();
} 
?>