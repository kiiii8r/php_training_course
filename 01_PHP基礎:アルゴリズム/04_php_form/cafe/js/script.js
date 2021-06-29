$(function() {

  // サインイン画面

  $("#signin").click(function() {
    $(".bg_darken").show();
    $("#signin_box").fadeIn().addClass("scroll");
  });

  $(".bg_darken").click(function(){
    $(".bg_darken").hide();
    $("#signin_box").hide();
    $("#signin_box").removeClass("scroll");
  });

  $("#signin_box").click(function(e) {
      e.stopPropagation();
  });

// 場所へスクロール
  $('#prefectureBtn').on('click', function(){
      const prefectureTop = $('#prefecture').offset().top;
      $("html").animate({scrollTop: prefectureTop});
  });

// 体験へスクロール
  $('#experienceBtn').on('click', function(){
    const experienceTop = $('#experience').offset().top;
    $("html").animate({scrollTop: experienceTop});
  });

// ジャンプボタンで一番上に
  $("#jump").click(function() {
    $('body, html').animate({scrollTop: 0}, 350,'linear');
  });

// スライド関連
  $(window).scroll(function() {
    var scr_count = $(window).scrollTop();
    var fixed_pos = $("#fixed_pos").offset().top;
    var jump_pos = 500;

    // ヘッダー
    if(scr_count > fixed_pos){
      $('#fixed').addClass('fixed');
    }else{ 
      $('#fixed').removeClass('fixed');
    }

    // ジャンプボタン
    if(scr_count > jump_pos){
      $('#jump').slideDown();
    }else{ 
      $('#jump').slideUp();
    }
  });

  // ページ外からの指定位置へのスクロール
  var urlHash = location.hash;
    if (urlHash) {
      $('body,html').stop().scrollTop(0);
      setTimeout(function(){
        var headerHight = 0;
        var target = $(urlHash);
        var position = target.offset().top - headerHight;
        $('body,html').stop().animate({scrollTop:position}, 400);
    }, 100);
  }
});
