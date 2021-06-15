<?php


for($i = 1; $i < 5; $i++){
  for($j = 1; $j < $i; $j++){
    echo '*';
  }
  $num = 1;
  for ($k = 4 - $i; $k > 0; $k--){
    $num += pow(10, $k);
  }
  echo $num * $num;
echo '<br>'; 
}
// 以下をfor文を使用して表示してください。

// 1234321
// *12321
// **121
// ***1