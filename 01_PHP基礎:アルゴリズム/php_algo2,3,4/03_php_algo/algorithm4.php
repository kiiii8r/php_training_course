<?php
// ＜アルゴリズムの注意点＞
// アルゴリズムではこれまでのように調べる力ではなく物事を論理的に考える力が必要です。
// 検索して答えを探して解いても考える力には繋がりません。
// まずは検索に頼らずに自分で処理手順を考えてみましょう。


// 以下はポーカーの役を判定するプログラムです。
// cards配列に格納したカードの役を判定し、結果表示してください。
// cards配列には計5枚、それぞれ絵柄(suit)、数字(numeber)を格納する
// 絵柄はheart, spade, diamond, clubのみ
// 数字は1-13のみ

// 上記以外の絵柄や数字が存在した場合、または同一の絵柄、数字がcards配列に存在した場合、
// 役の判定前に「手札が不正です」と表示してください。
// 役判定は関数に記述し、関数を呼び出して結果表示すること
// プログラムが完成したらcards配列を差し替えてすべての役で検証を行い、提出時にテストケースを示すこと

// <役>
// ワンペア・・・同じ数字２枚（ペア）が１組
// ツーペア・・・同じ数字２枚（ペア）が２組
// スリーカード・・・同じ数字３枚
// ストレート・・・数字の連番５枚（13と1は繋がらない）
// フラッシュ・・・同じマークが５枚
// フルハウス・・・同じ数字３枚が１組＋同じ数字２枚（ペア）が１組
// フォーカード・・・同じ数字４枚
// ストレートフラッシュ・・・数字の連番５枚＋同じマークが５枚
// ロイヤルストレートフラッシュ・・・1, 10, 11, 12, 13で同じマーク
// ※下の方が強い

// 表示例1）
// 手札は 
// heart2 heart5 heart3 heart4 culb1
// 役はストレートです

// 表示例2）
// 手札は 
// heart1 spade2 diamond11 club13 heart9
// 役はなしです

// 表示例3）
// 手札は 
// heart1 heart1 heart3 heart4 heart5
// 手札は不正です


// 手札
$cards = [
    ['suit'=>'heart', 'number'=>3],
    ['suit'=>'spade', 'number'=>2],
    ['suit'=>'club', 'number'=>1],
    ['suit'=>'diamond', 'number'=>3],
    ['suit'=>'heart', 'number'=>5],

    // 以下テストケース
    
    // ワンペア・・・同じ数字２枚（ペア）が１組
    // ['suit'=>'heart', 'number'=>3],
    // ['suit'=>'spade', 'number'=>2],
    // ['suit'=>'club', 'number'=>1],
    // ['suit'=>'diamond', 'number'=>3],
    // ['suit'=>'heart', 'number'=>5],

    // ツーペア・・・同じ数字２枚（ペア）が２組
    // ['suit'=>'heart', 'number'=>9],
    // ['suit'=>'spade', 'number'=>9],
    // ['suit'=>'club', 'number'=>1],
    // ['suit'=>'diamond', 'number'=>3],
    // ['suit'=>'heart', 'number'=>3],
    
    // スリーカード・・・同じ数字３枚
    // ['suit'=>'heart', 'number'=>9],
    // ['suit'=>'spade', 'number'=>9],
    // ['suit'=>'club', 'number'=>9],
    // ['suit'=>'diamond', 'number'=>4],
    // ['suit'=>'heart', 'number'=>3],
    
    // ストレート・・・数字の連番５枚（13と1は繋がらない）
    // ['suit'=>'heart', 'number'=>1],
    // ['suit'=>'spade', 'number'=>5],
    // ['suit'=>'club', 'number'=>4],
    // ['suit'=>'diamond', 'number'=>3],
    // ['suit'=>'heart', 'number'=>2],
    
    // フラッシュ・・・同じマークが５枚
    // ['suit'=>'heart', 'number'=>1],
    // ['suit'=>'heart', 'number'=>7],
    // ['suit'=>'heart', 'number'=>4],
    // ['suit'=>'heart', 'number'=>9],
    // ['suit'=>'heart', 'number'=>2],
    
    // フルハウス・・・同じ数字３枚が１組＋同じ数字２枚（ペア）が１組
    // ['suit'=>'heart', 'number'=>5],
    // ['suit'=>'spade', 'number'=>5],
    // ['suit'=>'club', 'number'=>4],
    // ['suit'=>'diamond', 'number'=>5],
    // ['suit'=>'heart', 'number'=>4],
    
    // フォーカード・・・同じ数字４枚
    // ['suit'=>'heart', 'number'=>5],
    // ['suit'=>'spade', 'number'=>5],
    // ['suit'=>'club', 'number'=>5],
    // ['suit'=>'diamond', 'number'=>5],
    // ['suit'=>'heart', 'number'=>3],

    // ストレートフラッシュ・・・数字の連番５枚＋同じマークが５枚
    // ['suit'=>'heart', 'number'=>1],
    // ['suit'=>'heart', 'number'=>5],
    // ['suit'=>'heart', 'number'=>4],
    // ['suit'=>'heart', 'number'=>3],
    // ['suit'=>'heart', 'number'=>2],

    // ロイヤルストレートフラッシュ・・・1, 10, 11, 12, 13で同じマーク
    // ['suit'=>'heart', 'number'=>1],
    // ['suit'=>'heart', 'number'=>12],
    // ['suit'=>'heart', 'number'=>13],
    // ['suit'=>'heart', 'number'=>11],
    // ['suit'=>'heart', 'number'=>10],

    // 役なし
    // ['suit'=>'heart', 'number'=>3],
    // ['suit'=>'spade', 'number'=>12],
    // ['suit'=>'heart', 'number'=>13],
    // ['suit'=>'heart', 'number'=>11],
    // ['suit'=>'heart', 'number'=>10],

    // 不正 または同一の絵柄、数字
    // ['suit'=>'heart', 'number'=>1],
    // ['suit'=>'heart', 'number'=>12],
    // ['suit'=>'heart', 'number'=>13],
    // ['suit'=>'heart', 'number'=>12],
    // ['suit'=>'heart', 'number'=>10],
    
    // 不正２ 上記以外の絵柄
    // ['suit'=>'heart', 'number'=>1],
    // ['suit'=>'joker', 'number'=>12],
    // ['suit'=>'heart', 'number'=>13],
    // ['suit'=>'heart', 'number'=>11],
    // ['suit'=>'heart', 'number'=>10],
    
    // 不正３ 上記以外の数字
    // ['suit'=>'heart', 'number'=>1],
    // ['suit'=>'heart', 'number'=>12],
    // ['suit'=>'heart', 'number'=>13],
    // ['suit'=>'heart', 'number'=>11],
    // ['suit'=>'heart', 'number'=>0],
];

function judge($cards) {

    // カードの不正チェック
    if (justice($cards)){
        return '手札は不正です';
    }
    
    // カードの並び替え
    $cards = sort_cards($cards);
 
    // 役判定
    $role = role($cards);

    // 結果を返す
    return '役は' . $role . 'です。';

}

// カードの不正チェック
function justice($cards) {
    foreach($cards as $key => $value) {

        // 上記以外の絵柄が存在した場合
        
        if(!(   $value['suit'] === 'heart' ||
                $value['suit'] === 'spade' || 
                $value['suit'] === 'diamond' || 
                $value['suit'] === 'club' 
            )) {
                    return true;
        }

        // 上記以外の数字が存在した場合
        
        if($value['number'] < 1 || $value['number'] > 13) {
                    return true;
        }
        
        // 同一の絵柄、数字がcards配列に存在した場合
        
        foreach($cards as $key_c => $card) {
            if($key === $key_c) {
                continue;
            } else {
                if ($card['suit'] === $cards[$key]['suit'] && $card['number'] ===$cards[$key]['number']) {
                    return true;
                }
            } 
        }
    }
}

// カードの並び替え     
function sort_cards($cards) {
    for($i = 0; $i < count($cards); $i++ ){
        for($j = $i + 1; $j < count($cards); $j++){
            if ($cards[$i]['number'] > $cards[$j]['number']) {
                $num = $cards[$i]['number'];
                $cards[$i]['number'] = $cards[$j]['number'];
                $cards[$j]['number'] = $num;
            } 
        }
    }
    return $cards;
}

// 役判定
function role($cards){

    // 数字のペア数
    $num_pair = array();

    foreach($cards as $key => $value) {
        $num_pair[$key] = 1;
        foreach($cards as $key_c => $card) {
            if($key === $key_c) {
                continue;
            } else {
                if ($card['number'] === $cards[$key]['number']) {
                    $num_pair[$key] += 1; 
                }
            } 
        }
    }
    
    // マークのペア数
    $suit_pair = array();

    foreach($cards as $key => $value) {
        $suit_pair[$key] = 1;
        foreach($cards as $key_c => $card) {
            if($key === $key_c) {
                continue;
            } else {
                if ($card['suit'] === $cards[$key]['suit']) {
                    $suit_pair[$key] += 1; 
                }
            } 
        }
    }

    // 階段になっているか
    $stage_array = array();
    $array = array();
    $stage = false;

    foreach($cards as $key => $value) {
        $stage_array[] = $value['number'] - $key;
        $array[] = $value['number'];
    }
    
    if(count(array_unique($stage_array)) === 1){
        $stage = true;
    }

// 結果を返す

    // ロイヤルストレートフラッシュ・・・1, 10, 11, 12, 13で同じマーク
    $royal = [1, 10, 11, 12, 13];
    if($array === $royal) {
        return 'ロイヤルストレートフラッシュ';
    }
    
    // ストレートフラッシュ・・・数字の連番５枚＋同じマークが５枚
    if($stage && in_array(5, $suit_pair)){
        return 'ストレートフラッシュ';
    }

    // フォーカード・・・同じ数字４枚
    if(in_array(4, $num_pair)){
        return 'フォーカード';
    }
    
    // フルハウス・・・同じ数字３枚が１組＋同じ数字２枚（ペア）が１組
    if(in_array(2, $num_pair) && in_array(3, $num_pair)){
        return 'フルハウス';
    }
    
    // フラッシュ・・・同じマークが５枚
    if(in_array(5, $suit_pair)){
        return 'フラッシュ';
    }

    // ストレート・・・数字の連番５枚（13と1は繋がらない）
    if($stage){
        return 'ストレート';
    }

    // スリーカード・・・同じ数字３枚
    if(in_array(3, $num_pair)){
        return 'スリーカード';
    }
    
    // ツーペア・・・同じ数字２枚（ペア）が２組
    if(in_array(2, $num_pair) && array_count_values($num_pair)[2] === 4){
        return 'ツーペア';
    }

    // ワンペア・・・同じ数字２枚（ペア）が１組
    if(in_array(2, $num_pair)){
        return 'ワンペア';  
    }

    return 'なし';
}

?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <title>ポーカー役判定</title>
</head>

<body>
  <section>
    <p>手札は</p>
    <p>
      <?php foreach($cards as $card): ?>
      <?=$card['suit'].$card['number'] ?>
      <?php endforeach; ?>
    </p>
    <p><?= judge($cards) ?></p>
  </section>
</body>

</html>