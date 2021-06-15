<?php
// 以下は1980から2080までの数字を順番に表示するプログラムです。
// うるう年を判定するよう条件を追加し、例のように表示してください。
// 判定は関数に記述し、関数を呼び出して結果表示すること

// 表示例）
// 1900年
// 1901年
// 1903年
// 1904年はうるう年です。
// .
// .
// 1999年
// 2000年はうるう年です。
// .
// .
// 以下省略

// ＜うるう年の条件＞
// 西暦年が4で割り切れる年はうるう年
// ただし、西暦年が100で割り切れる年はうるう年ではない
// ただし、西暦年が400で割り切れる年はうるう年

function isLeapYear($year) {
    if($year % 400 === 0) {
        echo $year . '年はうるう年です。' . '<br>';
        return;
    } 
    
    if($year % 100 === 0) {
        echo $year . '年' . '<br>';
        return;
    } 
    
    if($year % 4 === 0) {
        echo $year . '年はうるう年です。' . '<br>';
        return;
    } 

    echo $year . '年' . '<br>';
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <title>うるう年判定</title>
</head>

<body>
  <?php for($year = 1900; $year <= 2080; $year++){ ?>
  <?php isLeapYear($year) ?>
  <?php } ?>
</body>

</html>