﻿<?php

for($i = 0; $i < 3; $i++){
  for($j = 0; $j < $i; $j++){
    echo '*';
  }
  for($k = 1; $k < 4 - $i; $k++){
    echo $k;
  }
  echo '<br>';
}

// 以下をfor文を使用して表示してください。

// 123
// *12
// **1