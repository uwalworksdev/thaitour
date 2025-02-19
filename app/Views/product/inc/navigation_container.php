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
             src="/uploads/icons/ball_dot_icon.png"
             alt="ball_dot_icon">
        <img class="bread_arrow_right" src="/uploads/icons/bread_arrow_right.png" alt="bread_arrow_right">
        <span class="font-bold"><?= $code_name ?></span>

        <div class="depth_2_tools_" id="depth_2_tools_">
            <ul class="depth_2_tool_list_" id="depth_2_tool_list_">
                <?php echo getHeaderTabSubChild($parent_code, $code_no); ?>
            </ul>
        </div>
    </div>
	
    <div class="navigation-container-next">
        <img class="ball_dot_icon icon_open_depth_01 icon_open_depth_" data-depth="depth_1_tools_"
             src="/uploads/icons/ball_dot_icon.png"
             alt="ball_dot_icon">
        <img class="bread_arrow_right" src="/uploads/icons/bread_arrow_right.png" alt="bread_arrow_right">
        <span class="font-bold">xxxxxxxxx</span>

        <div class="depth_3_tools_" id="depth_3_tools_">
            <ul class="depth_3_tool_list_" id="depth_3_tool_list_">
                <?php //echo getHeaderTabSubChild($parent_code, $code_no); ?>
            </ul>
        </div>
    </div>
	
    <div class="navigation-container-next">
        <img class="ball_dot_icon icon_open_depth_02 icon_open_depth_" data-depth="depth_2_tools_"
             src="/uploads/icons/ball_dot_icon.png"
             alt="ball_dot_icon">
    </div>
</div>
<script>
    $(document).ready(function () {
        $('.icon_open_depth_').click(function () {
            let depth = $(this).data("depth");
            $('#' + depth).toggleClass('active_');
        })

        let name = $('.depth_1_item_.active_').text();
        $('#depth_1_tool_title_').text(name);

        $('.depth_1_item_').click(function () {
            let code = $(this).data("code");
            let href = $(this).data("href");
            let name = $(this).text();

            $('#depth_1_tool_title_').text(name);
            // getCodeDepth(code);

            $('.depth_1_item_').removeClass('active_');
            $(this).addClass('active_');
            $('#depth_1_tools_').removeClass('active_');

            window.location.href = href;
        })

        $(window).on('click', function (event) {
            let depth_1_tools_ = $('#depth_1_tools_');
            let icon_open_depth_01 = $('.icon_open_depth_01');
            let icon_open_depth_02 = $('.icon_open_depth_02');

            if (depth_1_tools_.is(event.target) || depth_1_tools_.has(event.target).length > 0 || icon_open_depth_01.is(event.target) || icon_open_depth_01.has(event.target).length > 0) {
                depth_1_tools_.addClass('active_');
            } else {
                depth_1_tools_.removeClass('active_');
            }

            let depth_2_tools_ = $('#depth_2_tools_');

            if (depth_2_tools_.is(event.target) || depth_2_tools_.has(event.target).length > 0 || icon_open_depth_02.is(event.target) || icon_open_depth_02.has(event.target).length > 0) {
                depth_2_tools_.addClass('active_');
            } else {
                depth_2_tools_.removeClass('active_');
            }
        });


        async function getCodeDepth(code) {
            let apiUrl = `<?= route_to('api.hotel_.get_code') ?>?code=${code}`;
            try {
                let response = await fetch(apiUrl);
                if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);

                let res = await response.json();
                renderDepthCode(res.data.data);
            } catch (error) {
                console.error('Error fetching hotel data:', error);
            }
        }

        function renderDepthCode(data) {
            let html = "";
            for (let i = 0; i < data.length; i++) {
                html += `<li class="depth_2_item_" data-code="${data[i].code_no}">
                                        <a href="${data[i].link_ ?? '#'}">${data[i].code_name}</a>
                                    </li>`;
            }

            $('#depth_2_tool_list_').html(html);
        }
    })
</script>