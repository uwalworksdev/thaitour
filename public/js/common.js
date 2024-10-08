let vh = window.innerHeight * 0.01;
document.documentElement.style.setProperty("--vh", vh + "px");
window.addEventListener("resize", function () {
  let vh = window.innerHeight * 0.01;
  document.documentElement.style.setProperty("--vh", vh + "px");
});

// 스크롤 애니메이션
var aniDiv = document.querySelectorAll(".ani_el");
var aniDivArry = new Array();

Array.prototype.forEach.call(aniDiv, function (ele) {
  aniDivArry.push(ele);
});

$(window).on("scroll", function () {
  var scrollTop = $(window).scrollTop(),
    windowH = ($(window).height() / 4) * 3;
  var scrollBottom =
    $(document).height() - $(window).height() - $(window).scrollTop();

  if (scrollBottom <= 0) {
    $("section:last-child .ani_el").addClass("move");
  }
  // section animate
  for (var i = 0; i < aniDivArry.length; i++) {
    if ($(aniDivArry[i]).offset().top < scrollTop + windowH) {
      $(aniDivArry[i]).addClass("move");
      aniDivArry.splice(i, 1);
    }
  }

  // header animate
  if (scrollTop > 0) {
    $("html").addClass("header_on");
  } else if ($("#container").hasClass("sub") === true) {
    $("html").addClass("header_on"); /* 서브페이지는 header_on 기본값 */
  } else if (scrollTop == 0) {
    $("html").removeClass("header_on");
  }
});



$(document).ready(function () {

  // 전체메뉴
  $(".ham_btn").click(function () {
    $("html").toggleClass("gnb_open");
  });

  function toggleMenu() {
    if ($(window).width() <= 850) {
      // 아코디언
      $("#nav .menu_container .depth1 > ul > li > a").off("click.gnb").on("click.gnb", function (e) {
        e.preventDefault();
        let $this = $(this);
        let $depth2 = $this.next('.depth2');

        // 현재 클릭한 메뉴의 depth2 슬라이드
        $depth2.slideToggle();

        // 다른 메뉴 depth2 닫음
        $("#nav .menu_container .depth1 > ul > li > a").not($this).next('.depth2').slideUp();

        // 현재 클릭한 메뉴의 버튼 상태를 변경하고 다른 메뉴의 버튼 상태를 제거
        $this.toggleClass('on').siblings('a').removeClass('on');
      });

      // 모바일 화면에서는 항상 닫힌 상태로 시작하도록 설정
      $("#nav .menu_container .depth1 > ul > li > a").next('.depth2').slideUp();
    } else {
      // 화면 너비가 850px 초과일 때는 클릭 이벤트 해제
      $("#nav .menu_container .depth1 > ul > li > a").off("click.gnb");

      // 모바일 화면이 아닐 때는 모든 메뉴를 펼친 상태로 표시
      $("#nav .menu_container .depth1 > ul > li > a").next('.depth2').slideDown();

      // 모바일 화면이 아닐 때 모든 버튼의 on 클래스를 제거
      $("#nav .menu_container .depth1 > ul > li > a").removeClass('on');
    }
  }

  // 모바일 화면이 아닐 때 마우스 오버 이벤트
  $("#nav .menu_container .depth1 > ul > li").on("mouseover", function (e) {
    addRemove($(this));
  });

  // 페이지 로드 및 창 크기 변경시 이벤트 처리
  toggleMenu();
  $(window).resize(toggleMenu);
});

// 패밀리사이트
$(document).ready(function () {
  // 헤더
  $("#header .familysite button").click(function () {
    $(this).toggleClass('on')
    $("#header .familysite ul").slideToggle("on");
  });
  // 푸터
  $("#footer .familysite button").click(function () {
    $(this).toggleClass('on')
    $("#footer .familysite ul").slideToggle("on");
  });

})

// top_btn
$(window).scroll(function () {
  if ($(this).scrollTop() > 400) {
    $('.top_btn').fadeIn();
  } else {
    $('.top_btn').fadeOut();
  }
});
$('.top_btn').click(function () {
  $('html, body').animate({
    scrollTop: 0
  }, 800);
  return false;
});