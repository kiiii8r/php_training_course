<?php

require '../db/db_connection.php';

// ユーザ入力なし

$sql = 'select * from contacts'; //sql
$stmt = $pdo->query($sql); //sql実行 ステートメント

$result = $stmt->fetchall();

var_dump($result);

// ユーザ入力あり
$sql = 'select * from contacts where id = :id'; 
$stmt = $pdo->prepare($sql);
$stmt->bindValue('id', 5, PDO::PARAM_INT);
$stmt->execute();
?>