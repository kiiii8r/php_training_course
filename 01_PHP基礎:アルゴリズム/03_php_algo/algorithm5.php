<?php
// ＜アルゴリズムの注意点＞
// アルゴリズムではこれまでのように調べる力ではなく物事を論理的に考える力が必要です。
// 検索して答えを探して解いても考える力には繋がりません。
// まずは検索に頼らずに自分で処理手順を考えてみましょう。


// 「algorithm5」で作成したポーカープログラムにジョーカーを追加してください。
// ジョーカー１枚のみ、suitをjoker、numberを0と表す。
// 上記以外は不正として処理してください。

// 追加された役
// 「フォーカード」＋ジョーカーは「ファイブカード」

// 判定は強い役を優先してください。組み合わせの強さ順は以下とする。
// ロイヤルストレートフラッシュ > ストレートフラッシュ > ファイブカード > フォーカード > フルハウス > フラッシュ > ストレート > スリーカード > ツーペア > ワンペア
// ジョーカーが出た時点で最低でも「ワンペア」となること


// 手札
$cards = [
    // ['suit'=>'heart', 'number'=>3],
    // ['suit'=>'spade', 'number'=>2],
    // ['suit'=>'club', 'number'=>1],
    // ['suit'=>'diamond', 'number'=>3],
    // ['suit'=>'heart', 'number'=>5],

    // 以下テストケース
    
    // ワンペア・・・同じ数字２枚（ペア）が１組
    // ['suit'=>'heart', 'number'=>3],
    // ['suit'=>'spade', 'number'=>2],
    // ['suit'=>'club', 'number'=>1],
    // ['suit'=>'diamond', 'number'=>3],
    // ['suit'=>'heart', 'number'=>5],
    
    // ワンペア joker
    // ['suit'=>'joker', 'number'=>0],
    // ['suit'=>'spade', 'number'=>2],
    // ['suit'=>'club', 'number'=>1],
    // ['suit'=>'diamond', 'number'=>9],
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
    
    // ストレート joker
    // ['suit'=>'heart', 'number'=>1],
    // ['suit'=>'spade', 'number'=>5],
    // ['suit'=>'joker', 'number'=>0],
    // ['suit'=>'diamond', 'number'=>3],
    // ['suit'=>'heart', 'number'=>2],
    
    // フラッシュ・・・同じマークが５枚
    // ['suit'=>'heart', 'number'=>1],
    // ['suit'=>'heart', 'number'=>7],
    // ['suit'=>'heart', 'number'=>4],
    // ['suit'=>'heart', 'number'=>9],
    // ['suit'=>'heart', 'number'=>2],
    
    // フラッシュ joker
    // ['suit'=>'heart', 'number'=>1],
    // ['suit'=>'heart', 'number'=>7],
    // ['suit'=>'heart', 'number'=>4],
    // ['suit'=>'joker', 'number'=>0],
    // ['suit'=>'heart', 'number'=>2],
    
    // フルハウス・・・同じ数字３枚が１組＋同じ数字２枚（ペア）が１組
    // ['suit'=>'heart', 'number'=>5],
    // ['suit'=>'spade', 'number'=>5],
    // ['suit'=>'club', 'number'=>4],
    // ['suit'=>'diamond', 'number'=>5],
    // ['suit'=>'heart', 'number'=>4],
    
    // フルハウス joker
    // ['suit'=>'heart', 'number'=>5],
    // ['suit'=>'spade', 'number'=>4],
    // ['suit'=>'joker', 'number'=>0],
    // ['suit'=>'diamond', 'number'=>5],
    // ['suit'=>'heart', 'number'=>4],
    
    // フォーカード・・・同じ数字４枚
    // ['suit'=>'heart', 'number'=>5],
    // ['suit'=>'spade', 'number'=>5],
    // ['suit'=>'club', 'number'=>5],
    // ['suit'=>'diamond', 'number'=>5],
    // ['suit'=>'heart', 'number'=>3],

    // ファイブカード
    // ['suit'=>'heart', 'number'=>5],
    // ['suit'=>'spade', 'number'=>5],
    // ['suit'=>'club', 'number'=>5],
    // ['suit'=>'diamond', 'number'=>5],
    // ['suit'=>'joker', 'number'=>0],

    // ストレートフラッシュ・・・数字の連番５枚＋同じマークが５枚
    // ['suit'=>'heart', 'number'=>1],
    // ['suit'=>'heart', 'number'=>5],
    // ['suit'=>'heart', 'number'=>4],
    // ['suit'=>'heart', 'number'=>3],
    // ['suit'=>'heart', 'number'=>2],
    
    // ストレートフラッシュ joker
    // ['suit'=>'heart', 'number'=>1],
    // ['suit'=>'heart', 'number'=>5],
    // ['suit'=>'heart', 'number'=>4],
    // ['suit'=>'heart', 'number'=>3],
    // ['suit'=>'joker', 'number'=>0],

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
    // ['suit'=>'circle', 'number'=>12],
    // ['suit'=>'heart', 'number'=>13],
    // ['suit'=>'heart', 'number'=>11],
    // ['suit'=>'heart', 'number'=>10],
    
    // 不正３ 上記以外の数字
    // ['suit'=>'heart', 'number'=>1],
    // ['suit'=>'heart', 'number'=>12],
    // ['suit'=>'heart', 'number'=>13],
    // ['suit'=>'heart', 'number'=>11],
    // ['suit'=>'heart', 'number'=>0],
    
    // 不正4 Jokerが2枚
    // ['suit'=>'heart', 'number'=>1],
    // ['suit'=>'joker', 'number'=>0],
    // ['suit'=>'heart', 'number'=>13],
    // ['suit'=>'heart', 'number'=>11],
    // ['suit'=>'joker', 'number'=>0],

    // 不正5 Jokerが0以外
    // ['suit'=>'heart', 'number'=>1],
    // ['suit'=>'heart', 'number'=>12],
    // ['suit'=>'joker', 'number'=>13],
    // ['suit'=>'heart', 'number'=>11],
    // ['suit'=>'heart', 'number'=>3],
];

function judge($cards) {

    // jokerの枚数
    $joker = joker($cards);

    // カードの不正チェック
    if (justice($cards, $joker)){
        return '手札は不正です';
    }
    
    // カードの並び替え
    $cards = sort_cards($cards);
 
    // 役判定
    $role = role($cards, $joker);

    // 結果を返す
    return '役は' . $role . 'です。';

}

// カードの不正チェック
function justice($cards, $joker) {
    foreach($cards as $key => $value) {

        // jokerが２枚以上あった場合
        if ($joker > 1){
            return true;
        }

        // 上記以外の絵柄が存在した場合
        
        if(!(   $value['suit'] === 'heart' ||
                $value['suit'] === 'spade' || 
                $value['suit'] === 'diamond' || 
                $value['suit'] === 'club' ||
                $value['suit'] === 'joker' 
            )) {
                    return true;
        }

        // 上記以外の数字が存在した場合
        
        if($value['suit'] === 'joker'){
            if($value['number'] !== 0){
                return true;
            }
        } else {
            if($value['number'] < 1 || $value['number'] > 13) {
                return true;
            }
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

function joker($cards) {
    $joker = 0;
    foreach($cards as $key => $value) {
        if($value['suit'] === 'joker') {
            $joker++;
        }
    }
    return $joker;
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
function role($cards, $joker){

    // 数字のペア数
    $num_pair = array();

    foreach($cards as $key => $value) {
        $num_pair[$key] = 1 + $joker;
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
        $suit_pair[$key] = 1 + $joker;
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
        if($joker === 1 && $key === 0){
            continue;
        }
        $stage_array[] = $value['number'] - $key;
        $array[] = $value['number'];
    }
    
    if(count(array_unique($stage_array)) === 1){
        $stage = true;
    }
    
    if($joker === 1 && count(array_unique($stage_array)) === 2){
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

    // ファイブカード
    if(in_array(5, $num_pair)){
        return 'ファイブカード';
    }

    // フォーカード・・・同じ数字４枚
    if(in_array(4, $num_pair)){
        return 'フォーカード';
    }
    
    // フルハウス・・・同じ数字３枚が１組＋同じ数字２枚（ペア）が１組
    if(in_array(2, $num_pair) && in_array(3, $num_pair)){
        if( array_count_values($num_pair)[2] !== 3 ){
            return 'フルハウス';
        }
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