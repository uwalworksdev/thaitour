// 사업영역 초순수/순수, 용수처리, 하폐수/재이용, 해수담수화
$(document).ready(function () {
  gsap.to(".parallaxWrap .innerBox", {
    scrollTrigger: {
      trigger: ".parallaxWrap .innerBox",
      start: "center 50%",
      end: "300% 100%",
      pin: true,
      pinSpacing: false,
      anticipatePin: 1,
      scrub: 1,
    },
  });

  // parallaxWrap timeline
  const parallaxWrap = gsap.timeline({
    scrollTrigger: {
      trigger: ".parallaxWrap .innerBox",
      start: "top 50%",
      end: "+=200%",
      scrub: 1,
    },
  });
  parallaxWrap.set(".parallaxWrap .parallaxInner", {
    className: "parallaxInner parallaxList active"
  }, "+=0.1")
  parallaxWrap.to(".parallaxWrap .parallax_bg img.parallax_bg01", {
    filter: "brightness(.2)"
  })
  parallaxWrap.to(".parallaxWrap .textBox1", {
    opacity: "1",
    top: "50%",
    delay: 1,
    duration: 1
  })
  parallaxWrap.to(".parallaxWrap .textBox1", {
    opacity: "0",
    top: "40%",
    delay: 1,
    duration: 1
  })
  parallaxWrap.to(".parallaxWrap .parallax_bg img.parallax_bg02", {
    opacity: "1"
  })
  parallaxWrap.to(".parallaxWrap .textBox2", {
    opacity: "1",
    top: "50%",
    delay: 1,
    duration: 1
  })
  parallaxWrap.to(".parallaxWrap .textBox2", {
    opacity: "0",
    top: "40%",
    delay: 1,
    duration: 1
  })
  parallaxWrap.to(".parallaxWrap .parallax_bg img.parallax_bg03", {
    opacity: "1"
  })
  parallaxWrap.to(".parallaxWrap .textBox3", {
    opacity: "1",
    top: "50%",
    delay: 1,
    duration: 1
  })

});