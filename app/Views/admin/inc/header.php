<?php
    helper(['gnb', 'setting']);
    $uri = service('uri');
    $currentPath = $uri->getPath();
    $adminGnb = adminGnb();
    $setting = homeSetInfo();
    $createAt = session("create_at");
    $sessionCreateDate = date('Y-m-d H:i:s',$createAt);
?>
<header id="header">
    <div class="header_top">
        <div class="top_box">
            <!-- <a href="" class="logo"><img src="<?//=_IT_LOGOS_ADM?>" alt="로고"></a> -->
            <a href="/" class="txt_admin" target="_blank"></a>
            <a href="/adm/board/license/list" class="logo">
                <img src="<?=!empty($setting['logos']) ? "/uploads/setting/{$setting['logos']}" : null?>" alt=""
                    style="max-width:50px" />
            </a>
        </div>
        <div class="info_box">
            <ul class="connect_info">
                <li><?=!empty($setting['site_name']) ? esc($setting['site_name']) : null?></li>
                <li>IP : <?=$_SERVER['REMOTE_ADDR']?> /</li>
                <li>최근접속일시 : <?=$sessionCreateDate?></li>
            </ul>

            <!-- <a href="/AdmMaster/_adminrator/store_config_admin.php">비밀번호변경</a> -->
            <a href="/adm/member/admin/change">정보수정</a>
            <a class="logout" href="/adm/logout">로그아웃</a>
        </div>
    </div>
    <div id="gnb" class="gnb_update">
        <ul class="gnb_menu">
            <?php foreach($adminGnb AS $gnb){?>
            <li class="menu1 depth1_ttl">
                <a href="javascript:void(0);" class="<?=strpos($currentPath, $gnb['mainUrl']) !== false ? "on" : ""?>">
                    <span class="tit"><?=$gnb['title']?></span>
                </a>
                <?php if(count($gnb['child'])){ ?>
                <ul class="smenu_1 depth2 <?=strpos($currentPath, $gnb['mainUrl']) !== false ? "on" : ""?>">
                    <?php foreach($gnb['child'] AS $gnbChild){?>
                    <li class="<?=strpos($currentPath, $gnbChild['mainUrl']) !== false ? "on" : ""?>">
                        <a href="<?=$gnbChild['link']?>"><?=$gnbChild['title']?></a>
                    </li>
                    <?php } ?>

                </ul>
                <?php } ?>
            </li>
            <?php } ?>
        </ul>
    </div>
</header>

<script>
$(function() {
    $.datepicker.regional['ko'] = {
        showButtonPanel: true,
        beforeShow: function(input) {
            setTimeout(function() {
                var buttonPane = $(input)
                    .datepicker("widget")
                    .find(".ui-datepicker-buttonpane");
                var btn = $(
                    '<BUTTON class="ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all">Clear</BUTTON>'
                );
                btn.unbind("click").bind("click", function() {
                    $.datepicker._clearDate(input);
                });
                btn.appendTo(buttonPane);
            }, 1);
        },
        closeText: '닫기',
        prevText: '이전',
        nextText: '다음',
        monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
        monthNamesShort: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'],
        dayNames: ['일', '월', '화', '수', '목', '금', '토'],
        dayNamesShort: ['일', '월', '화', '수', '목', '금', '토'],
        dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
        weekHeader: 'Wk',
        dateFormat: 'yy-mm-dd',
        firstDay: 0,
        isRTL: false,
        showMonthAfterYear: true,
        changeMonth: true,
        changeYear: true,
        showMonthAfterYear: true,
        closeText: '닫기', // 닫기 버튼 패널
        yearSuffix: ''
    };
    $.datepicker.setDefaults($.datepicker.regional['ko']);

    setTimeout(function() {
        $(".datepicker").datepicker({
            showButtonPanel: true,
            beforeShow: function(input) {
                setTimeout(function() {
                    var buttonPane = $(input)
                        .datepicker("widget")
                        .find(".ui-datepicker-buttonpane");
                    var btn = $(
                        '<BUTTON class="ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all">Clear</BUTTON>'
                    );
                    btn.unbind("click").bind("click", function() {
                        $.datepicker._clearDate(input);
                    });
                    btn.appendTo(buttonPane);
                }, 1);
            },
            dateFormat: 'yy-mm-dd',
            showOn: "both",
            yearRange: "c-100:c+10",
            buttonImage: "/images/admin/common/date.png",
            buttonImageOnly: true,
            closeText: '닫기',
            prevText: '이전',
            nextText: '다음'

        });
        $(".datepicker2").datepicker({
            showButtonPanel: true,
            beforeShow: function(input) {
                setTimeout(function() {
                    var buttonPane = $(input)
                        .datepicker("widget")
                        .find(".ui-datepicker-buttonpane");
                    var btn = $(
                        '<BUTTON class="ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all">Clear</BUTTON>'
                    );
                    btn.unbind("click").bind("click", function() {
                        $.datepicker._clearDate(input);
                    });
                    btn.appendTo(buttonPane);
                }, 1);
            },
            dateFormat: 'yy-mm-dd',
            yearRange: "c-100:c+10",
            closeText: '닫기',
            prevText: '이전',
            nextText: '다음'

        });
        $('img.ui-datepicker-trigger').css({
            'cursor': 'pointer'
        });
        $('input.hasDatepicker').css({
            'cursor': 'pointer'
        });
    }, 100);

});
</script>
<script>
$(document).ready(function() {
    $('.depth1_ttl > a').on('click', function() {
        $(this).next('.depth2').toggleClass('on');
        // $(this).next('.depth2').children('.depth2 li').toggleClass('on');
        $(this).toggleClass('on');

        if ($('.depth2').hasClass('on')) {
            // $('.depth2 li') addClass('on');
            $('.depth2').removeClass('on');
            $('.depth1_ttl > a').removeClass('on');

            $(this).next('.depth2').toggleClass('on');
            $(this).toggleClass('on');
        } else {
            return;
        }
    });
});
</script>