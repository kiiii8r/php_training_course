<?php

// DB接続 
function insertContact($request){

require 'db_connection.php';

// 入力DB保存
$params = [
  'id' => null,
  'name' => $request['name'],
  'kana' => $request['kana'],
  'phone' => $request['phone'],
  'email' => $request['email'],
  'inquiry' => $request['inquiry'],
];

$count = 0;
$columns = '';
$values = '';

foreach(array_keys($params) as $key){
  if($count++>0){
    $columns .= ',';
    $values .= ',';
  }
  $columns .= $key;
  $values .= ':'.$key;
}

$sql = 'insert into contacts ('. $columns .')values('. $values .')';

$stmt = $pdo->prepare($sql);
$stmt->execute($params);

}
?>