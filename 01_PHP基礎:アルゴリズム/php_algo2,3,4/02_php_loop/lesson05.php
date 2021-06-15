<?php

$num = 6;

for ($i = 0; $i < 3; $i++){
  for ($j = 0; $j < $i + 1; $j++){
      echo $num;
      $num -= 1;
  }
  echo '<br>'; 
}
// 以下をfor文を使用して表示してください。

// 6
// 54
// 321