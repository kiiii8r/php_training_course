<?php
// ＜アルゴリズムの注意点＞
// アルゴリズムではこれまでのように調べる力ではなく物事を論理的に考える力が必要です。
// 検索して答えを探して解いても考える力には繋がりません。
// まずは検索に頼らずに自分で処理手順を考えてみましょう。


// 以下は1から100までの数字を順番に表示するプログラムです。
// その数が3で割り切れるなら"アホ"、5で割り切れるなら"わん"、
// 両方で割り切れるなら"アホわん"
// と表示してください。
// 判定は関数に記述し、関数を呼び出して結果表示すること
// ※余りの計算が分からなければ「php 四則演算」で検索

// 表示例）
// 1 
// 2 
// 3 アホ 
// 4 
// 5 わん 
// 6 アホ 
// 7 
// 8 
// 9 アホ
// 10 わん
// 11
// 12 アホ
// 13
// 14
// 15 アホわん
// .
// .
// 以下省略

function nabeatsu($i) {
    if($i % 3 === 0 && $i % 5 ===0){
        echo $i . 'アホわん' . '<br>';
        return;
    }
    
    if($i % 3 === 0 ){
        echo $i . 'アホ' . '<br>';
        return;
    }
    
    if( $i % 5 ===0 ){
        echo $i . 'わん' . '<br>';
        return;
    }

    echo $i . '<br>';
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <title>世界のナベアツプログラム</title>
</head>

<body>
  <section>
    <?php for($i=1; $i <= 100; $i++): ?>
    <?php nabeatsu($i)?>
    <?php endfor; ?>
  </section>
</body>

</html>