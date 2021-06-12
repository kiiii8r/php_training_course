<?php

for ($i = 0; $i < 4; $i++){
    for ($j = 0 + $i; $j < 3; $j++){
      echo '*';
    }
    $num = 0;
    for ($k = 0; $k <= $i; $k++){
      $num += pow(10, $k);
    }
    echo $num * $num;
  echo '<br>'; 
}


// 以下をfor文を使用して表示してください。
// ヒント: forの中でforを３回使用

// ***1
// **121
// *12321
// 1234321