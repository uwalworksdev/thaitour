const swiper = new Swiper(".main_swiper", {
  loop: true,
  slidesPerView: 1,
  spaceBetween: 20,
  centeredSlides: true,
  navigation: {
    nextEl: ".swiper-button-next-main",
    prevEl: ".swiper-button-prev-main",
  },
});
swiper.on("slideChange", function () {
  $(".main_current_slide").text(swiper.realIndex + 1);
});

const swiper1 = new Swiper(".main_swiper2", {
  loop: true,
  slidesPerView: 5,
  spaceBetween: 20,
  navigation: {
    nextEl: ".swiper-button-next-main-2",
    prevEl: ".swiper-button-prev-main-2",
  },
});
const swiper2 = new Swiper(".hot_product_list_swiper_1", {
  loop: true,
  slidesPerView: 4,
  spaceBetween: 20,
  pagination: {
    el: '.hot_product_list_swiper_pagination_1',
  },
});

const swiper3 = new Swiper(".hot_product_list_swiper_2", {
  loop: true,
  slidesPerView: 4,
  spaceBetween: 20,
  pagination: {
    el: '.hot_product_list_swiper_pagination_2',
  },
});
