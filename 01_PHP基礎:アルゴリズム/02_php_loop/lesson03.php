<?php

$num = 0;

for ($i = 0; $i < 3; $i++){
  for ($j = 0; $j < $i + 1; $j++){
      $num += 1;
      echo $num;
  }
  echo '<br>'; 
}

// 以下をfor文を使用して表示してください。

// 1
// 23
// 456 7