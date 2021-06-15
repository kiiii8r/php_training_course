<?php 
// 以下配列の中身をfor文を使用して表示してください。
// 表示はHTMLの<table>タグを使用すること

/**
 * 表示イメージ
 *  _________________________
 *  |_____|_c1|_c2|_c3|横合計|
 *  |___r1|_10|__5|_20|___35|
 *  |___r2|__7|__8|_12|___27|
 *  |___r3|_25|__9|130|__164|
 *  |縦合計|_42|_22|162|__226|
 *  ‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾
 */

$arr = [
    'r1' => ['c1' => 10, 'c2' => 5, 'c3' => 20],
    'r2' => ['c1' => 7, 'c2' => 8, 'c3' => 12],
    'r3' => ['c1' => 25, 'c2' => 9, 'c3' => 130]
];
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <title>テーブル表示</title>
  <style>
  table {
    border: 1px solid #000;
    border-collapse: collapse;
    text-align: right;
  }

  th,
  td {
    border: 1px solid #000;
  }
  </style>
</head>

<body>
  <table>
    <thead>
      <tr>
        <th></th>
        <?php foreach($arr as $key => $val): ?>
        <?php foreach($val as $cel => $data): ?>
        <th><?= $cel ?></th>
        <?php endforeach; ?>
        <?php break; ?>
        <?php endforeach; ?>
        <th>横合計</th>
      </tr>

      <thead>

      <tbody>
        <?php $rec_total = ['c1'=>0,'c2'=>0,'c3'=>0]; ?>

        <?php foreach($arr as $key): ?>
        <tr>
          <?php $col_total = 0 ?>
          <td><?= key($arr) ?></td>

          <?php foreach($key as $val => $data): ?>
          <td><?= $data ?></td>
          <?php $col_total += $data; ?>
          <?php $rec_total[$val] += $data ?>
          <?php endforeach; ?>
          <td><?= $col_total ?></td>

        </tr>
        <?php next($arr); ?>
        <?php endforeach; ?>
        <th>縦合計</th>
        <?php $col_total = 0 ?>
        <?php foreach($rec_total as $data): ?>
        <td><?= $data ?></td>
        <?php $col_total += $data; ?>
        <?php endforeach; ?>
        <td><?= $col_total  ?></td>
      </tbody>

  </table>
</body>

</html>