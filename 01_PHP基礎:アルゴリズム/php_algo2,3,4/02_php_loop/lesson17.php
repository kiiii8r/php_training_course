<?php

for ($i = 1; $i <= 9; $i++){
  if($i <= 5){
    for ($j = $i; $j < 5; $j++){
      echo '*';
    }
    $num = 0;
    for ($k = 0; $k < $i; $k++){
      $num += pow(10, $k);
    }
    echo $num * $num;
    echo '<br>'; 
  }
  else if($i > 5) {
    for($j = 0; $j < $i - 5; $j++){
      echo '*';
    }
    $num = 1;
    for ($k = 9 - $i; $k > 0; $k--){
      $num += pow(10, $k);
    }
    echo $num * $num;
    echo '<br>'; 
  }
}
// 以下をfor文を使用して表示してください。
// ヒント: if〜elseifを使用

// ****1
// ***121
// **12321
// *1234321
// 123454321
// *1234321
// **12321
// ***121
// ****1