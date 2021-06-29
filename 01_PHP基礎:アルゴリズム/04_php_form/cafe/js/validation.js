$(function () {

  var error = [];

  $('#formVal').submit(function() {
    // 氏名
    if ($("#name").val() == '') {
      error.push('氏名は必須入力です。');
    } else if ($('#name').val().length > 10) {
      error.push('氏名は10字以内で入力してください。');
    }

    // カナ
    if ($("#kana").val() == '') {
      error.push('フリガナは必須入力です。')
    } else if ($('#kana').val().length > 10) {
      error.push('フリガナは10字以内で入力してください。');
    }
 
    // 電話番号
    if ((!$("#phone").val().match(/^[0-9]{2,4}[0-9]{2,4}[0-9]{3,4}$/)) && (!$("#phone").val() == '')) {
      error.push("正しい電話番号を入力してください。");
    }

    // メールアドレス
    if ($("#email").val() == "") {
      error.push("メールアドレスは必須入力です。");
    } else if(!$("#email").val().match(/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/)) {
      error.push("メールアドレスは正しくご入力ください。");
    }
    
    // お問い合わせ内容
    if ($("#inquiry").val() == "") {
      error.push("お問い合わせ内容は必須入力です。");
    }

    if(error.length !== 0) {
      alert(error.join('\n'));
    }

  });
});