$(document).ready(function () {
  // const slider = $('.main_visual_slider');
  // const totalSlides = $('.main_total_slide');
  // const playPauseButton = $('#autoplay-button');
  // let isPlaying = true;
  // const currentSlideIndex = $('.main_current_slide');

  // slider.on('init', function(event, slick){
  //     totalSlides.text(slick.slideCount);
  //     currentSlideIndex.text(slick.currentSlide + 1);
  // });

  // slider.on('afterChange', function(event, slick, currentSlide){
  //     currentSlideIndex.text(currentSlide + 1);
  // });

  // slider.slick({
  //   autoplay: true,
  //   slidesToShow: 1,
  //   slidesToScroll: 1,
  //   arrows: true,
  //   infinite: true,
  //   autoplaySpeed: 3000,
  //   pauseOnFocus: true,
  //   speed: 1000,
  //   prevArrow: $('.swiper-button-prev-main'),
  //   nextArrow: $('.swiper-button-next-main')
  // });

  // playPauseButton.click(function(){
  //   if (isPlaying) {
  //       slider.slick('slickPause');
  //       $("#play-button").show();
  //       $("#pause-button").hide();
  //   } else {
  //       slider.slick('slickPlay');
  //       $("#pause-button").show();
  //       $("#play-button").hide();
  //   }
  //   isPlaying = !isPlaying;
  // });
  const owl = $(".main_visual_slider").owlCarousel({
    loop: true,
    margin: 20,
    nav: true,
    dots: false,
    nav: true,
    autoplay: true,
    autoplayHoverPause: true,
    autoplayTimeout: 5000,
    smartSpeed: 2000,
    navText: [
      `<span class="swiper-button-prev-main swiper-button-main owl-prev">
            <svg width="17" height="27" viewBox="0 0 17 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M14.4827 1.09832C14.0952 0.724604 13.4815 0.724612 13.0941 1.09834L0.88889 12.8725C0.481262 13.2658 0.481269 13.9187 0.888907 14.3119L12.7555 25.7589C13.1429 26.1326 13.7566 26.1326 14.144 25.7589L16.058 23.9125C16.4657 23.5193 16.4657 22.8663 16.058 22.4731L7.59657 14.312C7.18887 13.9188 7.18886 13.2657 7.59654 12.8725L16.3967 4.38412C16.8043 3.9909 16.8043 3.3379 16.3967 2.94466L14.4827 1.09832Z"
                    fill="white" />
            </svg>
        </span>`,
      `<span class="swiper-button-next-main swiper-button-main owl-next">
            <svg width="17" height="27" viewBox="0 0 17 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M2.51733 1.09832C2.90475 0.724604 3.51848 0.724612 3.90588 1.09834L16.1111 12.8725C16.5187 13.2658 16.5187 13.9187 16.1111 14.3119L4.24452 25.7589C3.85711 26.1326 3.2434 26.1326 2.85599 25.7589L0.941972 23.9125C0.534308 23.5193 0.53433 22.8663 0.942021 22.4731L9.40343 14.312C9.81113 13.9188 9.81114 13.2657 9.40346 12.8725L0.603329 4.38412C0.195662 3.9909 0.195651 3.3379 0.603305 2.94466L2.51733 1.09832Z"
                    fill="white" />
            </svg>
        </span>`,
    ],
    responsive: {
      0: {
        items: 1,
      },
      600: {
        items: 1,
      },
      1000: {
        items: 1,
      },
    },
  });
  const currentSlideIndex = $('.main_current_slide');
  owl.on('changed.owl.carousel', function(event) {
    var currentItem = event.item.index - event.relatedTarget._clones.length / 2;
    var totalItems = event.item.count;
    if (currentItem < 0) {
      currentItem = totalItems + currentItem;
    }
    currentSlideIndex.text((currentItem + 1));
  });
  $("#autoplay-button").click(function () {
    var $this = $(this);
    if ($this.hasClass("play")) {
      owl.trigger("play.owl.autoplay", [3000]);
      $this.removeClass("play").addClass("stop");
      $("#pause-button").show();
      $("#play-button").hide();
    } else {
      owl.trigger("stop.owl.autoplay");
      $this.removeClass("stop").addClass("play");
      $("#pause-button").hide();
      $("#play-button").show();
    }
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
  const imageHeight = $(el).find(".img_box").outerHeight();
  $(el)
    .siblings(".swiper-button-main-2")
    .css("top", imageHeight / 2 + "px");
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
