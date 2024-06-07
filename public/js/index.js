$(function () {
  Main.init();
});

var Main = {
  init:function (e) {
    Main.mainVisualF('img', 8);
    Main.businessF();
    Main.esgF();
  },
  mainVisualF:function(type, speed) {
      var $controllerBtn = $(".controller-btn").find("a");
      var visualSwiper = new Swiper('.main_visual_slider', {
          effect: 'fade',
          loop: true,
          speed: 1000,
          simulateTouch: false,
          touchRatio: 0,
          pagination: {
              el: '.main_visual_slider .pagination',
              clickable: true,
              renderBullet: function (index, className) {
                  return '<div class="' + className + '"><span class="rail"></span><span class="fill"></span></div>';
              }
          },
          on: {
              init: function() {
                  txtMotion();
              },
              slideChangeTransitionStart: function(){
                  progressPagination();
                  // 이미지 슬라이드일 경우 모션 추가
                  if(type == 'img'){
                      scaleDownBgImage();
                  }
              },
              slideChangeTransitionEnd: function(){
                  txtMotion();
              }
          }
      });
      
      // 텍스트
      function txtMotion(){
          $('.main_visual .swiper-slide').removeClass("active");
          $('.main_visual .swiper-slide-active').addClass("active");
      };

      // 프로그래스 바
      // 영상일 경우 해당 영상 길이에 맞게 진행
      var progressTimeline;
      function progressPagination(){
          var parent = $('.main_visual_slider'),
              bullet = parent.find('.swiper-pagination-bullet').find('.fill'),
              activeBullet = parent.find('.swiper-pagination-bullet-active').find('.fill'),
              activeBefore = parent.find('.swiper-pagination-bullet-active').prevAll().find('.fill');

          if(progressTimeline){
              progressTimeline.kill();
          }
          setTimeout(function() {
              var video = parent.find('.swiper-slide').find('video'),
                  activeVideo = parent.find('.swiper-slide-active').find('video'),
                  initVideo = activeVideo.length == 0 ? $(".swiper-slide").eq(0).find("video") : activeVideo,
                  duration,
                  initBullet = activeBullet.length == 0 ? parent.find('.swiper-pagination-bullet').eq(0).find('.fill') : activeBullet;
              
              // 이미지 슬라이드일 경우 속도 조절
              if(type == 'img'){
                  duration = speed;
              } else if(type == 'video'){
                  duration = parseInt(initVideo.get(0).duration) - 0.05;
                  video.trigger('pause');
                  initVideo.get(0).currentTime = 0;
                  
                  if($controllerBtn.attr('data-play') == 'pause'){
                      initVideo.trigger('pause');
                  } else{
                      initVideo.trigger('play');
                  }
              }

              bullet.css({"transform":"translateX(-101%)"});
              activeBefore.css({"transform":"translateX(0)"});
              progressTimeline = gsap.timeline()
              .fromTo(initBullet, duration , {
                  x:"-101%"
              },{
                  x: '0%', 
                  ease: "none",
                  onComplete: function(){
                      // progress 완료 시점
                      // data 값이 play 면 다음으로 넘겨주고 ,stop 이면 video pause
                      if ($controllerBtn.attr('data-play') == 'play'){
                          visualSwiper.slideNext(1000);
                      } else{
                          // 영상 타입일 경우에만 비디오 정지
                      }
                  }
              });
              if($controllerBtn.attr('data-play') == 'pause'){
                  progressTimeline.pause();
              }
          }, 10);
      };

      // 재생 일시정지 버튼
      $controllerBtn.on("click", function(){
          if($(this).attr('data-play') == 'pause'){
              controllor('play');
          } else{
              controllor('pause');
          }
      });

      // 재생 / 일시정지
      function controllor(toggle){
          if (toggle == 'play'){
              $controllerBtn.removeClass('play').addClass('pause');
              $controllerBtn.attr('data-play', 'play');
              progressTimeline.play();
              if(type == 'video'){
                  $('.main_visual_slider').find('.swiper-slide-active').find('video').trigger('play');
              }
              
              // progress가 완료가 된상태에 클릭했을때 pause 면
              if(progressTimeline.progress() == 1){
                  visualSwiper.slideNext(1000);
              }
             
          } else if(toggle == 'pause'){
              $controllerBtn.removeClass('pause').addClass('play');
              $controllerBtn.attr('data-play', 'pause');
              progressTimeline.pause();
              if(type == 'video'){
                  $('.main_visual_slider').find('.swiper-slide-active').find('video').trigger('pause');
              }
          }
      }

      // 이미지 스케일 효과
      function scaleDownBgImage(){
          gsap.fromTo($('.main_visual .swiper-slide-active .bg'), speed,{
              scale:1.2, 
              rotation: 0.1
          }, {
              scale: 1,
              rotation: 0.1, 
          });
      };
  },
  businessF: function () {
    gsap.registerPlugin(ScrollTrigger);

    const cards = document.querySelectorAll('.card');
    const header = document.querySelector('.tabWrap');
    const animation = gsap.timeline();
    let cardHeight;

    function initCards() {
      animation.clear();
      cardHeight = cards[0].offsetHeight;

      cards.forEach((card, index) => {
        if (index > 0) {
          gsap.set(card, {
            y: index * cardHeight,
            scale: 1.2
          });
          animation.to(card, {
            y: 0,
            scale: 1,
            duration: index * 0.5,
            ease: "none"
          }, 0);
        }
      });
    }

    initCards();

    ScrollTrigger.create({
      trigger: ".scrollWrap",
      start: "top top",
      pin: true,
      end: () => `+=${(cards.length * cardHeight) + header.offsetHeight}`,
      scrub: true,
      animation: animation,
      invalidateOnRefresh: true
    });

    ScrollTrigger.addEventListener("refreshInit", initCards);
  },
  esgF: function () {
    var deviceWidth = $(window).width();
    var esgSwiper = undefined;

    function initSwiper() {
      if (deviceWidth < 850 && esgSwiper == undefined) {
        esgSwiper = new Swiper(".esg_slider", {
          slidesPerView: 'auto',
          spaceBetween: 20,
          centerMode: true,
          simulateTouch: true,
          loop: true,
          autoplay: {
            delay: 6000,
            disableOnInteraction: false,
          },
        });
      } else if (deviceWidth >= 850 && esgSwiper != undefined) {
        esgSwiper.destroy();
        esgSwiper = undefined;
      }
    }

    initSwiper();

    $(window).on('resize', function () {
      deviceWidth = $(window).width();
      initSwiper();
    });
  },
};