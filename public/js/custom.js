$(document).on("ready", function () {
  // popup function
  

  $('*[data-bs-dismiss*="pop"]').on("click", function () {
    $("body").removeClass("popup-open");
    let target = $(this).data("bs-dismiss");
    $("#" + target).hide();
    console.log("first");
  });

  $('*[data-open*="popup"]').on("click", function () {
    $("body").addClass("popup-open");


    let target = $(this).data("open");
    $("#" + target).show();
    console.log(target);
    
  });
});
function ParentDelete(el) {
  $(el).on("click", function () {
    $(this).parent().remove();
  });
}
function nextToggleClass(el) {
  $(el).on("click", function () {
    $(this).next().toggleClass('active');
  });
}
function ClickaddRemove(el, addF) {
    $(el).on("click", function (e) {
      if($(this).attr('href="#!"') == true){
          e.preventDefault();

      }
    $(this).addClass("active").siblings().removeClass("active");
    addF;
  });
}
function addRemove(el) {
  $(el).addClass("active").siblings().removeClass("active");
}

function tabMenuActive(el, functionName, href) {
  $(el).on(functionName, function (e) {
    e.preventDefault();
    let target = $(this).attr(href);
    addRemove(this);
    addRemove(target);
    console.log(target);
  });
}
setScreenSize();
window.addEventListener("resize", setScreenSize);

function setScreenSize() {
  let vh = window.innerHeight * 0.01;
  document.documentElement.style.setProperty("--vh", `${vh}px`);
}

function targetScroll(el) {
  let target = $(el).attr("href");
  let targetT = $(target).offset().top;
  $("body, html").animate({ scrollTop: targetT }, 500);
}
