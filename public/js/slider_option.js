$(document).ready(function () {
  
  $('.one_btn_custom_slider').on({
    'init': function () {$(".slide_item .cover_img").show();}
  });
  // ================ 슬라이드 1개 뷰 버튼 커스텀
  const oneBtnCustomSlider = {
    autoplay: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: true,
    dots : false,
    prevArrow: $('.prevBtn'),
    nextArrow: $('.nextBtn'),
  }
  
  // ================ 슬라이드 1개 
  const oneSlider = {
    autoplay: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: true,
    dots : false,
    responsive: [
      {
          breakpoint: 851,
          settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
          }
      }
    ]
  }



  // =================== 절반 슬라이드
  const halfSlider = {
    // autoplay: true,
    slidesToShow: 2,
    slidesToScroll: 2,
    arrows: true,
    dots: true,
    appendDots: $('.main-dots'),
    responsive: [
      {
          breakpoint: 851,
          settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
              variableWidth: true
          }
      }
    ]
  }

  const halfSlider_se = {
    autoplay: true,
    slidesToShow: 2,
    slidesToScroll: 2,
    arrows: true,
    dots: true,
    appendDots: $('.main-dots'),
    responsive: [
      {
          breakpoint: 851,
          settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
          }
      }
    ]
  }


 // --------------- 3개 슬라이드
  const thirdSlider = {
    autoplay: true,
    slidesToShow: 3,
    slidesToScroll: 1,
    arrows: true,
    dots : false,
    responsive: [
      {
          breakpoint: 851,
          settings: {
              slidesToShow: 1,
              variableWidth: true,
              centerMode: true,
              slidesToScroll: 1,
          }
      }
    ]
  }


  const fourSlider = {
    autoplay: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: true,
    dots : false,
    responsive: [
      {
          breakpoint: 851,
          settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
              variableWidth: true
          }
      }
    ]
  }

  // --------------- 4개 슬라이드
  const quarterSlider = {
    autoplay: true,
    slidesToShow:4,
    slidesToScroll: 4,
    arrows: true,
    dots : true,
    appendDots : $('.sub-dots'),
    responsive: [
      {
          breakpoint: 851,
          settings: {
              slidesToShow: 2,
              slidesToScroll: 2,
              arrows: false,
          }
      }
    ]

  }

  const quarterSlider_spe = {
    autoplay: true,
    slidesToShow:4,
    slidesToScroll: 4,
    arrows: true,
    dots : true,
    appendDots : $('.sub-dots'),
    responsive: [
      {
          breakpoint: 851,
          settings: {
              slidesToShow: 2,
              slidesToScroll: 2,
              arrows: true,
          }
      }
    ]

  }

  const quarterSlider2 = {
    autoplay: true,
    slidesToShow:4,
    slidesToScroll: 4,
    arrows: true,
    dots : true,
    appendDots : $('.sub-dots2'),
    responsive: [
      {
          breakpoint: 851,
          settings: {
              slidesToShow: 2,
              slidesToScroll: 2
          }
      }
    ]
  }


  // --------------- plan

  const planSlider = {
    autoplay: true,
    arrows: true,
    dots : true,
    appendDots : $('.plan-dots'),
    rows: 3,
    slidesToScroll: 1,
    slidesToShow: 3,

  }

  const introSlider = {
    autoplay: false,
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: true,
    dots : false,
    prevArrow: $('.prevBtn'),
    nextArrow: $('.nextBtn'),
    responsive: [
      {
          breakpoint: 851,
          settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
          }
      }
    ]
  }
  // =================== 기본
  $('.one_btn_custom_slider').slick(oneBtnCustomSlider);
  $('.one_slider').slick(oneSlider);
  $('.half_slider').slick(halfSlider);  
  $('.half_slider_se').slick(halfSlider_se);
  $('.third_slider').slick(thirdSlider);
  $('.four_slider').slick(fourSlider);
  $('.quarter_slider').slick(quarterSlider);
  $('.quarter_slider_spe').slick(quarterSlider_spe);
  $('.quarter_slider2').slick(quarterSlider2);
  // $('.plan_slider').slick(planSlider);
  
  $('.intro_slider').slick(introSlider);


});








