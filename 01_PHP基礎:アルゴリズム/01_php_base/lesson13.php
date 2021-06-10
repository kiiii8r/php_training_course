<?php
// 以下をそれぞれ表示してください。
// 表示するタイミングによって自動で算出すること
// ・現在日時（yyyy年mm月dd日 H時i分s秒）
// ・現在日時から３日後
// ・現在日時から１２時間前
// ・2020年元旦から現在までの経過日数

// 日時がおかしい場合、PHPのタイムゾーン設定を行ってください

$date = new DateTime();
echo $date->format('・Y年m月d日 H時i分s秒'). '<br>';

$date->modify('+3 day');
echo $date->format('・Y年m月d日 H時i分s秒'). '<br>';

$date = new DateTime();
$date->modify('-12 hour');
echo $date->format('・Y年m月d日 H時i分s秒'). '<br>';

$date1 = new DateTime();
$date2 = new DateTime('2020-01-01');
$diff = $date1->diff($date2);
echo $diff->format('・%a日経過'). '<br>';