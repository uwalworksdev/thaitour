<?php $this->extend('inc/layout_index'); ?>

<?php $this->section('content'); ?>

<?php
    $id = session()->get('member')['id'];
?>

<link href="/css/community/community.css" rel="stylesheet" type="text/css" />
<link href="/css/community/community_responsive.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="/css/magazines/magazines.css">
<link rel="stylesheet" href="/css/time_sale/time_sale_responsive.css">

<main id="container" class="sub magazines_page_">
    <div class="inner magazines_area_">
        <div class="magazines_breadcrumb_">
            <ul class="breadcrumb_">
                <li class="breadcrumb_item_">
                    <a href="#">
                        <img class="home_icon_ only_w" src="/images/ico/home_icon_14_12.png" alt="">
                        <img class="home_icon_ only_m" src="/images/ico/home_icon_14_12_mo.png" alt="">
                    </a>
                </li>
                <li class="breadcrumb_item_">
                    <img class="home_icon_ only_w" src="/images/ico/navi_icon_7_14.png" alt="">
                    <img class="home_icon_ only_m" src="/images/ico/navi_icon_7_14_mo.png" alt="">
                </li>
                <li class="breadcrumb_item_">
                    <a href="#">
                        <span>타임세일</span>
                        <img class="circle_direct_ only_w" src="/images/ico/circle_direct_18_18.png" alt="">
                        <img class="circle_direct_ only_m" src="/images/ico/circle_direct_18_18_mo.png" alt="">
                    </a>
                </li>
            </ul>
        </div>

        <div class="magazines_list_">
            <div class="magazines_list__top_">
                <div class="magazines_list__top_left_">
                    <div class="total_">
                        총 상품
                        <span class="count_"><?=$nTotalCount?></span>
                    </div>
                </div>

                <form name="frmSearch" id="frmSearch" method="GET">
                    <div class="magazines_list__top_right_">
                        <div class="form_el_">
                            <select name="search_category" id="search_mode_" class="select_sort_">
                                <option value="subject" <?php if($search_mode == "subject"){ echo "selected"; }?>>제목</option>
                            </select>
                        </div>
                        <div class="form_el_">
                            <input type="text" class="input_search_" name="search_word" id="search_word_"
                                value="<?=$search_word?>"
                                placeholder="검색어를 입력해 주세요">
                            <div class="icon_">
                                <img role="button" src="/images/ico/icon_search_23_22.png" alt="" onclick="search_it()" class="icon_search_" id="icon_search_">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <script>
                function search_it() {
                    let frm = document.frmSearch;
                    // if(frm.search_word.value == ""){
                    //     alert("검색하고 싶은 단어를 입력해주세요.");
                    //     return false;
                    // }
                    frm.submit();
                }

                $('#search_word_').on('keydown', function (event) {
                    if (event.key === 'Enter') {
                        search_it();
                    }
                });
                
            </script>
            <div class="time_sale_list">
                <?php
                    $daysInKorean = [
                        1 => '월',
                        2 => '화',
                        3 => '수',
                        4 => '목',
                        5 => '금',
                        6 => '토',
                        7 => '일' 
                    ];
                    foreach($rows as $row){
                        $date = date("Y-m-d", strtotime($row["r_date"]));
                        $dayOfWeek = date('N', strtotime($date));

                        if($row["category"] == 126){
                            $status = "expired";
                        }else if($row["category"] == 127){
                            $status = "live";
                        }else{
                            $status = "progress";
                        }
                        
                        $url = "#";

                        if(!empty($row["url"])){
                            $url = $row["url"];
                        }

                        if(!empty($row["ufile1"])){
                            $img = "/data/bbs/" . $row["ufile1"];
                        }else{
                            $img = "";
                        }
                ?>
                    <div class="time_sale_child" id="time_sale_child_<?=$row["bbs_idx"]?>">
                        <a href="<?=$url?>">
                            <div class="time_sale_img" 
                                    data-img="<?=$img?>"
                                    data-rfile="<?=$row["rfile1"]?>"
                                    data-status="<?=$status?>"
                                    data-status_name="<?=$row["status_name"]?>"
                                    data-category="<?=$row["category"]?>">
                                <img src="<?=$img?>" alt="<?=$row["rfile1"]?>">
                                <div class="time_status <?=$status?>">
                                    <i></i>
                                    <span><?=$row["status_name"]?></span>
                                </div>
                                <?php
                                    if($row["category"] == 126 || $row["category"] == 127){
                                ?>
                                    <div class="coating"></div>
                                <?php
                                    }
                                ?>
                            </div>
                        </a>
                        <a href="<?=$url?>"><h4 class="ttl" data-subject="<?=$row["subject"]?>"><?=$row["subject"]?></h4></a>
                        <div class="tools">
                            <p class="date" data-date="<?=$date?>" data-day="<?=$daysInKorean[$dayOfWeek]?>"><?=$date?>(<?=$daysInKorean[$dayOfWeek]?>)</p>
                            <div class="tools_list">
                                <div class="tools_el like" data-like="0">
                                    <i style="cursor: pointer;"></i>
                                    <span>0</span>
                                </div>
                                <div class="tools_el view" data-view="<?=$row["hit"]?>">
                                    <i></i>
                                    <span><?=$row["hit"]?></span>
                                </div>
                                <div class="tools_el comment" data-comment="0">
                                    <i style="cursor: pointer;" onclick="showPopup(<?=$row['bbs_idx']?>)"></i>
                                    <span><?=$row["comment_cnt"]?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                    }
                ?>
                </div>
            <?php 
                echo ipagelistingSub($pg, $nPage, $g_list_rows, current_url() . "?search_mode=". $search_mode ."&search_word=". $search_word ."&pg=")
            ?>
        </div>
    </div>
</main>

<div class="popup_wrap comment_pop" data-bbs_idx="">
    <div class="pop_box_comment">
        <button type="button" class="close" onclick="closePopup()"></button>
        <div class="pop_body">
            <div class="padding">
                <div class="comment_detail_top">
                    <div class="comment_detail_img">
                        <img src="/images/time_sale/popup_time_sale.png" alt="popup_time_sale">
                    </div>
                    <div class="comment_content">
                        <h4 class="ttl_pop">클리닉 웰니스 스파 -시암 스퀘어 원 로얄 타이 마사지 90분 20% 할인</h4>
                        <p class="status">상태: <span class="red">타임세일 준비중</span></p>
                        <p class="date">2024-12-09(월)</p>
                        <div class="tools_list">
                            <div class="tools_el like">
                                <i></i>
                                <span>0</span>
                            </div>
                            <div class="tools_el view">
                                <i></i>
                                <span>0</span>
                            </div>
                            <div class="tools_el comment">
                                <i></i>
                                <span>0</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="comment_detail_wrap">
                    <div class="comment_total">
                        댓글 <span class="total">(2)</span>
                    </div>
                    <div class="comment_write">
                        <textarea placeholder="로그인해서 댓글을 입력해주세요"></textarea>
                        <span class="line"></span>
                        <button class="btn_comment" onclick="fn_comment('<?=$id?>', this)">글쓰기</button>
                    </div>
                </div>
                <div class="comment_list">
                    <div class="comment_el">
                        <div class="comment_wrap">
                            <div class="info">
                                <div class="left">
                                    <span class="user">woras******</span>
                                    <span class="date">2024.08.09 18:30</span>
                                    <!-- <div class="setting">
                                        <button type="button" class="btn_delete">삭제</button>
                                        <button type="button" class="btn_edit">수정</button>
                                    </div> -->
                                </div>
                                <button type="button" class="btn_reply">답변</button>
                            </div>
                            <div class="content">6월도 예약 가능합니다.</div>

                            <div class="comment_edit" style="display: none;">
                                <div class="comment_write">
                                    <textarea placeholder="로그인해서 댓글을 입력해주세요"></textarea>
                                    <span class="line"></span>
                                    <button class="btn_comment">글쓰기</button>
                                </div>
                            </div>

                            <div class="comment_reply_write" style="display: none;">
                                <i class="ico_reply_arrow"></i>
                                <div class="comment_write">
                                    <textarea placeholder="로그인해서 댓글을 입력해주세요"></textarea>
                                    <span class="line"></span>
                                    <button class="btn_comment">글쓰기</button>
                                </div>
                            </div>

                            <div class="comment_wrap comment_reply_wrap" style="padding-left: 30px;">
                                <i class="ico_reply"></i>
                                <div class="info">
                                    <div class="left">
                                        <span class="user">craz******</span>
                                        <span class="date">2024.08.09 20:20</span>
                                        <div class="setting">
                                            <button type="button" class="btn_delete">삭제</button>
                                            <button type="button" class="btn_edit">수정</button>
                                        </div>
                                    </div>
                                    <button type="button" class="btn_reply">답변</button>
                                </div>
                                <div class="content">6월 예약하고 싶은데 6월은 안되나요?</div>

                                <div class="comment_edit" style="display: none;">
                                    <div class="comment_write">
                                        <textarea placeholder="로그인해서 댓글을 입력해주세요"></textarea>
                                        <span class="line"></span>
                                        <button class="btn_comment">글쓰기</button>
                                    </div>
                                </div>

                                <div class="comment_reply_write" style="display: none;">
                                    <i class="ico_reply_arrow"></i>
                                    <div class="comment_write">
                                        <textarea placeholder="@craz****** :"></textarea>
                                        <span class="line"></span>
                                        <button class="btn_comment">글쓰기</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="dim"></div>
</div>
<script>
    
</script>

<script>
    function showPopup(bbs_idx) {

        $(".comment_pop").attr("data-bbs_idx", bbs_idx);

        let img = $("#time_sale_child_" + bbs_idx).find(".time_sale_img").data("img");
        let rfile = $("#time_sale_child_" + bbs_idx).find(".time_sale_img").data("rfile");
        let status = $("#time_sale_child_" + bbs_idx).find(".time_sale_img").data("status");
        let status_name = $("#time_sale_child_" + bbs_idx).find(".time_sale_img").data("status_name");
        let category = $("#time_sale_child_" + bbs_idx).find(".time_sale_img").data("category");
        let subject = $("#time_sale_child_" + bbs_idx).find(".ttl").data("subject");
        let date = $("#time_sale_child_" + bbs_idx).find(".tools .date").data("date");
        let day = $("#time_sale_child_" + bbs_idx).find(".tools .date").data("day");
        let like_cnt = $("#time_sale_child_" + bbs_idx).find(".tools .tools_list .like").data("like");
        let view_cnt = $("#time_sale_child_" + bbs_idx).find(".tools .tools_list .view").data("view");
        let comment_cnt = $("#time_sale_child_" + bbs_idx).find(".tools .tools_list .comment").data("comment");

        $(".comment_pop .comment_detail_img img").attr("src", img);
        $(".comment_pop .comment_detail_img img").attr("alt", rfile);
        $(".comment_pop .comment_content .ttl_pop").text(subject);
        $(".comment_pop .comment_content .status").html(`상태: <span class="${status}">${status_name}</span>`);
        $(".comment_pop .comment_content .date").text(`${date}(${day})`);
        $(".comment_pop .comment_content .tools_list .like span").text(like_cnt);
        $(".comment_pop .comment_content .tools_list .view span").text(view_cnt);
        $(".comment_pop .comment_content .tools_list .comment span").text(comment_cnt);

        fn_comment_list(bbs_idx);

        $(".comment_pop").show();
    }

    function closePopup() {
        $(".comment_pop").hide();
    }

    function handleReplyComment(el, idx){
        const reply_area = $(el).closest(".comment_wrap").children(".comment_reply_write");
        if(reply_area.css("display") == "none"){
            reply_area.css("display", "flex");
        }else{
            reply_area.css("display", "none");
        }
    }

    function handleCmtEdit(el, idx){
        const edit_area = $(el).closest(".comment_wrap").children(".comment_edit");
        const comment_area = $(el).closest(".comment_wrap").children(".content");
        console.log(comment_area.text());
        
        if(edit_area.css("display") == "none"){
            edit_area.children(".comment_write").find("textarea").text(comment_area.text());
            comment_area.hide();
            edit_area.css("display", "block");
        }else{
            comment_area.show();
            edit_area.children(".comment_write").find("textarea").text("");
            edit_area.css("display", "none");
        }
    }

    function handleCmtDelete(el, idx, bbs_idx) {
        if (confirm("삭제하시겠습니까?") == false) {
            return;
        }

        $.ajax({
            url: "/comment/cmtDel",
            data: { r_cmt_idx: idx },
            dataType: "JSON",
            type: "POST",
            cache: false,
            error: function (req, status, err) {
                alert("CODE: " + req.status + "\r\nmessage: " + req.responseTxt + "\r\nerror: " + err);
                return;
            },
            success: function (res, status, req) {
                alert(res.msg)
                if (res.result == 'OK') {
                    fn_comment_list(bbs_idx);
                } else {
                    return;
                }
            }
        })
    }

    function fn_comment(m_idx, el) {
        let r_idx = $(".comment_pop").attr("data-bbs_idx");
        let r_content = $(el).closest(".comment_write").find("textarea").val();        

        if (m_idx) {
            if ($(el).closest(".comment_write").find("textarea").val() == "") {
                alert("댓글을 입력해주세요.");
                return;
            }

            $.ajax({
                type: "POST",
                url: "/comment/comment",
                data: {
                    "r_code": "time_sale",
                    "r_idx": r_idx,
                    "comment": r_content
                },
                cache: false,
                success: function (ret) {
                    if (ret.trim() == "OK") {
                        fn_comment_list(r_idx);
                        $(el).closest(".comment_write").find("textarea").val("");
                    } else {
                        alert("등록 오류입니다." + ret);
                    }
                }
            });
        } else {
            alert("로그인을 해주세요.");
        }
    }

    function fn_comment_list(r_idx) {

        $.ajax({
            type: "GET",
            url: "/comment/comment_list",
            data: {
                "r_code": "time_sale",
                "r_idx": r_idx,
            },
            cache: false,
            success: function (ret) {
                $(".comment_pop .comment_list").html(ret);
            }
        });
    }

    function handleReplySubmit(el, idx, r_idx) {
        const comment = $(el).closest(".comment_write").find("textarea").val();  
        const r_level = $(el).closest(".comment_write").find("input").val();
        const frmData = new FormData();
        frmData.append("r_ref", idx);
        frmData.append("r_idx", r_idx);
        frmData.append("r_level", r_level);
        frmData.append("r_content", comment);
        frmData.append("r_code", "time_sale");
        
        $.ajax({
            url: "/comment/cmtRep",
            data: frmData,
            type: "POST",
            dataType: "JSON",
            processData: false,
            contentType: false,
            cache: false,
            error: function (req, status, err) {
                alert("CODE: " + req.status + "\r\nmessage: " + req.responseTxt + "\r\nerror: " + err);
                return;
            },
            success: function (res, status, req) {
                if (res.result == 'OK') {
                    fn_comment_list(r_idx);
                } else {
                    return;
                }
            }
        })
    }

    function handleCmtEditSubmit(el, idx, r_idx) {
        const comment = $(el).closest(".comment_write").find("textarea").val();  
        $.ajax({
            url: "/comment/cmtEdit",
            data: { r_cmt_idx: idx, r_content: comment },
            dataType: "JSON",
            type: "POST",
            cache: false,
            error: function (req, status, err) {
                alert("code: " + req.status + "\r\nmessage: " + req.responseTxt + "\r\nerror: " + err);
                return;
            },
            success: function (res, status, req) {
                if (res.result == 'OK') {
                    fn_comment_list(r_idx);
                } else {
                    return;
                }
            }
        })
    }

</script>
<?php $this->endSection(); ?>