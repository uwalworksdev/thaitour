<div class="sub-hotel-navigation-container">
    <div class="navigation-container-prev">
        <img class="icon_home" src="/uploads/icons/icon_home.png" alt="icon_home">
        <img class="bread_arrow_right" src="/uploads/icons/bread_arrow_right.png" alt="bread_arrow_right">
        <span id="depth_1_tool_title_">호텔</span>

        <div class="depth_1_tools_" id="depth_1_tools_">
            <ul class="depth_1_tool_list_" id="depth_1_tool_list_">
                <?php echo getHeaderTabSub($parent_code); ?>
            </ul>
        </div>
    </div>

    <div class="navigation-container-next">
        <img class="ball_dot_icon icon_open_depth_01 icon_open_depth_" data-depth="depth_1_tools_"
             src="/uploads/icons/ball_dot_icon.png" alt="ball_dot_icon">
        <img class="bread_arrow_right" src="/uploads/icons/bread_arrow_right.png" alt="bread_arrow_right">
        <span class="font-bold" id="depth_2_label"><?= $code_name ?></span>

        <div class="depth_2_tools_" id="depth_2_tools_">
            <ul class="depth_2_tool_list_" id="depth_2_tool_list_">
                <?php echo getHeaderTabSubChild($parent_code, $code_no); ?>
            </ul>
        </div>

        <!-- <div class="depth_3_tools_" id="depth_3_tools_">
            <ul class="depth_3_tool_list_" id="depth_3_tool_list_"></ul>
        </div> -->
    </div>

    <div class="navigation-container-next navigation_depth_02">
        <img class="ball_dot_icon icon_open_depth_02 icon_open_depth_" data-depth="depth_2_tools_"
             src="/uploads/icons/ball_dot_icon.png" alt="ball_dot_icon">
        <img class="bread_arrow_right" src="/uploads/icons/bread_arrow_right.png" alt="bread_arrow_right">
        
        <span class="font-bold" id="depth_3_label"><?=$code_first_name?></span>
        
        <div class="depth_3_tools_" id="depth_3_tools_">
            <ul class="depth_3_tool_list_" id="depth_3_tool_list_">
			    전체
                <?php echo getHeaderTabSubChild2($parent_code, $code_no, $child_code_first); ?>
            </ul>
        </div>
    </div>
    <div class="navigation-container-next">
        <img class="ball_dot_icon icon_open_depth_03 icon_open_depth_" data-depth="depth_3_tools_"
             src="/uploads/icons/ball_dot_icon.png" alt="ball_dot_icon">
    </div>
</div>

<?php
   if(substr($code_no, 0,4) == "1303") $code_name = "호텔"; 
   if(substr($code_no, 0,4) == "1302") $code_name = "골프"; 
   if(substr($code_no, 0,4) == "1301") $code_name = "투어"; 
?>

<!-- <div class="selected-path">
    현재 위치: <span id="path_1"><?=$code_name?></span> > <span id="path_2"></span> > <span id="path_3"></span>
</div> -->

<script>
$(document).ready(function () {
    $('.icon_open_depth_').on('click', function (e) {
        e.stopPropagation();
        let depth = $(this).data("depth");
        $('#' + depth).toggleClass('active_');
    });

    let name = $('.depth_1_item_.active_').text();
    $('#depth_1_tool_title_').text(name);

    $('.depth_1_item_').on('click', function () {
        let code = $(this).data("code");
        let href = $(this).data("href");
        let name = $(this).text();

        $('#depth_1_tool_title_').text(name);
        $('#path_1').text(name);

        $('.depth_1_item_').removeClass('active_');
        $(this).addClass('active_');
        $('#depth_1_tools_').removeClass('active_');

        window.location.href = href;
    });

    // 외부 클릭 시 각 드롭다운 닫기
    $(document).on('click', function (event) {
        const targets = ['#depth_1_tools_', '#depth_2_tools_', '#depth_3_tools_'];
        const triggers = ['.icon_open_depth_01', '.icon_open_depth_02', '.icon_open_depth_03'];

        targets.forEach((id, idx) => {
            const $target = $(id);
            const $trigger = $(triggers[idx]);

            if (!$(event.target).closest(id).length && !$(event.target).closest(triggers[idx]).length) {
                $target.removeClass('active_');
            }
        });
    });

    // ✅ 2Depth 클릭 → 3Depth Ajax 로드
    $(document).on('click', '.depth_2_item_', function (e) {
        e.stopPropagation();
        let code = $(this).data("code");
        let name = $(this).text();

        $('#path_2').text(name);

        $('.depth_2_item_').removeClass('active_');
        $(this).addClass('active_');
        
        // getCodeDepth3(code, 'show');
    });

    // ✅ 3Depth Ajax 요청
    async function getCodeDepth3(code, status) {
        let apiUrl = `<?= route_to('api.hotel_.get_code') ?>?code=${code}`;
        try {
            let response = await fetch(apiUrl);
            if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);

            let res = await response.json();
            renderDepthCode3(res.data.data, status);
        } catch (error) {
            console.error('Error fetching depth 3 data:', error);
        }
    }

    function renderDepthCode3(data, status) {
        let html = "";
        $("#depth_3_label").text("지역전체");
        html += `<li class="depth_3_item_">
                    <a href="#">지역전체</a>
                </li>`;
        let labelWidth = $("#depth_3_label").outerWidth(true);
        $("#depth_3_tool_list_").css("width", Number(labelWidth) + 100);

        for (let i = 0; i < data.length; i++) {
            html += `<li class="depth_3_item_" data-code="${data[i].code_no}">
                        <a href="${data[i].link_ ?? '#'}">${data[i].code_name}</a>
                     </li>`;
        }

        $('#depth_3_tool_list_').html(html);
        if(status == 'show'){
            $('#depth_3_tools_').addClass('active_');
        }else{
            $('#depth_3_tools_').removeClass('active_');
        }

    }

    // ✅ 3Depth 클릭 시 active 표시 + 경로 + 이동
    // $(document).on('click', '.depth_3_item_', function () {
    //     $('.depth_3_item_').removeClass('active_');
    //     $(this).addClass('active_');

    //     let code = $(this).data("code");
    //     let name = $(this).text();
    //     $('#depth_3_label').text(name);
    //     $('#depth_3_tools_').addClass('active_');

    //     let href = $(this).find('a').attr('href');
    //     if (href && href !== '#') {
    //         window.location.href = href + `?depth3=${code}`;
    //     }
    // });
});
</script>
