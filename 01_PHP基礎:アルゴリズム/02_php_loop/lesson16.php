<?php

for($i = 5; $i > 0; $i--){
  for($j = 1; $j < $i; $j++){
    echo '*';
  }
  for($l = 5; $l > $i; $l--){
    echo $l;
  };
  for($k = $i; $k <= 5; $k++){
    echo $k;
  }
echo '<br>'; 
}
// 以下をfor文を使用して表示してください。

// ****5
// ***545
// **54345
// *5432345
// 543212345