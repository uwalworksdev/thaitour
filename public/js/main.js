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
    // const owl = $(".main_visual_slider").owlCarousel({
    //     loop: true,
    //     // margin: 20,
    //     // nav: true,
    //     dots: false,
    //     nav: true,
    //     autoplay: true,
    //     autoplayHoverPause: true,
    //     autoplayTimeout: 5000,
    //     smartSpeed: 2000,
    //     navText: [
    //         `<span class="swiper-button-prev-main swiper-button-main owl-prev">
    //        <img src="/img/ico/icon_next_main_slider.png" alt="" class="image_prev_slider_">
    //     </span>`,
    //         `<span class="swiper-button-next-main swiper-button-main owl-next">
    //         <img src="/img/ico/icon_next_main_slider.png" alt="" class="image_next_slider_">
    //     </span>`,
    //     ],
    //     responsive: {
    //         0: {
    //             items: 1,
    //         },
    //         600: {
    //             items: 1,
    //         },
    //         1000: {
    //             items: 1,
    //         },
    //     },
    // });
    // const currentSlideIndex = $(".main_current_slide");
    // owl.on("changed.owl.carousel", function (event) {
    //     var currentItem = event.item.index - event.relatedTarget._clones.length / 2;
    //     var totalItems = event.item.count;
    //     if (currentItem < 0) {
    //         currentItem = totalItems + currentItem;
    //     }
    //     currentSlideIndex.text(currentItem + 1);
    // });
    // $("#autoplay-button").click(function () {
    //     var $this = $(this);
    //     if ($this.hasClass("play")) {
    //         owl.trigger("play.owl.autoplay", [3000]);
    //         $this.removeClass("play").addClass("stop");
    //         $("#pause-button").show();
    //         $("#play-button").hide();
    //     } else {
    //         owl.trigger("stop.owl.autoplay");
    //         $this.removeClass("stop").addClass("play");
    //         $("#pause-button").hide();
    //         $("#play-button").show();
    //     }
    // });

    $(".main_section3__place_btn").on("click", function () {
        $(".main_section3__place_btn").removeClass("active");
        $(this).addClass("active");

        var listNumber = $(this).data("list");

        $(".best_list").addClass("hidden");

        $(".best_list_" + listNumber).removeClass("hidden");
    });

    $(".main_section3__type_btn").on("click", function () {
        $(".main_section3__type_btn").removeClass("active");
        $(this).addClass("active");
    });

    //$(".words_list_item").on("click", function (event) {
    //  event.preventDefault();

//    $(".words_list_item").removeClass("active");

    //  $(this).addClass("active");
    //});

    $(".place_item_golf").on("click", function (event) {
        event.preventDefault();
        $(".place_item_golf").removeClass("active");
        $(this).addClass("active");
    });

    $(".place_item_hotel").on("click", function (event) {
        event.preventDefault();
        $(".place_item_hotel").removeClass("active");
        $(this).addClass("active");
    });

});

const swiper1 = new Swiper(".main_swiper2", {
    loop: true,
    breakpoints: {
        851: {
            slidesPerView: 5,
            pagination: false,
        },
    },
    slidesPerView: 2,
    pagination: false,
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
    breakpoints: {
        851: {
            slidesPerView: 4,
        },
    },
    slidesPerView: 2,
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
    breakpoints: {
        851: {
            slidesPerView: 4,
        },
    },
    slidesPerView: 2,
    spaceBetween: 20,
    pagination: {
        el: ".hot_product_list_swiper_pagination_2",
        clickable: true,
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
    breakpoints: {
        851: {
            slidesPerView: 4,
            pagination: false,
        },
    },
    slidesPerView: 2,
    spaceBetween: 20,
    navigation: {
        nextEl: ".review__list_swiper_btn_next",
        prevEl: ".review__list_swiper_btn_prev",
    },
});

const swiper5 = new Swiper(".magazine_swiper", {
    loop: true,
    breakpoints: {
        851: {
            slidesPerView: 5,
            pagination: false,
        },
    },
    slidesPerView: 2,
    spaceBetween: 20,
    pagination: {
        el: ".magazine_swiper__pagination",
    },
});
