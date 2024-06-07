$(document).ready(function(){
    const slider = $('.main_visual_slider');
    const totalSlides = $('.main_total_slide');
    const playPauseButton = $('#autoplay-button');
    let isPlaying = true;
    const currentSlideIndex = $('.main_current_slide');

    slider.on('init', function(event, slick){
        totalSlides.text(slick.slideCount);
        currentSlideIndex.text(slick.currentSlide + 1);
    });

    slider.on('afterChange', function(event, slick, currentSlide){
        currentSlideIndex.text(currentSlide + 1);
    });

    slider.slick({
      autoplay: true,
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: true,
      infinite: true,
      autoplaySpeed: 3000,
      pauseOnFocus: true,
      speed: 1000,
      prevArrow: $('.swiper-button-prev-main'),
      nextArrow: $('.swiper-button-next-main')
    });

    playPauseButton.click(function(){
      if (isPlaying) {
          slider.slick('slickPause');
          $("#play-button").show();
          $("#pause-button").hide();
      } else {
          slider.slick('slickPlay');
          $("#pause-button").show();
          $("#play-button").hide();
      }
      isPlaying = !isPlaying;
    });
});

const swiper1 = new Swiper(".main_swiper2", {
  loop: true,
  slidesPerView: 5,
  spaceBetween: 20,
  navigation: {
    nextEl: ".main_swiper2_btn_next",
    prevEl: ".main_swiper2_btn_prev",
  },
});

function setButtonPosition(el) {
  const imageHeight = $(el).find('.img_box').outerHeight();
  $(el).siblings(".swiper-button-main-2").css('top', imageHeight / 2 + 'px');
}

const swiper2 = new Swiper(".hot_product_list_swiper_1", {
  loop: true,
  slidesPerView: 4,
  spaceBetween: 20,
  pagination: {
    el: ".hot_product_list_swiper_pagination_1",
  },
  navigation: {
    nextEl: ".hot_product_list_swiper_1_btn_next",
    prevEl: ".hot_product_list_swiper_1_btn_prev",
  },
  on: {
    init: function (swiper) {
      setButtonPosition(swiper.el);
    },
    resize: function (swiper) {
      setButtonPosition(swiper.el);
    },
  },
});

const swiper3 = new Swiper(".hot_product_list_swiper_2", {
  loop: true,
  slidesPerView: 4,
  spaceBetween: 20,
  pagination: {
    el: ".hot_product_list_swiper_pagination_2",
  },
  navigation: {
    nextEl: ".hot_product_list_swiper_2_btn_next",
    prevEl: ".hot_product_list_swiper_2_btn_prev",
  },
  on: {
    init: function (swiper) {
      setButtonPosition(swiper.el);
    },
    resize: function (swiper) {
      setButtonPosition(swiper.el);
    },
  },
});

const swiper4 = new Swiper(".review__list_swiper", {
  loop: true,
  slidesPerView: 4,
  spaceBetween: 20,
  navigation: {
    nextEl: ".review__list_swiper_btn_next",
    prevEl: ".review__list_swiper_btn_prev",
  },
});

const swiper5 = new Swiper(".magazine_swiper", {
  loop: true,
  slidesPerView: 5,
  spaceBetween: 20,
  pagination: {
    el: ".magazine_swiper__pagination",
  },
});

const swiper6 = new Swiper(".notice_swiper", {
  loop: true,
  slidesPerView: 1,
  spaceBetween: 5,
  navigation: {
    nextEl: ".notice_swiper_btn_next",
    prevEl: ".notice_swiper_btn_prev",
  },
});
