// table_mo_scroll
$(window).on("load resize", function () {
  let winWidth = $(window).innerWidth();
  if (winWidth <= 1200) {
    $(".detail_dim_wrap").on("click", function () {
      $(".table_mo_scroll").css("overflow-x", "auto");
      $(this).addClass("hide");
    });
  }
  if (winWidth <= 850) {
    $(".detail_dim_wrap").on("touchend", function () {
      $(".table_mo_scroll").css("overflow-x", "auto");
      $(this).addClass("hide");
    });
  }
  $(".login .login_tab button").on("click", function () {
    console.log("kasjdfk");
    var idx = $(this).index();
    $(this).addClass("on").siblings().removeClass("on");
    $(".login_box").eq(idx).addClass("on").siblings().removeClass("on");
  });
});

// management 경영정보 subTabList
$(".subTabList")
  .find("button")
  .click(function () {
    let idx = $(this).parent().index();

    $(".subTabList").find("button").removeClass("active");
    $(this).addClass("active");

    $(".management .tableWrap").hide();
    $(".management .tableWrap").eq(idx).show();
  });

// affiliate 환경 O&M subNavList
$(".subNavList")
  .find("button")
  .click(function () {
    let idx = $(this).parent().index();

    $(".subNavList").find("button").removeClass("active");
    $(this).addClass("active");

    $(".affiliate .subNavConts").hide();
    $(".affiliate .subNavConts").eq(idx).show();
  });

function setCookie(name, value, days) {
  var expires = "";
  if (days) {
      var date = new Date();
      date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
      expires = "; expires=" + date.toUTCString();
  }
  document.cookie = name + "=" + (value || "") + expires + "; path=/";
}

function getCookie(name) {
  var nameEQ = name + "=";
  var ca = document.cookie.split(';');
  for (var i = 0; i < ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) == ' ') c = c.substring(1, c.length);
      if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
  }
  return null;
}

function number_format(n) {

  if (isNaN(n)) return '0';

  let [integerPart, decimalPart] = String(n).split('.');

  integerPart = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, ',');

  return decimalPart ? integerPart + '.' + decimalPart : integerPart;
}

const daysOfWeek = ["일", "월", "화", "수", "목", "금", "토"];