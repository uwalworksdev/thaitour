// table_mo_scroll
$(window).on('load resize', function () {
  let winWidth = $(window).innerWidth();
  if (winWidth <= 1200) {
    $('.detail_dim_wrap').on('click', function () {
      $('.table_mo_scroll').css('overflow-x', 'auto');
      $(this).addClass('hide');
    });
  }
  if (winWidth <= 850) {
    $('.detail_dim_wrap').on('touchend', function () {
      $('.table_mo_scroll').css('overflow-x', 'auto');
      $(this).addClass('hide');
    });
  }
});

// management 경영정보 subTabList
$('.subTabList').find('button').click(function () {
  let idx = $(this).parent().index();

  $('.subTabList').find('button').removeClass('active');
  $(this).addClass('active');

  $('.management .tableWrap').hide();
  $('.management .tableWrap').eq(idx).show();
})

// affiliate 환경 O&M subNavList
$('.subNavList').find('button').click(function () {
  let idx = $(this).parent().index();

  $('.subNavList').find('button').removeClass('active');
  $(this).addClass('active');

  $('.affiliate .subNavConts').hide();
  $('.affiliate .subNavConts').eq(idx).show();
})
