
$(document).ready(function () {
    $(".content .contentMenu > ul > li").click(function () {
        $(".content .contentMenu > ul > li").removeClass("selected")
        $(this).addClass("selected");
    })   
});