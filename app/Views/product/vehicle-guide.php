<?php $this->extend('inc/layout_index'); ?>

<?php $this->section('content'); ?>
<!-- Moment.js -->
<script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<link rel="stylesheet" type="text/css" href="/css/contents/reservation.css" />

<style>
    .white-icon {
        filter: brightness(0) invert(1);
    }

    .popup_wrap.place_pop.cart_info_pop .pop_box {
        max-width: 1000px;
    }

    .item-info-check .view-policy {
        margin-right: 40px;
    }

    .item-info-check:hover .view-policy {
        background-color: #fff;
    }

    .select-width {
        width: 280px;
    }

    .email-group input {
        width: 230px;
    }

    .ui-state-disabled .ui-state-default {
        color: #ccc;
        pointer-events: none;
        cursor: not-allowed;
    }

    .section_vehicle_2 .tab_list_title_ {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
        margin-bottom: 50px;
    }

    .section_vehicle_2 .tab_list_title_ .tab_title_item_ {
        width: calc(100% / 3);
        padding: 20px;
        background: #f4f4f4;
        color: #898989;
        font-size: 20px;
        border: 1px solid #dbdbdb;
        text-align: center;
        cursor: pointer;
        font-weight: 600;
    }

    .section_vehicle_2 .tab_list_title_ .tab_title_item_.active_ {
        color: #FFFFFF;
        background-color: #17469E;
    }

    .section_vehicle_2 .tab_content_list_ {
        font-family: "Pretendard";
    }

    .section_vehicle_2 .tab_content_list_ .tab_content_item_ {
        display: none;
    }

    .section_vehicle_2 .tab_content_list_ .tab_content_item_.active_ {
        display: block;
    }

    .section_vehicle_2 .tab_content_list_ .review_real .tbl_rate2 {
        width: 100%;
        padding: 20px 0;
        display: flex;
        margin-bottom: 60px;
    }

    .section_vehicle_2 .tab_content_list_ .review_real .eval1 {
        padding-bottom: 10px;
    }

    .section_vehicle_2 .tab_content_list_ .review_real .eval1 li {
        padding: 3px 0;
        text-align: center;
        color: #333;
        width: 170px;
        font-size: 18px;
    }

    .section_vehicle_2 .tab_content_list_ .review_real .eval1 li.avg {
        color: #777;
    }

    .section_vehicle_2 .tab_content_list_ .review_real .eval1 li.avg strong {
        font-size: 40px;
        font-weight: 600;
        color: #17469E;
    }

    .section_vehicle_2 .tab_content_list_ .review_real .eval1 li.avg b {
        font-size: 20px;
        color: #777;
        font-weight: 400;
    }

    .section_vehicle_2 .tab_content_list_ .review_real .tbl_rate2 .rate_box {
        width: 20%;
    }

    .section_vehicle_2 .tab_content_list_ .review_real .tbl_rate2 .totoal_av {
        float: left;
        width: 20%;
        margin-right: 7px;
    }

    .section_vehicle_2 .tab_content_list_ .review_real .tbl_rate2 .totoal_av p,
    .section_vehicle_2 .tab_content_list_ .review_real .tbl_rate2 .totoal_av p {
        border: 0;
        background: 0 0;
        font-size: 13px;
        padding: 10px 0;
        text-align: center;
        color: #222;
    }

    .section_vehicle_2 .tab_content_list_ .review_real .tbl_rate2 .rating_avscore {
        width: 100px;
        padding: 0;
        display: inline-block;
        text-align: center;
        color: #17469E;
        font-size: 30px;
        font-weight: 600;
    }

    .section_vehicle_2 .tab_content_list_ .review_real .tbl_rate2 .rating_avstxt {
        font-size: 16px;
        line-height: 20px;
        display: block;
        background: #eee;
        padding: 11px 10px;
        ;
        font-weight: 500;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center center;
        -webkit-border-radius: .4em;
        -moz-border-radius: .4em;
        border-radius: .4em;
        letter-spacing: -1px;
    }

    #flight_code {
        width: 200px;
    }

    input[name="date_trip[]"] {
        width: 200px !important;
    }

    .tbl_st3 {
        width: 100%;
        border-top: 1px solid #333;
    }

    .tbl_top_wrap .count {
        float: left;
        font-size: 18px;
        margin-bottom: 20px;
    }

    .tbl_top_wrap .count span {
        color: #17469E;
        font-weight: 600;
    }

    .review_real .list .tbl_list td {
        line-height: 20px;
    }

    .ssrvtbl_list td {
        vertical-align: top;
        padding: 25px 0 20px;
    }

    .tbl_st3 td {
        border-bottom: 1px solid #ddd;
    }

    .pl10 {
        padding-left: 10px !important;
    }

    .al {
        text-align: left !important;
        word-wrap: break-word;
    }

    .position {
        position: relative;
    }

    .live_add .ssrv_txt {
        display: inline-block;
        word-break: break-word;
    }

    .ssrvtbl_list .ssrv_txt {
        display: inline-block;
        color: #888;
        width: 100%;
        overflow: hidden;
        min-height: 70px;
        line-height: 1.3;
        margin-bottom: 10px;
    }

    .ssrvtbl_list span.ssrvid {
        font-weight: 400;
        display: block;
    }

    .ssrv_txt .cmt_link,
    .ssrv_txt .cmt_link a,
    .ssrv_txt .cmt_link a:link,
    .ssrv_txt .cmt_link a:hover {
        color: #17469E;
    }

    a.like_btn {
        font-size: 16px;
        background: #fff;
        border: 1px solid #bebebe;
        -webkit-border-radius: .4em;
        -moz-border-radius: .4em;
        border-radius: .4em;
        padding: 6px 10px 6px 30px;
        overflow: hidden;
        line-height: 24px;
        background: url(/images/ico/ic_like01.png);
        background-size: 16px 16px;
        background-repeat: no-repeat;
        background-position-x: 6px;
        background-position-y: 6px;
    }

    a.cmt_btn {
        font-size: 16px;
        background: #fff;
        border: 1px solid #bebebe;
        -webkit-border-radius: .4em;
        -moz-border-radius: .4em;
        border-radius: .4em;
        padding: 6px 10px 6px 30px;
        overflow: hidden;
        line-height: 24px;
        background: url(/images/ico/ic_comment.webp);
        background-size: 16px 16px;
        background-repeat: no-repeat;
        background-position-x: 6px;
        background-position-y: 6px;
        color: #333;
    }

    .ssrv_ratebox {
        align-items: center;
        display: flex;
        flex-direction: column;
    }

    .review_real .list .tbl_list .rate {
        color: #aaa;
    }

    .ac {
        text-align: center !important;
    }

    .review_real .list .tbl_list .rate span {
        color: #333;
    }

    .ssrvtbl_list span.avno1 {
        display: block;
        padding: 5px 0;
        font-size: 30px;
        line-height: 25px;
        font-weight: 600;
        color: #17469E;
    }

    .ssrv_av {
        width: 150px;
        padding-bottom: 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .ssrv_av p:first-child {
        width: 100px;
        text-align: left;
        line-height: 1.2;
    }

    .rate_bar {
        width: 50px;
        height: 10px;
        border: 1px solid #17469E;
        display: block;
        position: relative;
        border-radius: 3px;
    }

    .rate_bar_inner {
        height: 10px;
        background: #17469E;
        display: inline-block;
        top: 0;
        left: 0;
        position: absolute;
    }

    .ssrvtbl_list span.avno {
        font-size: 12px;
        font-weight: 500;
        display: block;
        padding: 2px 0;
        background: #fff;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center center;
        width: 20px;
        -webkit-border-radius: .4em;
        -moz-border-radius: .4em;
        margin: 0 auto;
    }

    .mt10 {
        margin-top: 10px;
    }

    .supplier_list {
        width: 100%;
    }

    .supplier_infobox {
        width: 99%;
        position: relative;
        margin: 0 auto;
        text-transform: capitalize;
        display: flex;
        flex-wrap: wrap;
    }

    .supplier_infobox li {
        width: 49.8%;
        border-bottom: 1px solid #e6e6e6;
        /*float: left;*/
        padding: 15px 0;
    }

    .supplier_infobox li .supplierinfo {
        width: 95%;
        position: relative;
        margin: 10px 0;
        padding: 0 10px;
    }

    .thumb01 {
        display: inline-block;
        float: left;
        width: 100px;
        height: 112px;
        overflow: hidden;
        margin: 0 5px 10px 0;
    }

    .thumb01 img {
        width: 100px;
        height: 112px;
    }

    .thumb02 {
        display: inline-block;
        float: left;
        width: 150px;
        height: 112px;
        overflow: hidden;
        margin: 0 5px 10px 0;
    }

    .thumb02 img {
        width: 150px;
    }

    .ic_mention {
        clear: both;
        width: 100px;
        height: 30px;
        display: inline-block;
        overflow: hidden;
        background: url('/globals/common/img/ic/ic_mention.png') no-repeat;
        vertical-align: middle;
        color: #fb7925;
        text-indent: 25px;
        line-height: 21px;
        position: relative;
        float: left;
    }

    .ic_mention+p {
        float: right;
        position: relative;
        width: 340px;
        height: 32px;
        line-height: 16px;
        right: 10px;
        letter-spacing: -.1px;
        overflow: hidden;
        font-size: 11px;
    }

    .supplier_rate2 {
        position: relative;
        /*float: left;*/
        display: flex;
        width: 100%;
        margin: 10px 0;
        border: 0;
        gap: 10px;
    }

    .supplier_rate2 li {
        border: 0;
        text-align: center;
    }

    .supplier_rate2 dl {
        float: left;
        width: 20%;
        margin-right: 0;
    }

    .supplier_rate2 dl:first-child {
        margin-left: 20px;
    }

    .supplier_rate2 dt,
    .supplier_rate2 dd {
        border: 0;
        background: 0 0;
        font-size: 12px;
        padding: 5px 0 0;
        text-align: center;
        color: #222;
    }

    .supplier_rate2 .eval1 li .rating {
        width: 100px;
        height: 16px;
        background: url(/globals/common/img/spr/ico_star_02.png?v=1) 0 -16px no-repeat;
        position: relative;
        text-align: left;
        margin: 0 auto;
    }

    .supplier_rate2.eval1 li .rating>span {
        position: absolute;
        top: 0;
        left: 0;
        width: 50%;
        height: 15px;
        background: url(/globals/common/img/spr/ico_star_02.png?v=1) 0 0px no-repeat;
        overflow: hidden;
    }

    .supplier_rate2 .rating_avscore {
        width: 100px;
        padding: 0;
        display: inline-block;
        text-align: center;
        color: #17469E;
        font-size: 30px;
        font-weight: 500;
    }

    .supplier_rate2 .rating_avstxt {
        font-size: 12px;
        line-height: 20px;
        display: block;
        background: #eee;
        padding: 3px 5px;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center center;
        -webkit-border-radius: .4em;
        -moz-border-radius: .4em;
        border-radius: .4em;
        letter-spacing: -1px;
    }

    .ssrv_more_btn {
        cursor: pointer;
        float: right;
        padding: 6px 8px;
        font-size: 16px;
        color: #6472a1 !important;
        border: 1px solid #ccd0d8 !important;
        background-color: #f6f6f6;
        line-height: 16px;
    }

    li.total_avscore {
        font-size: 30px;
        font-weight: 500;
        color: #17469E;
        width: 80px;
    }

    .total_avscore span {
        display: inline-block;
        float: left;
        font-weight: 400;
    }

    .totalpoint {
        font-size: 14px;
        color: #777;
        font-weight: 500;
        padding-top: 20px;
    }

    .ssdr_av {
        line-height: 18px;
        text-align: center;
        color: #777;
    }

    .ssdr_av dt,
    .ssdr_av dd {
        font-size: 11px;
        color: #777;
    }

    .ssdr_av_point {
        font-weight: 500;
        display: block;
        background: #eee;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center center;
        -webkit-border-radius: .4em;
        -moz-border-radius: .4em;
        border-radius: .4em;
        width: 70px;
        margin: 10px 0 0 0;
        padding: 7px 0;
    }

    .driver_name {
        width: 180px;
        float: left;
        padding: 0 10px 10px;
        line-height: 15px;
    }

    .driver_name .ic_driver {
        display: block;
        width: 100%;
        text-align: center;
        margin-bottom: 3px;
    }

    .driver_name p {
        color: #17469E;
        width: 135px;
        float: left;
        padding: 3px 0 0;
    }

    .driver_name p {
        float: left;
        width: 45px;
        padding: 3px 0 0;
    }

    .driver_name p span {
        display: block;
        width: 45px;
        min-height: 15px;
    }

    .driver_name dd span {
        display: block;
        width: 135px;
        min-height: 15px;
    }

    .driver_name .ic_driver {
        display: block;
        width: 100%;
        text-align: center;
        margin-bottom: 3px;
    }

    .supplierinfo .thumb03,
    .supplierinfo .thumb02 {
        display: inline-block;
        border-radius: 55px;
        overflow: hidden;
        border: 1px solid #eee;
        float: left;
        width: 100px;
        height: 100px;
        overflow: hidden;
        margin: 0 5px 10px 0;
    }

    .supplierinfo .thumb03 img,
    .supplierinfo .thumb02 img {
        width: 120px;
        height: 100px;
        /*margin-left: -10px;*/
    }

    .supplier_infobox .drv_ssrvlist .ssrv_morelist ul li {
        height: 20px;
        margin-top: 10px;
        background: url(/globals/common/img/bu/bg_sprite_ico.gif) no-repeat 0px -142px;
    }

    .supplier_infobox .drv_ssrvlist .ssrv_morelist {
        clear: left;
        border: 0 dashed #eee;
        background: #fff;
        width: 100%;
        height: 90px;
        -webkit-border-radius: 0;
        -moz-border-radius: 0;
        border-radius: 0;
    }

    .supplier_infobox .drv_ssrvlist {
        clear: left;
        border: 0 dashed #eee;
        background: #fff;
        width: 100%;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center center;
        -webkit-border-radius: 0;
        -moz-border-radius: 0;
        border-radius: 0;
        padding: 10px 0px;
    }

    .supplier_infobox .ssrv_nolist2 {
        clear: left;
        border: 0 dashed #eee;
        background: #fff;
        width: 445px;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center center;
        -webkit-border-radius: 0;
        -moz-border-radius: 0;
        border-radius: 0;
        padding: 66px 15px;
    }

    .supplier_infobox .ssrv_nolist2 p {
        color: #999;
    }

    .supplier_infobox .ssrv_nolist2 i {
        color: #ddd;
        font-size: 40px;
    }

    .supplier_rate2 .rate_box .eval1 li.total_avscore {
        border-bottom: 0;
        font-size: 30px;
        font-weight: 600;
        color: #17469E;
        height: 30px;
        width: 75px;
        padding-top: 10px;
    }

    .f_nilegreen {
        color: #17469E;
    }

    .supplier_rate2 .rate_box {
        margin-bottom: 15px;
    }

    .supplier_rate2 .rate_box .totalpoint {
        padding-top: 15px;
    }

    .carType_info {
        width: 135px;
        text-align: center;
        float: left;
        padding-top: 10px;
    }

    .carType_info span {
        display: block;
        padding-top: 5px;
        font-size: 11px;
        color: #a2a2a2;
    }

    .driver_namebox {
        width: 115px;
        text-align: center;
        float: right;
    }

    .driver_namebox .boxcircle {
        line-height: 20px;
        padding: 15px 0;
        border-left: 1px dashed #eee;
    }

    .driver_namebox b {
        margin-bottom: 5px;
    }

    .car_notice {
        font-size: 15px;
        text-align: center;
        line-height: 25px;
        margin: 35px 0 -20px;
        letter-spacing: -.5px;
        color: #0072bccf;
    }

    .car_notice ul:before {
        content: '';
        display: block;
        background: url('/globals/common/kr/img/common/cha_monkeycar.gif?v=1') no-repeat;
        width: 90px;
        height: 95px;
        margin: 0 auto;
        background-size: 90px;
    }

    .car_notice p {
        color: #17469E;
        font-size: 22px;
        padding: 20px 0 10px;
        line-height: 24px;
        width: 100%;
    }

    .car_notice p.p_txt {
        color: #333;
        width: 90%;
        margin: 0 auto;
        font-size: 14px !important;
    }

    .car_notice p.p_txt b {
        text-decoration: underline
    }

    .car_notice ul li strong {
        color: #17469E;
        font-size: 20px;
    }

    .car_notice ul li.txt {
        color: #999;
    }

    .car_notice a:hover {
        text-decoration: underline;
    }

    .car_notice em {
        width: 1px;
        background: #eee;
        margin: 0 5px;
        display: inline-block;
        height: 12px;
    }

    .txt_promo {
        padding: 0 0 30px !important;
    }

    .txt_promo li {
        font-size: 16px;
    }

    .car_txt {
        font-size: 13px;
    }

    .ssrv_more {
        clear: both;
        text-align: left;
        margin: 10px 0 5px;
        font-size: 16px;
    }

    .ssrv_morelist {
        border: 1px solid #eee;
        padding: 0 10px;
        background: #eee;
        width: 100%;
        height: 40px;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center center;
        -webkit-border-radius: 1em;
        -moz-border-radius: 1em;
        border-radius: .7em;
    }

    .ssrv_morelist li {
        width: 98%;
        text-align: left;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        padding: 3px 3px 3px 5px;
        border-bottom: 0;
        background: url('/globals/common/img/bu/bg_sprite_ico.gif') no-repeat 0px -146px;
    }

    .supplier_infobox .ssrv_more {
        border-bottom: 1px dashed #eee;
        padding-bottom: 15px;
        color: #6472a1;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
    }

    .layer_supplier {
        position: absolute;
        max-height: 500px;
        background: #fff;
        z-index: 5000;
        right: 0;
        border: 1px solid #dfdfdf;
        display: none;
        overflow: hidden;
    }

    .layer_supplier .ssdr_av_point {
        font-weight: 400;
        display: block;
        padding: 2px 0 1px;
        background: #eee;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center center;
        -webkit-border-radius: .4em;
        -moz-border-radius: .4em;
        border-radius: .4em;
        width: 90px;
        margin: 0 auto;
    }

    .layer_supplier td {
        padding: 20px;
        vertical-align: middle;
        border-bottom: 1px solid #eee;
    }

    .layer_supplier td .avno1 {
        font-weight: 500;
        display: block;
        padding-top: 5px;
        font-size: 22px;
        line-height: 25px;
    }

    .layer_supplier td p {
        color: #888;
    }

    .layer_close {
        display: inline-block;
        overflow: hidden;
    }

    .layer_supplier_tit {
        padding: 10px;
        border-bottom: 1px solid #ddd;
        margin: 0 auto;
    }

    .supplier_infobox .ssrv_txt {
        line-height: 18px;
    }

    .supplierinfo .guide_name {
        margin-top: 5px;
    }

    .supplierinfo .guide_name table {
        width: 340px;
    }

    .supplierinfo .guide_name table th,
    .supplierinfo .guide_name table td {
        padding: 5px 0;
        text-align: center;
    }

    .supplierinfo .guide_name table td span {
        font-size: 14px;
        border-radius: 10px;
        background: #fafafa;
        padding: 10px;
        height: 30px;
        word-break: break-word;
        display: table-cell;
        vertical-align: middle;
        min-width: 60px;
    }

    .supplierinfo .thumb01 {
        display: inline-block;
        border-radius: 55px;
        overflow: hidden;
        border: 1px solid #eee;
        float: left;
        width: 100px;
        height: 100px;
        overflow: hidden;
        margin: 0 5px 10px 0;
    }

    .supplierinfo .thumb01 img {
        width: 100%;
        height: 100%;
    }

    .supplier_infobox li {
        height: 265px;
    }

    .supplier_infobox li .ic_shaplus {
        left: 75px;
    }

    .supplier_infobox .ssrv_morelist ul li {
        height: 20px;
        background: url(/globals/common/img/bu/bg_sprite_ico.gif) no-repeat 0px -142px;
    }

    .supplier_infobox .ssrv_morelist {
        border: 0 dashed #eee;
        background: #fff;
        width: 100%;
        height: 90px;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center center;
        -webkit-border-radius: 0;
        -moz-border-radius: 0;
        border-radius: 0;
        padding: 10px 0px;
    }

    .supplier_infobox .ssrv_nolist {
        clear: left;
        border: 0 dashed #eee;
        background: #fff;
        width: 100%;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center center;
        -webkit-border-radius: 0;
        -moz-border-radius: 0;
        border-radius: 0;
        padding: 24px 15px;
    }

    .supplier_infobox .ssrv_nolist p {
        color: #999;
    }

    .supplier_infobox .ssrv_nolist i {
        color: #ddd;
        font-size: 40px;
    }

    .guide_new_tit {
        width: 96%;
        padding: 50px 20px 30px;
        color: #17469E;
        background: #fff;
        font-size: 26px;
        font-weight: 500;
        text-align: left;
        border-bottom: 1px solid #eee;
    }

    .guide_new_tit i {
        font-size: 30px;
    }

    .driver_rvlist {
        max-height: 450px;
        background: #fff;
        z-index: 1000;
        overflow-x: hidden;
        overflow-y: auto;
        -ms-overflow-style: -ms-autohiding-scrollbar;
        -webkit-overflow-scrolling: touch;
    }

    .mr10 {
        margin-right: 10px;
    }

    .driver_list .h-380 {
        height: 380px;
    }

    .side-bar-inc {
        top: 85%;
    }

    .main_sale_banner {
        top: 85%;
    }

    .item-info-check {
        padding: 15px;
    }

    .title-second {
        font-size: 18px;
    }

    .title-second {
        margin-bottom: 20px;
    }

    .item_check_term_all_,
    .item_check_term_ {
        background: url(/uploads/icons/form_check_icon.png) no-repeat calc(100% - 15px) 50% #f3f5f7;
        background-size: 23px 15px;
    }

    .item-info-check:hover {
        background-color: #fff;
        cursor: pointer;
    }

    .item_check_term_all_.checked_,
    .item_check_term_.checked_ {
        background: url(/images/ico/check_2.png) no-repeat calc(100% - 15px) 50% #f3f5f7;
        background-size: 23px 15px;
    }

    @media screen and (min-width: 1921px) {
        .side-bar-inc {
            top: 78%;
        }

        .main_sale_banner {
            top: 78%;
        }
    }

    @media screen and (min-width: 2400px) {
        .side-bar-inc {
            top: 68%;
        }

        .main_sale_banner {
            top: 68%;
        }
    }

    @media screen and (min-width: 2560px) {
        .side-bar-inc {
            top: 64%;
        }

        .main_sale_banner {
            top: 64%;
        }
    }

    @media screen and (min-width: 2880px) {
        .side-bar-inc {
            top: 57%;
        }

        .main_sale_banner {
            top: 57%;
        }
    }

    @media screen and (min-width: 3840px) {
        .side-bar-inc {
            top: 43%;
        }

        .main_sale_banner {
            top: 43%;
        }
    }

    @media screen and (min-width: 5760px) {
        .side-bar-inc {
            top: 28%;
        }

        .main_sale_banner {
            top: 28%;
        }

    }

    @media screen and (min-width: 7680px) {
        .side-bar-inc {
            top: 18%;
        }

        .main_sale_banner {
            top: 18%;
        }
    }

    @media screen and (max-width: 850px) {
        .section_vehicle_2 .tab_list_title_ .tab_title_item_ {
            width: calc(100% / 3);
            padding: 2rem;
            background: #f4f4f4;
            color: #898989;
            font-size: 2.4rem;
            border: 0.1rem solid #dbdbdb;
            text-align: center;
            cursor: pointer;
            font-weight: 600;
        }

        .section_vehicle_2 .tab_list_title_ {
            margin-bottom: 5rem;
            padding: 0 2rem;
        }

        .cars_category_wrap .ttl_category_depth_1 {
            font-weight: 500;
            font-size: 3rem;
            padding-top: 4rem;
        }

        .section_vehicle_2 .tab_content_list_ .review_real .tbl_rate2 {
            padding: 0;
        }

        .section_vehicle_2 .tab_content_list_ .review_real .eval1 li {
            padding: 0.3rem 0;
            text-align: center;
            color: #333;
            width: unset;
            font-size: 2.6rem;
        }

        .section_vehicle_2 .tab_content_list_ .review_real .eval1 li.avg strong {
            font-size: 5rem;
            font-weight: 600;
            color: #17469E;
        }

        .section_vehicle_2 .tab_content_list_ .review_real .eval1 li.avg b {
            font-size: 3rem;
            color: #777;
            font-weight: 400;
        }

        .section_vehicle_2 .tab_content_list_ .review_real .tbl_rate2 .rating_avscore {
            width: 10rem;
            padding: 0;
            display: inline-block;
            text-align: center;
            color: #17469E;
            font-size: 5rem;
            font-weight: 600;
        }

        .section_vehicle_2 .tab_content_list_ .review_real .tbl_rate2 .totoal_av p,
        .section_vehicle_2 .tab_content_list_ .review_real .tbl_rate2 .totoal_av p {
            border: 0;
            background: 0 0;
            font-size: 1.3rem;
            padding: 1.2rem 0;
            text-align: center;
            color: #222;
        }

        .section_vehicle_2 .tab_content_list_ .review_real .tbl_rate2 .rating_avstxt {
            font-size: 2.6rem;
            line-height: 2rem;
            display: block;
            background: #eee;
            padding: 1.6rem 1.4rem;
            font-weight: 500;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
            -webkit-border-radius: .4em;
            -moz-border-radius: .4em;
            border-radius: .4em;
            letter-spacing: -1px;
        }

        .section_vehicle_2 .tab_content_list_ .review_real .tbl_rate2 {
            width: 100%;
            padding: 0;
            display: flex;
            margin-bottom: 6rem;
            column-gap: 6rem;
            justify-content: center;
            flex-wrap: wrap;
            row-gap: 0;
        }

        .tbl_top_wrap .count {
            font-size: 2.8rem;
            margin-bottom: 2rem;
        }

        .ssrvtbl_list td {
            padding: 2.5rem 0 2rem;
        }

        .ssrvtbl_list .ssrv_txt {
            min-height: 7rem;
            line-height: 1.3;
            margin-bottom: 1rem;
        }

        .ssrvtbl_list span.avno1 {
            display: block;
            padding: 0.5rem 0;
            font-size: 3rem;
            line-height: 2.5rem;
            font-weight: 600;
            color: #17469E;
        }

        .driver_list .h-380 {
            height: 83rem;
        }

        .driver_namebox .boxcircle {
            border-left: none;
            line-height: 3.7rem;
            padding: 0;
            margin-top: -0.2rem;
        }

        .supplier_infobox li .supplierinfo {
            width: 95%;
            position: relative;
            margin: 1rem 0;
            padding: 0 0rem 0 1.3rem;
        }

        .supplier_infobox .position:nth-child(even) .supplierinfo {
            border-left: 1px solid rgb(238, 238, 238);
        }

        .supplier_infobox li {
            padding: 0;
        }

        .carType_info {
            width: 100%;
            text-align: center;
        }

        .driver_namebox {
            width: 100%;
        }

        .carType_info span {
            display: block;
            padding-top: 0.5rem;
            font-size: 2.8rem;
            margin: 1rem 0;
            color: #a2a2a2;
        }

        .supplierinfo .thumb03,
        .supplierinfo .thumb02 {
            display: inline-block;
            border-radius: 5.5rem;
            overflow: hidden;
            border: 0.1rem solid #eee;
            float: left;
            width: 12rem;
            height: 12rem;
            overflow: hidden;
            margin: 0 0.8rem 0px 0.8rem;
        }

        .supplier_rate2 .rate_box .eval1 li.total_avscore {
            border-bottom: 0;
            font-size: 3rem;
            font-weight: 600;
            margin: 0;
            color: #17469E;
            height: 3rem;
            width: 7.5rem;
            padding-top: 0;
        }

        .supplierinfo .thumb03,
        .supplierinfo .thumb02 {
            border-radius: 9.9rem;
            overflow: hidden;
            border: 0.1rem solid #eee;
            float: left;
            width: 12rem;
            height: 12rem;
            overflow: hidden;
            margin: 0 0.6rem 0.6rem 1.9rem;
        }

        .supplierinfo .thumb03 img,
        .supplierinfo .thumb02 img {
            width: 12rem;
            height: 12rem;
        }

        .supplier_rate2 .rate_box {
            margin-bottom: 0;
        }

        .supplier_rate2 {
            flex-direction: column;
        }

        .supplier_infobox .drv_ssrvlist {
            padding: 0 0px 1rem 0;
            width: 100%;
        }

        .ssrv_more {
            clear: both;
            text-align: left;
            margin: 1rem 0 0;
            font-size: 2rem;
        }

        .supplier_infobox .ssrv_more {
            border-bottom: unset;
            padding-bottom: unset;
            color: #6472a1;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-direction: column;
            gap: 2rem;
        }

        .ssrv_more_btn {
            cursor: pointer;
            float: right;
            padding: 2rem 7rem;
            font-size: 2.4rem;
            color: #6472a1 !important;
            border: 1px solid #ccd0d8 !important;
            background-color: #f6f6f6;
            line-height: 2.5rem;
        }

        .ssdr_av_point {
            font-weight: 500;
            display: block;
            background: #eee;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
            -webkit-border-radius: .4em;
            -moz-border-radius: .4em;
            border-radius: .4em;
            width: 70px;
            margin: 0;
            padding: 7px 0;
        }

        .ssdr_av {
            line-height: 2.4rem;
            text-align: center;
            color: #777;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 2.5rem;
        }

        .supplier_rate2 {
            display: flex;
            width: 100%;
            margin: 1rem 0;
            border: 0;
            gap: 1rem;
        }

        .supplier_rate2 .rate_box .totalpoint {
            padding-top: 0.7rem;
        }

        .totalpoint {
            font-size: 2.4rem;
        }

        .supplier_infobox .drv_ssrvlist .ssrv_morelist {
            padding-left: 1.5rem;
            height: 9rem;
            padding: 1rem 0;
        }

        .supplier_infobox .ssrv_more {
            padding-left: 0.9rem;
        }

        .carType_info {
            padding-top: 0;
        }

        .carType_info img {
            width: 11.1rem;
            height: 5.2rem;
        }

        .supplier_infobox:last-child li {
            border-bottom: none;
        }

        .vehicle_synthetic> :nth-child(1) {
            width: 100%;
            padding-left: 0;
            margin-bottom: 2rem;
        }

        .vehicle_synthetic {
            margin-top: 0;
        }

        .vehicle_synthetic__ttl {
            margin-bottom: 1rem;
        }

        .vehicle_synthetic> :nth-child(2) {
            width: 17rem;
        }

        .vehicle_synthetic> :nth-child(4) {
            width: 15rem;
        }

        .vehicle_synthetic> :nth-child(6) {
            width: 16rem;
            padding-top: 0;
        }

        .vehicle_synthetic {
            margin-top: 0;
            justify-content: space-between;
        }

        .img_box>img,
        .img_box__img {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
            height: 30rem;
            object-fit: cover;
        }

        .popup_wrap .pop_box .close {
            top: 2.7692rem;
            right: 1.7692rem;
            width: 2.5385rem;
            height: 2.5385rem;
        }

        .popup_place__list>li>span {
            padding: 1.5rem 1.3rem;
            color: #757575;
            background-color: #fff;
            border: 0.2rem solid #dbdbdb;
            border-radius: 0.6rem;
        }

        .popup_place__list>li {
            width: unset;
        }

        .popup_place__head__ttl {
            font-size: 3rem;
        }

        .popup_place__head {
            padding-bottom: 2.5rem;
            padding-top: 5.5rem;
        }

        .popup_place__list {
            gap: 2rem;
        }

        .flex-20-mo {
            display: flex;
            gap: 2rem;
        }

        .img_box_14 {
            padding-top: calc(300% / 658 * 100);
        }

        .section_vehicle_2_7__btn_wrap {
            display: none !important;
        }
    }
</style>

<section class="section_vehicle_1">
    <div class="banner_vehicle">
        <div class="body_inner">
            <div class="swiper_container_ticket swiper">
                <div class="swiper-wrapper">
                    <?php foreach ($bannerTop as $banner): ?>
                        <div class="swiper-slide">
                            <div class="img_box img_box_14">
                                <picture>
                                    <source media="(min-width: 851px)" srcset="/data/cate_banner/<?= $banner['ufile1'] ?>">
                                    <img class="img_box__img" src="/data/cate_banner/<?= $banner['ufile2'] ?>" alt="">
                                </picture>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="swiper-button-next-vehicle"><img src="/uploads/icons/next_s.png" alt=""></div>
                <div class="swiper-button-prev-vehicle"><img src="/uploads/icons/prev_s.png" alt=""></div>
            </div>
        </div>
    </div>
</section>

<section class="section_vehicle_2">
    <div class="body_inner">
        <div class="section_vehicle_2__wrap ">
            <div class="tab_list_title_">
                <div class="tab_title_item_ active_" data-tab="vehicle_tab">차량 예약</div>
                <div class="tab_title_item_ " data-tab="review_tab">리얼리뷰</div>
                <div class="tab_title_item_ " data-tab="driver_tab">기사님 소개</div>
            </div>
            <div class="tab_content_list_">
                <div class="tab_content_item_ active_" id="vehicle_tab">
                    <section class="section_vehicle_2_1">
                        <div class="section_vehicle_2_1__head">
                            <div class="section_vehicle_2_1__head__ttl vehicle_ttl">
                                간편 차량예약 <span>출발 지역 -> 최종 도착 지역을 선택해주세요</span>
                            </div>
                            <div class="section_vehicle_2_1__head__icon" style="position: relative;">
                                <a href="javascript:show_popup_caution()">
                                    <img src="/images/ico/ico_warning.svg" alt="">
                                    주의사항
                                    <img src="/uploads/icons/arrow_up_icon.png" alt=""
                                        class="arrow-slide-vehicle white-icon">
                                </a>
                                <div class="caution_popup">
                                    <!-- <div class="caution_top" onclick="close_popup_caution()">
                                        <img src="/images/ico/close-btn-grey.png" alt="">
                                    </div> -->
                                    <div class="caution_content">
                                        <h4>주의사항</h4>
                                        <div class="desc">
                                            <?= viewSQ(getPolicy(20)) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            function show_popup_caution() {
                                $(".caution_popup").toggle();
                                if ($(".caution_popup").css('display') !== 'none') {
                                    $(".arrow-slide-vehicle").css('transform', 'rotate(180deg)');
                                } else {
                                    $(".arrow-slide-vehicle").css('transform', 'rotate(0)');
                                }
                            }

                            function close_popup_caution() {
                                $(".caution_popup").hide();
                            }
                        </script>
                        <div class="section_vehicle_2_1__body">
                            <div class="place_chosen">
                                <div class="place_chosen__start bg_gray" role="button" id="place_chosen__start">
                                    <img src="/images/ico/ico_place.svg" alt="">
                                    <span class="departure_name">출발지역</span>
                                </div>
                                <div class="place_chosen__icon">
                                    <img src="/images/ico/ico_transfer.svg" alt="">
                                </div>
                                <div class="place_chosen__end bg_gray" role="button" id="place_chosen__end">
                                    <img src="/images/ico/ico_place.svg" alt="">
                                    <span class="destination_name">도착지역</span>
                                </div>
                                <div class="place_chosen__date bg_gray">
                                    <label for="departure_date" role="button">
                                        <img src="/images/ico/ico_calendar_1.png" alt="">
                                        미팅날짜 : <span id="departure_date_text">06.21(토)</span>
                                        <input type="text" id="departure_date" class="datepicker">
                                    </label>
                                </div>
                                <div></div>
                                <div class="place_chosen__people_wrap">
                                    <div class="place_chosen__people bg_gray" role="button" id="place_chosen__people">
                                        <img src="/images/ico/ico_person_1.png" alt="">
                                        <p>성인 <span id="people_adult_cnt">1</span>명,&nbsp;&nbsp;소아 <span
                                                id="people_child_cnt">0</span>명</p>
                                    </div>
                                    <div class="place_chosen__people_pop">
                                        <div class="pickup_amount">
                                            <div class="pickup_amount__ttl">성인</div>
                                            <div class="pickup_amount__numbox">
                                                <button class="btn_minus">
                                                    <img src="/images/ico/ico_minus1.png" alt="">
                                                </button>
                                                <input type="text" class="pickup_amount__num" name="adult_cnt" value="1"
                                                    min="0">
                                                <button class="btn_plus">
                                                    <img src="/images/ico/ico_plus1.png" alt="">
                                                </button>
                                            </div>
                                        </div>
                                        <div class="pickup_amount">
                                            <div class="pickup_amount__ttl">소아</div>
                                            <div class="pickup_amount__numbox">
                                                <button class="btn_minus">
                                                    <img src="/images/ico/ico_minus1.png" alt="">
                                                </button>
                                                <input type="text" class="pickup_amount__num" name="child_cnt" value="0"
                                                    min="0">
                                                <button class="btn_plus">
                                                    <img src="/images/ico/ico_plus1.png" alt="">
                                                </button>
                                            </div>
                                        </div>
                                        <button class="btn_pickup_people" id="btn_pickup_people">완료</button>
                                    </div>
                                </div>
                            </div>
                            <a href="/travel-tips/infographic/view?code=infographics&bbs_idx=999" class="view_map_btn">
                                <picture>
                                    <source media="(max-width: 850px)" srcset="/images/sub/btn_view_map_m.png">
                                    <img src="/images/sub/btn_view_map.png" alt="view_map">
                                </picture>
                            </a>
                        </div>
                    </section>
                    <section class="section_vehicle_2_2">
                        <div class="section_vehicle_2_2__head">
                            <div class="section_vehicle_2_2__head__ttl vehicle_ttl">
                                상품선택 <span>상품 선택후 아래 세부항목을 선택해주세요.</span>
                                <img style="vertical-align: middle;margin-left: 3px" src="/images/ico/ico_question.png"
                                    alt="">
                            </div>

                            <div class="cars_category_wrap">
                                <p class="ttl_category_depth_1">상품을 선택해주세요</p>
                                <ul class="section_vehicle_2_2__head__tabs cars_category_depth_1">

                                </ul>
                                <div class="section_vehicle_2_2__airport">

                                </div>
                            </div>

                        </div>
                    </section>

                    <section class="section_vehicle_2_3">
                        <div class="section_vehicle_2_3__head">
                            <div class="section_vehicle_2_3__head__ttl vehicle_ttl">
                                차량선택 <span>차량의 종류와 대수를 선택해주세요</span>
                            </div>
                        </div>
                        <table class="vehicle_list">
                            <colgroup>
                                <col width="277px">
                                <col width="480px">
                                <col width="320">
                            </colgroup>
                            <tbody id="product_vehicle_list">
                            </tbody>
                        </table>
                    </section>
                    <section class="section_vehicle_2_4">
                        <div class="section_vehicle_2_4__head">
                            <div class="section_vehicle_2_4__head__ttl">
                                취소 규정 : 결제후 06월26일 18시(한국시간) 이전에 취소하시면 무료취소가 가능합니다.
                                <a class="vehicle_ttl__link" href="#!" data-product-idx="1324">본 예약건 취소규정 자세히 보기</a>
                            </div>
                        </div>
                        <table class="vehicle_list">
                            <colgroup>
                                <col width="277px">
                                <col width="480px">
                                <col width="320">
                            </colgroup>
                            <tbody id="product_vehicle_list_selected" style="display: none;">
                            </tbody>
                        </table>
                        <div class="vehicle_synthetic">
                            <div class="flex-20-mo">
                                <p class="vehicle_synthetic__ttl">선택상품</p>
                                <p class="vehicle_synthetic__txt">차량 <i id="total_cnt">0</i>대</p>
                            </div>
                            <div>
                                <p class="vehicle_synthetic__ttl">차량가격</p>
                                <div class="vehicle_all_price"><i id="all_price">0</i><span> 원 (<i
                                            id="all_price_baht">0</i>바트)</span>
                                </div>
                            </div>
                            <div class="vehicle_minus">
                                <span class="minus_ico"></span>
                            </div>
                            <div>
                                <p class="vehicle_synthetic__ttl">할인</p>
                                <div class="vehicle_all_price">0<span> 원 (0바트)</span></div>
                            </div>
                            <div class="vehicle_equal">
                                <span class="equal_ico"></span>
                            </div>
                            <div>
                                <p class="vehicle_synthetic__ttl">결제예정금액</p>
                                <div class="vehicle_price"><i id="final_price">0</i><span> 원 (<i
                                            id="final_price_baht">0</i>바트)</span>
                                </div>
                            </div>
                            <!-- <div class="vehicle_coupon">
                                    <button class="coupon_btn">쿠폰선택</button>
                                    <button class="point_btn">포인트사용</button>
                                </div> -->
                        </div>
                        <div class="section_vehicle_2_4__foot">
                            예약시 기재하신 미팅장소에서 목적지까지의 단순 편도 차량입니다. <br> 샌딩 지역이 예약하신 상품의 지역이 아닌 곳은 추
                        </div>
                    </section>
                    <section class="section_vehicle_2_5">
                        <div class="section_vehicle_2_5__head">
                            <div class="section_vehicle_2_5__head__ttl vehicle_ttl">
                                포함/불포함사항
                            </div>
                        </div>
                        <div class="section_vehicle_2_5__body">
                            <div class="include_box chk_info">
                                <p class="sub_label"><i></i> 포함사항</p>
                                <div class="txt_box">
                                    <!-- <p>- 국제선 항공요금 및 각종 TAX 및 유류할증료 (항공불포함 제외)</p>
                                        <p>&nbsp; <font color="red">비지니스 이용을 원하실 경우 담당자에게 문의해주세요.</font>
                                        </p>
                                        <p>- 전일정 4성급 호텔 및 식사 (불포함 표기 식사 제외)</p>
                                        <p>&nbsp; <font color="red">호텔 업그레이드를 원하시는 경우 담당자에게 문의해주세요.</font>
                                        </p>
                                        <p>- 전일정 전용차량 및 입장료 (자유일정 제외)<br>- 여행자 보험&nbsp;</p>
                                        <p>
                                            <font color="black">&nbsp;</font>
                                        </p> -->
                                    <?= viewSQ(getPolicy(16)) ?>
                                </div>
                            </div>
                            <div class="no_include_box chk_info">
                                <p class="sub_label"><i></i> 불포함사항</p>
                                <div class="txt_box">
                                    <!-- <p>- 더투어랩는 가이드 팁 대신 책 (신간) 을 받습니다.</p>
                                        <p>&nbsp; 장르 상관없이 1인당 책 1권만 가지고 오시면 되며, 호주 내 한인 도서관에 기증됩니다.</p>
                                        <p>- 불포함 표기 식사 및 자유일정</p>
                                        <p>
                                            <font color="black">- 호주 ETA 비자 : AustralianETA 모바일 앱을 통해 직접 신청</font>
                                        </p>
                                        <p>- 기타 개인 경비 (물값, 자유시간 시 개인비용 등)</p>
                                        <p>※ 호주 화폐로 준비해주시기 바랍니다.</p> -->
                                    <?= viewSQ(getPolicy(17)) ?>

                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="section_vehicle_2_6">
                        <div class="section_vehicle_2_6__head">
                            <div class="section_vehicle_2_6__head__ttl vehicle_ttl">
                                공지사항
                            </div>
                        </div>
                        <div class="section_vehicle_2_6__body">
                            <!-- <ul>
                                    <li>승용차는 최대 성인 3인 혹은 성인 2인 + 아동 1인까지만 가능합니다. 만약 성인 3인 + 아동 1인인 경우 SUV 혹은 승합차로 이용하셔야 합니다.</li>
                                    <li>승용차의 트렁크에는 가스통이 있어 짐이 많을 경우 좁을 수 있으니 소인을 포함하여 인원이 3 ~ 4분이면 짐의 양도 고려하셔야 합니다.</li>
                                    <li>별도로 카시트는 준비되지 않습니다.</li>
                                    <li>에어비엔비등으로 예약한 일반 숙소, 풀빌라등의 경우 정확한 건물명, 주소, 호스트의 태국 현지 연락처를 기재하셔야 합니다.</li>
                                    <li>
                                        예약시 기재한 일정 외에 미리 알리지 않은 일정을 당일 추가시 비용이 추가가 되며 기사님의 스케쥴에 따라 이용이 어려울 수도 있으니
                                        미리 게시판을 통하여 문의하시기 바랍니다.
                                    </li>
                                    <li>차량내 흡연, 음주, 안전벨트 미착용등의 위반시 5,000원 이상의 벌금이 부과되니 주의해 주세요.</li>
                                    <li>고급차량(알파드,벤츠)등은 10시간 렌탈로 요청 가능하며, 일일렌탈 12시간으로 예약신청 후 10시간으로 렌탈요청시 견적서 다시 보내드립니다.</li>
                                    <li>프리미엄 세단은 벤츠 E클래스 또는 BMW5 시리즈 등 동급으로 배정 됩니다.</li>
                                    <li>럭셔리 세단은 벤츠 S클래스 또는 BMW7 시리즈 등 동급으로 배정됩니다.</li>
                                </ul> -->
                            <?= viewSQ(getPolicy(18)) ?>
                        </div>
                    </section>
                    <form action="/vehicle/confirm-info" name="frmCar" id="frmCar" method="post">
                        <input type="hidden" name="code_no" id="code_no" value="<?= $code_no ?>">
                        <input type="hidden" name="type_code_no" id="type_code_no" value="">
                        <input type="hidden" name="cp_idx" id="cp_idx" value="">
                        <input type="hidden" name="product_cnt" id="product_cnt" value="">
                        <input type="hidden" name="ca_depth_idx" id="ca_depth_idx" value="">
                        <input type="hidden" name="code_parent_category" id="code_parent_category" value="">
                        <input type="hidden" name="departure_area" id="departure_area" value="">
                        <input type="hidden" name="destination_area" id="destination_area" value="">
                        <input type="hidden" name="meeting_date" id="meeting_date" value="">
                        <input type="hidden" name="return_date" id="return_date" value="">
                        <input type="hidden" name="adult_cnt" id="adult_cnt" value="1">
                        <input type="hidden" name="child_cnt" id="child_cnt" value="">
                        <input type="hidden" name="inital_price" id="inital_price" value="">
                        <input type="hidden" name="order_price" id="order_price" value="">
                        <input type="hidden" name="order_status" id="order_status" value="W">
                        <input type="hidden" name="text_category_5401" id="text_category_5401" value="">
                        <input type="hidden" name="ca_idx_5401" id="ca_idx_5401" value="">
                        <input type="hidden" name="text_destination_name" id="text_destination_name" value="">
                        <input type="hidden" name="text_departure_name" id="text_departure_name" value="">
                        <input type="hidden" name="category_text_list" id="category_text_list" value="">
                        <input type="hidden" name="product_code" id="product_code" value="">



                        <!-- <div class="section_vehicle_info_wrap">

                        </div> -->

                        <!-- <div class="policy_wrap">
                            <h3 class="title-second">약관동의</h3>
                            <div class="item-info-check item_check_term_all_">
                                <label for="fullagreement">전체동의</label>
                                <input type="hidden" value="N" id="fullagreement">
                            </div>
                            <div class="item-info-check item_check_term_">
                                <label for="">이용약관 동의(필수)</label>
                                <button type="button" data-type="1" class="view-policy">[보기]</button>
                                <input type="hidden" value="N" id="terms">
                            </div>
                            <div class="item-info-check item_check_term_">
                                <label for="">개인정보 처리방침(필수)</label>
                                <button type="button" data-type="2" class="view-policy">[보기]</button>
                                <input type="hidden" value="N" id="policy">
                            </div>
                            <div class="item-info-check item_check_term_">
                                <label for="">개인정보 제3자 제공 및 국외 이전 동의(필수)</label>
                                <button type="button" data-type="3" class="view-policy">[보기]</button>
                                <input type="hidden" value="N" id="information">
                            </div>
                            <div class="item-info-check item_check_term_">
                                <label for="guidelines">여행안전수칙 동의(필수)</label>
                                <button type="button" data-type="4" class="view-policy">[보기]</button>
                                <input type="hidden" value="N" id="guidelines">
                            </div>
                        </div> -->

                        <div class="section_vehicle_2_7__btn_wrap">
                            <button class="btn_submit" type="button" value="W">
                                상품 예약하기
                            </button>
                            <button class="btn_add_cart" id="btn_show_cart" type="button" value="B">
                                장바구니담기
                            </button>
                            <button class="btn_add_cart" type="button" onclick="redirect_contact()">
                                문의하기
                            </button>
                            <!-- <button class="btn_submit" onclick="window.location.href='/product/completed-order'">
                                    상품 예약하기
                                </button> -->

                        </div>
                    </form>
                    <!-- <section class="section_vehicle_2_7" style="display: none;">
                        <div class="section_vehicle_2_7__head">
                            <div class="section_vehicle_2_7__head__ttl vehicle_ttl spe">
                                예약자 정보입력
                            </div>
                            <div class="bs-input-check">
                                <input type="checkbox" id="save_id" name="save_id" value="Y">
                                <label for="save_id"> 회원정보와 동일</label>
                            </div>

                        </div>
                        <div class="section_vehicle_2_7__body">

                        </div>
                    </section> -->
                </div>
                <div class="tab_content_item_ review_real " id="review_tab">
                    <?php echo view("/product/inc/vehicle-guide/review_tab.php"); ?>
                </div>
                <?php $len2 = count($drivers) ?>
                <div class="tab_content_item_ " id="driver_tab">
                    <?php echo view("/product/inc/vehicle-guide/driver_tab.php", ['len2' => $len2, 'drivers' => $drivers]); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function redirect_contact() {
        <?php
        if (empty(session()->get("member")["id"])) {
            ?>
            // alert("주문하시려면 로그인해주세요!");
            showOrHideLoginItem();
            return false;
            <?php
        }
        ?>

        window.location.href = '/mypage/consultation';
    }
    $(document).ready(function () {
        $('.tab_title_item_').click(function () {
            $('.tab_title_item_').removeClass('active_');
            $('.tab_content_item_').removeClass('active_');

            $(this).addClass('active_');
            let tab = $(this).data('tab');
            $('#' + tab).addClass('active_');
        })
    })
</script>

<section class="popup_section">
    <div class="popup_wrap place_pop place_chosen__start_pop">
        <div class="pop_box">
            <button type="button" class="close" onclick="closePopup()"></button>
            <div class="pop_body">
                <div class="padding">
                    <div class="popup_place__head">
                        <div class="popup_place__head__ttl">
                            <h2>출발지역</h2>
                        </div>
                    </div>
                    <div class="popup_place__body">
                        <ul class="popup_place__list">
                            <?php
                            $i = 1;
                            foreach ($departure_list as $key => $value):
                                ?>
                                <li class="<?=count($value["contents_list"]) > 0 ? "is_content" : ""?>" data-ca_idx="<?= $value["ca_idx"] ?>" data-code="<?= $value["code_no"] ?>"
                                    onclick="change_departure_category(this);">
                                    <span
                                        class="<?php if ($i == 1) {
                                            echo "active";
                                        } ?>"><?= getCodeFromCodeNo($value["code_no"])["code_name"] ?></span>
                                    <?php
                                        if(count($value["contents_list"]) > 0) {
                                    ?>
                                    <div class="layer_contents">
                                        <div class="layer_contents_wrap">
                                            <?php
                                                foreach($value["contents_list"] as $contents) {
                                            ?>
                                                <div class="layer_contents_child">
                                                    <?= viewSQ($contents["contents"]) ?>
                                                </div>
                                            <?php
                                                }
                                            ?>
                                            <?php
                                                if(!empty($value["code_url"])) {
                                            ?>
                                                <a class="btn_link" href="<?=$value["code_url"]?>"><?=$value["code_title_url"]?></a>
                                            <?php
                                                }
                                            ?>
                                        </div>
                                    </div>
                                    <?php
                                        }
                                    ?>
                                </li>
                                <?php
                                $i++;
                            endforeach;
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="dim"></div>
    </div>
    <div class="popup_wrap place_pop place_chosen__end_pop">
        <div class="pop_box">
            <button type="button" class="close" onclick="closePopup()"></button>
            <div class="pop_body">
                <div class="padding">
                    <div class="popup_place__head">
                        <div class="popup_place__head__ttl">
                            <h2>도착지역</h2>
                        </div>
                    </div>
                    <div class="popup_place__body">
                        <ul class="popup_place__list">

                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="dim"></div>
    </div>

    <div class="popup_wrap place_pop policy_pop">
        <div class="pop_box">
            <button type="button" class="close" onclick="closePopup()"></button>
            <div class="pop_body">
                <div class="padding">
                    <div class="popup_place__head">
                        <div class="popup_place__head__ttl">
                            <h2>취소 규정</h2>
                        </div>
                    </div>
                    <div class="popup_place__body">
                        <div id="policyContent"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="dim" style="justify-content: space-between;"></div>
    </div>

    <div class="popup_wrap place_pop reservation_pop">
        <div class="pop_box">
            <button type="button" class="close" onclick="closePopup()"></button>
            <div class="pop_body">
                <div class="padding">
                    <div class="popup_place__head">
                        <div class="popup_place__head__ttl">
                            <h2>약관동의</h2>
                        </div>
                    </div>
                    <div class="popup_place__body">
                        <div id="policyContent"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="dim"></div>
    </div>
</section>

<div class="popup_wrap place_pop cart_info_pop">
    <div class="pop_box">
        <button type="button" class="close" onclick="closePopup()"></button>
        <div class="pop_body">
            <div class="padding">
                <div class="popup_place__head">
                    <div class="popup_place__head__ttl">
                        <h2>별도 요청</h2>
                    </div>
                </div>
                <form action="" name="frm_pop_cart" id="frm_pop_cart">
                    <div class="popup_place__body section_vehicle_2_7__body">
                        <div class="popup_vehicle_wrap">

                        </div>
                        <div class="flex_c_c">
                            <button type="button" class="btn_add_cart" id="add_cart">
                                장바구니 담기
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="dim"></div>
</div>

<script>
    $(".view-policy").on("click", function (event) {
        event.stopPropagation();
        let type = $(this).data("type");
        if (type == 1) {
            $(".reservation_pop #policyContent").html(`<?= viewSQ($reservaion_policy[1]["policy_contents"]) ?>`);
        } else if (type == 2) {
            $(".reservation_pop #policyContent").html(`<?= viewSQ($reservaion_policy[0]["policy_contents"]) ?>`);
        } else if (type == 3) {
            $(".reservation_pop #policyContent").html(`<?= viewSQ($reservaion_policy[2]["policy_contents"]) ?>`);
        } else {
            $(".reservation_pop #policyContent").html(`<?= viewSQ($reservaion_policy[3]["policy_contents"]) ?>`);
        }

        let title = $(this).closest(".item-info-check").find("label").text().trim();

        $(".reservation_pop .popup_place__head__ttl h2").text(title);
        $(".reservation_pop").show();
    });

    $(document).on("click", ".vehicle_ttl__link", function () {
        let productIdx = $(this).attr("data-product-idx");

        $.ajax({
            url: "/mypage/getPolicyContents/" + productIdx,
            type: "GET",
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    $("#policyContent").html(response.policy_contents);
                } else {
                    $("#policyContent").html("<p>" + response.message + "</p>");
                }
                $(".policy_pop, .policy_pop .dim").show();
            },
            error: function () {
                $(".policy_pop, .policy_pop .dim").show();
            }
        });
    });

</script>

<script>
    function updateDepartureDateToday() {
        let date = new Date();
        const year = String(date.getFullYear()).slice(-2);
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        const dayOfWeek = daysOfWeek[date.getDay()];

        $("#departure_date_text").text(`${year}.${month}.${day}(${dayOfWeek})`);
        $(".meeting_time__date").text(`${date.getFullYear()}-${month}-${day}(${dayOfWeek})`);
        $("#meeting_date").val(`${date.getFullYear()}-${month}-${day}`);
    }

    function updateDestinationDateToday() {
        let date = new Date();
        const year = String(date.getFullYear()).slice(-2);
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        const dayOfWeek = daysOfWeek[date.getDay()];

        $("#destination_date_text").text(`${year}.${month}.${day}(${dayOfWeek})`);
        $("#return_date").val(`${date.getFullYear()}-${month}-${day}`);
    }

    updateDepartureDateToday();

    function changeEmail(select) {
        let email_host = $(select).val();
        $("#email_host").val(email_host);
    }

    function change_departure_category(button) {
        let ca_idx = $(button).data("ca_idx");
        let departure_name = $(button).find("span").text();

        $(button).find("span").addClass("active");
        $(button).siblings().find("span").removeClass("active");
        $("#departure_area").val(ca_idx);
        $(".departure_name").text(departure_name);
        $(".place_chosen__start_pop").hide();

        get_destination();
    }

    function change_destination_category(button) {
        let ca_idx = $(button).data("ca_idx");
        let destination_name = $(button).find("span").text();
        $(button).find("span").addClass("active");
        $(button).siblings().find("span").removeClass("active");
        $("#destination_area").val(ca_idx);
        $(".destination_name").text(destination_name);
        $(".place_chosen__end_pop").hide();
        // handleFetch();
        get_depth_first_category();
    }

    function get_destination() {
        let ca_idx = $(".place_chosen__start_pop .popup_place__list li span.active").closest("li").data("ca_idx");
        let code_no = $(".place_chosen__start_pop .popup_place__list li span.active").closest("li").data("code");
        let departure_name = $(".place_chosen__start_pop .popup_place__list li span.active").text();

        $("#departure_area").val(ca_idx);
        $(".departure_name").text(departure_name);

        $.ajax({
            url: '/ajax/get_destination',
            type: "GET",
            data: {
                ca_idx,
                code_no
            },
            error: function (request, status, error) {
                alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
            },
            success: function (data, textStatus) {
                let html = ``;
                    console.log(data);

                let first_ca_idx = 0;
                let first_code_name = "";
                for (let i = 0; i < data.length; i++) {
                    if (i == 0) {
                        first_ca_idx = data[i]["ca_idx"];
                        first_code_name = data[i]["code_name"];
                    }


                    html += `<li class="${data[i]["contents_list"]?.length > 0 ? "is_content" : ""}" data-ca_idx="${data[i]["ca_idx"]}" onclick="change_destination_category(this);">
                                <span class="${i == 0 ? "active" : ''}">${data[i]["code_name"]}</span>`;
                    if(data[i]["contents_list"]?.length > 0) {
                        html += `<div class="layer_contents">
                                    <div class="layer_contents_wrap">`;

                        for (let j = 0; j < data[i]["contents_list"]?.length; j++) {
                            let contents = data[i]["contents_list"][j]["contents"];

                        html +=     `<div class="layer_contents_child">
                                        ${contents}
                                    </div>`;
                        }
                               
                        if(data[i]["code_url"] != ""){
                            html +=  `<a class="btn_link" href="${data[i]["code_url"]}">${data[i]["code_title_url"]}</a>`
                        }         
                                   
                        html +=     `</div>
                                </div>`;
                    }
                    html +=  `</li>`;
                }


                $(".place_chosen__end_pop .popup_place__list").html(html);
                $("#destination_area").val(first_ca_idx);
                $(".destination_name").text(first_code_name);

                get_depth_first_category();
                // $(".vehicle_ttl__link").attr("data-product-idx", '');
                $("#policyContent").empty();
            }
        });
    }

    function get_depth_first_category() {
        let ca_idx = $(".place_chosen__end_pop .popup_place__list li span.active").closest("li").data("ca_idx");

        $.ajax({
            url: '/ajax/get_child_category',
            type: "GET",
            data: {
                ca_idx
            },
            error: function (request, status, error) {
                alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
            },
            success: function (response, textStatus) {
                let data = response.category_list;
                let html = ``;

                for (let i = 0; i < data.length; i++) {

                    html += `<li class="section_vehicle_2_2__head__tabs__item category_item ${i == 0 ? "active" : ''} 
                                ${data[i]["contents_list"]?.length > 0 ? "is_content" : ""}" 
                                onclick="get_depth_category(this, 2);" data-ca_idx="${data[i]["ca_idx"]}" data-code="${data[i]["code_no"]}">`;
                    if(data[i]["contents_list"]?.length > 0) {
                        html += `<div class="layer_contents">
                                    <div class="layer_contents_wrap">`;

                        for (let j = 0; j < data[i]["contents_list"]?.length; j++) {
                            let contents = data[i]["contents_list"][j]["contents"];

                        html +=     `<div class="layer_contents_child">
                                        ${contents}
                                    </div>`;
                        }
                               
                        if(data[i]["code_url"] != ""){
                            html +=  `<a class="btn_link" href="${data[i]["code_url"]}">${data[i]["code_title_url"]}</a>`
                        }         
                                   
                        html +=     `</div>
                                </div>`;
                    }           
                    html +=     `<a href="#!">${data[i]["code_name"]}</a>
                            </li>`;
                }

                $(".cars_category_depth_1").html(html);

                get_depth_category($(".cars_category_depth_1 .section_vehicle_2_2__head__tabs__item.active"), 2);
            }
        });
    }

    function get_depth_category(button, depth) {

        $(button).addClass("active").siblings().removeClass("active");
        let previous_depth = Number(depth) - 1 ?? 1;
        let ca_idx = $(button).data("ca_idx");

        let code_first = $(".cars_category_depth_1 .section_vehicle_2_2__head__tabs__item.active").data("code");
        let ca_first_idx = $(".cars_category_depth_1 .section_vehicle_2_2__head__tabs__item.active").data("ca_idx");

        $("#ca_depth_idx").val(ca_first_idx);
        $("#code_parent_category").val(code_first);

        if (previous_depth == 1) {
            if (code_first == "5403") {
                let date_html = '';
                date_html += `<label for="departure_date" role="button">
                                <img src="/images/ico/ico_calendar_1.png" alt="">
                                미팅날짜 : <span id="departure_date_text">06.21(토)</span>
                                <input type="text" id="departure_date" class="datepicker">
                            </label>`;
                date_html += `<input type="hidden" id="day_range_total" value="">`;
                date_html += `<span>~</span>`;
                date_html += `<label for="destination_date" style="margin-left: 6px;" role="button">
                                <span id="destination_date_text">06.21(토)</span>
                                <input type="text" id="destination_date" class="datepicker">
                            </label>`;
                date_html += `<span style="margin-left: auto;"><span id="day_range_text">1</span>일</span>`;

                $(".place_chosen__date").html(date_html);
                // $(".place_chosen__date").css("justify-content", "space-between");

                updateDestinationDateToday();
            } else {
                $(".place_chosen__date").html(
                    `<label for="departure_date" role="button">
                        <img src="/images/ico/ico_calendar_1.png" alt="">
                        미팅날짜 : <span id="departure_date_text">06.21(토)</span>
                        <input type="text" id="departure_date" class="datepicker">
                    </label>`
                );

                $(".place_chosen__date").css("justify-content", "unset");
                $("#destination_date_text").text('');
                $("#return_date").val('');
            }

            updateDepartureDateToday();
            init_datepicker();
            // $(".vehicle_ttl__link").attr("data-product-idx", '');
            $("#policyContent").empty();

        }

        $.ajax({
            url: '/ajax/get_child_category',
            type: "GET",
            data: {
                ca_idx
            },
            error: function (request, status, error) {
                alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
            },
            success: function (response, textStatus) {
                let data = response.category_list;
                let count_child = response.count_child;

                $(".cars_category_depth_" + previous_depth).nextAll().remove();

                if (data.length > 0) {
                    let html = ``;
                    if (count_child > 0) {

                        if (code_first == "5406") {
                            html += `<p class="ttl_category_depth_child">골프장 선택</p>`;
                        } else {
                            html += `<p class="ttl_category_depth_child">상세상품을 선택해주세요</p>`;
                        }

                        html += `<ul class="section_vehicle_2_2__head__tabs cars_category_depth_${depth}">`;
                        for (let i = 0; i < data.length; i++) {

                            html += `<li class="section_vehicle_2_2__head__tabs__item category_item ${i == 0 ? "active" : ''}" onclick="get_depth_category(this, ${depth + 1});" data-ca_idx="${data[i]["ca_idx"]}" data-golf_code = "${data[i]["code_no"]}" onmouseenter="showProductList(this)" 
                                        onmouseleave="hideProductList()">
                                        <a href="#!">${data[i]["code_name"]}</a>
                                    </li>`;
                        }

                        html += `</ul>`;
                    } else {
                        if (code_first == "5401") {
                            html += `<p class="ttl_category_depth_child">왕복/편도 여부를 선택해주세요.</p>`;
                        } else if (code_first == "5406") {
                            html += `<div class="ttl_category_depth_child spe">홀수 선택 <div class="section_vehicle_golf_choose"> </div></div>`;
                        } else {
                            html += `<p class="ttl_category_depth_child">상세상품을 선택해주세요</p>`;
                        }

                        html += `<ul class="section_vehicle_2_2__airport cars_category_depth_${depth}">`;

                        if (code_first == "5401" && depth == 3) {
                            for (let i = 0; i < data.length; i++) {
                                html += `<span>
                                            <input ${data[i]["code_name"].trim() == "편도" ? "checked" : ""} type="radio" id="airport${data[i]["ca_idx"]}" onclick="get_cars_product(this);" name="airport" value="${data[i]["ca_idx"]}">
                                            <label for="airport${data[i]["ca_idx"]}">${data[i]["code_name"]}</label>
                                        </span>`;
                            }
                        } else {
                            for (let i = 0; i < data.length; i++) {
                                html += `<span>
                                            <input ${i == 0 ? "checked" : ""} type="radio" id="airport${data[i]["ca_idx"]}" onclick="get_cars_product(this);" name="airport" value="${data[i]["ca_idx"]}">
                                            <label for="airport${data[i]["ca_idx"]}">${data[i]["code_name"]}</label>
                                        </span>`;
                            }
                        }


                        html += `</ul>`;
                    }

                    $(".cars_category_depth_" + previous_depth).after(html);

                    get_depth_category($(".cars_category_depth_" + depth + " .section_vehicle_2_2__head__tabs__item.active"), depth + 1);
                } else {
                    get_cars_product($(".section_vehicle_2_2__airport input[type='radio']:checked"));
                }
            }
        });

    }

    function renderPrdList(products, ca_idx) {
        let product_list = "";

        for (let i = 0; i < products.length; i++) {
            let img = "";
            if (products[i]["ufile1"]) {
                img = '/data/cars/' + products[i]["ufile1"];
            } else {
                img = '/data/product/noimg.png';
            }
            const options = products[i]["options"].map((option, index) => {
                let html = "";
                let icons = option.icons.map(icon => `<img src="/data/code/${icon}" alt="">`).join('');
                if (index % 2 == 0) {
                    html += `
                    <tr>
                        <td class="">${icons}</td>
                        <td class="vehicle_info__item">${option.c_op_name}</td>`;
                }
                if (index % 2 == 1) {
                    html += `
                        <td class="vehicle_info__item">또는</td>
                        <td class="">${icons}</td>
                        <td class="vehicle_info__item">${option.c_op_name}</td>
                    </tr>
                    `;
                }
                return html;
            }).join('');
            const minium_cars_cnt = Number(products[i]["minium_people_cnt"]) ?? 0;
            const total_cars_cnt = Number(products[i]["total_people_cnt"]) ?? 0;

            const adult_cnt = Number(products[i]["adult_people_cnt"]) ?? 0;
            const people_cnt = Number(products[i]["people_cnt"]) ?? 0;

            let vehicle_select = $(`#product_vehicle_list_selected tr.product_${products[i]["cp_idx"]}`);
            let cnt_options = ``;
            if (total_cars_cnt >= minium_cars_cnt) {
                cnt_options = Array(total_cars_cnt - minium_cars_cnt + 1).fill(1).map((_, index) => {
                    const cnt = minium_cars_cnt + index;
                    let selected = "";
                    if (vehicle_select && vehicle_select.data("cnt") == cnt) {
                        selected = "selected";
                    }
                    return `<option value="${cnt}" ${selected}>${cnt}대</option>`
                }).join('');
            } else {
                cnt_options = `<option value="0">0대</option>`;
            }

            const price_str = Math.round(products[i]["sale_price"]);

            const price_won_str = Math.round(products[i]["car_price_won"]);

            product_list +=
                `<tr class="product_${products[i]["cp_idx"]}" data-product_idx="${products[i]["product_idx"]}" data-price="${price_str}" data-price_won="${price_won_str}" data-ca_idx="${ca_idx}">
                <td>
                    <div class="vehicle_image">
                        <div class="img_box img_box_15">
                            <img src="${img}" alt="${products[i]["rfile1"]}">
                        </div>
                    </div>
                </td>
                <td>
                    <div class="vehicle_info">
                        <h4 class="vehicle_info__name ${products[i]["product_idx"]}">
                            ${products[i]["product_name"]}  ${products[i]["vehicle_info"] ? `<span>(${products[i]["vehicle_info"]})</span>` : ''}
                        </h4>
                        <table>
                            <colgroup>
                                <col width="10%">
                                <col width="30%">
                                <col width="10%">
                                <col width="10%">
                                <col width="40%">
                            </colgroup>
                            <tbody>
                                ${options}
                            </tbody>
                        </table>
                    </div>
                </td>
                <td>
                    <div class="vehicle_price">
                        ${price_won_str.toLocaleString('ko-KR')}<span> 원 (${price_str.toLocaleString('ko-KR')} 바트)</span>
                    </div>
                    <div class="vehicle_options">
                        <label class="vehicle_options__label__vehicle_cnt" for="vehicle_cnt">차량수량</label>
                        <select name="" id="vehicle_cnt_${products[i]["cp_idx"]}" data-id="${products[i]["cp_idx"]}" class="vehicle_options__select vehicle_cnt" onchange="handleSelectNumber(this)">
                            ${cnt_options}
                        </select>
                        <input type="hidden" id="minium_people_cnt_${products[i]["cp_idx"]}" value="${minium_cars_cnt}">
                        <input type="hidden" id="total_people_cnt_${products[i]["cp_idx"]}" value="${total_cars_cnt}">
                        <input type="hidden" id="adult_cnt_${products[i]["cp_idx"]}" value="${adult_cnt}">
                        <input type="hidden" id="people_cnt_${products[i]["cp_idx"]}" value="${people_cnt}">
                        <input type="hidden" id="product_idx_${products[i]["cp_idx"]}" value="${products[i]["product_idx"]}">
                        <input type="checkbox" id="vehicle_prd_${products[i]["cp_idx"]}" class="vehicle_prd_select" data-id="${products[i]["cp_idx"]}" onchange="handleSelectVehicle(this)">
                        <label class="vehicle_options__label__vehicle_prd" for="vehicle_prd_${products[i]["cp_idx"]}"></label>
                        <button>상품담기</button>
                    </div>
                </td>
            </tr>`;
        }

        $("#product_vehicle_list").html(product_list);

    }

    function get_cars_product(radio) {
        let ca_idx = $(radio).val();

        $.ajax({
            url: '/ajax/get_cars_product',
            type: "GET",
            data: {
                ca_idx
            },
            async: false,
            cache: false,
            success: function (data, textStatus) {
                let products = data;

                renderPrdList(products, ca_idx);

                $("#cp_idx").val("");
                $("#product_vehicle_list_selected").empty();
                $(".section_vehicle_2_7").hide();
                $(".section_vehicle_info_wrap").empty();
                calculatePrice();
            },
            error: function (request, status, error) {
                alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
            }
        });
    }

    function calculatePrice() {
        let totalPrice = 0;
        let totalPriceWon = 0;
        let totalCnt = 0;
        let arr_cnt = [];
        $("#product_vehicle_list_selected > tr").each(function () {

            const price = Number($(this).data("price")) ?? 0;
            const price_won = Number($(this).data("price_won")) ?? 0;
            const cnt = Number($(this).data("cnt")) ?? 0;

            totalPrice += price * cnt;
            totalPriceWon += price_won * cnt;
            totalCnt += cnt;
            arr_cnt.push(cnt);
        });

        $("#inital_price").val(totalPriceWon);
        $("#order_price").val(totalPriceWon);
        $("#product_cnt").val(arr_cnt.join(","));
        $("#total_cnt").text(totalCnt);
        $("#all_price").text(totalPriceWon.toLocaleString('ko-KR'));
        $("#all_price_baht").text(totalPrice.toLocaleString('ko-KR'));
        $("#final_price").text(totalPriceWon.toLocaleString('ko-KR'));
        $("#final_price_baht").text(totalPrice.toLocaleString('ko-KR'));
    }

    var previousCarsCnt;
    var previousAdultCnt;
    var previousPeopleCnt;
    var arr_days = ['일', '월', '화', '수', '목', '금', '토'];

    function handleSelectNumber(e) {
        let id = $(e).data("id");
        let cnt = $(e).val();

        if (Number(cnt) === 0) {
            alert("0보다 큰 수량을 선택하세요.");
            $(e).val(previousCarsCnt);
            return false;
        }

        previousCarsCnt = cnt;

        let selected_product = $("#product_vehicle_list").children("tr").find(".vehicle_options input[type='checkbox']:checked");

        let total_adult_cnt = Number($(`#adult_cnt_${id}`).val()) * cnt;
        let total_people_cnt = Number($(`#people_cnt_${id}`).val()) * cnt;

        let select_adult_cnt = Number($("#adult_cnt").val()) ?? 0;
        let select_child_cnt = Number($("#child_cnt").val()) ?? 0;

        if ((select_adult_cnt > total_adult_cnt && select_child_cnt == 0) || (select_adult_cnt + select_child_cnt > total_people_cnt && select_child_cnt != 0)) {
            alert("차량은 자리수 부족합니다. 다른 분류 선택하거나 수량 확인부탁드립니다");
            selected_product.prop("checked", false);
            $(".section_vehicle_2_7").hide();
            $(".section_vehicle_info_wrap").empty();
            $("#cp_idx").val("");
            $("#product_vehicle_list_selected").empty();
            calculatePrice();
            return false;
        }

        $(`#product_vehicle_list_selected tr.product_${id}`).data("cnt", cnt);
        $("#frm_number_cars").text(cnt);
        calculatePrice();

    }

    function isNextDay(time1, time2) {
        const [hour1, minute1] = time1.split(':').map(Number);
        const [hour2, minute2] = time2.split(':').map(Number);

        const totalMinutes1 = hour1 * 60 + minute1;
        const totalMinutes2 = hour2 * 60 + minute2;

        return totalMinutes2 < totalMinutes1;
    }

    function change_flight(el) {
        let value = $(el).val();
        let selected_meeting_date = $("#meeting_date").val();
        let currentDate = new Date(selected_meeting_date);

        $("#flight_code").val("");

        if (value == "other") {
            $("#flight_code").show();
        } else {
            $("#flight_code").hide();
            $("#flight_code").val(value);

            let depature_time = $(el).find("option:selected").data("depature_time");
            let destination_time = $(el).find("option:selected").data("destination_time");


            if (depature_time && destination_time) {
                let time_arr = destination_time.split(":");

                let hour = time_arr[0].trim();
                let minute = time_arr[1].trim();

                if (hour && minute) {
                    $(el).closest("table").find("#hours").val(hour);
                    $(el).closest("table").find("#minutes").val(minute);
                }

                if (isNextDay(depature_time, destination_time)) {
                    alert("차량 미팅 날짜는 새벽입니다. 미팅날짜는 공항출발다음날로 지정됩니다.");
                    currentDate.setDate(currentDate.getDate() + 1);
                }
                $(el).closest("table").find("input[name='date_trip[]']").val(currentDate.toISOString().split('T')[0]);
            }


        }

    }

    function handleEmail(email) {
        if (email == '1') {
            $("#email_2").val('').prop('readonly', false).focus();
        } else {
            $("#email_2").val(email).prop('readonly', true);
        }
    }

    function addFormReservation() {

        $('.item_check_term_').removeClass('checked_');
        $('.item_check_term_all_').removeClass('checked_');
        $('.item_check_term_').val('N');
        $('.item_check_term_all_').val('N');

        let code_no = $(".cars_category_depth_1").children(".section_vehicle_2_2__head__tabs__item.active").data("code");
        let id = $("#product_vehicle_list").children("tr").find(".vehicle_options input[type='checkbox']:checked").data("id");

        let cnt = Number($(`#product_vehicle_list tr.product_${id}`).find("select.vehicle_cnt").val());
        let adult_cnt = Number($("#adult_cnt").val()) ?? 0;
        let child_cnt = Number($("#child_cnt").val()) ?? 0;

        let arr_category_text = [];
        $(".cars_category_wrap").find(".category_item.active").each(function () {
            let cat_text = $(this).find("a").text().trim();
            arr_category_text.push(cat_text);
        });

        let last_cat_text = $(".cars_category_wrap").find(".section_vehicle_2_2__airport input[type='radio']:checked").siblings("label").text().trim();
        arr_category_text.push(last_cat_text);

        $("#category_text_list").val(arr_category_text.join(", "));

        let form_html = ``;
        form_html += `
            <div class="section_vehicle_info">
                선택상품 : ${arr_category_text.join(", ")}, <span id="frm_number_cars">${cnt}</span>대, 성인 <span id="frm_adult_cnt">${adult_cnt}</span>명, 아동 <span id="frm_child_cnt">${child_cnt}</span>명
            </div>
        `;

        $("#type_code_no").val(code_no);

        if (code_no == "5401") {

            form_html += `
                <div class="section_vehicle_table">
                    <div class="section_vehicle_2_7__head__ttl vehicle_ttl">
                        가는 편
                    </div>
                    <table>
                        <colgroup>
                            <col width="150px">
                            <col width="*">
                            <col width="150px">
                            <col width="*">
                        </colgroup>
                        <tbody> 
                            <input type="hidden" name="departure_name[]" class="s_departure_name" value="">
                            <tr>
                                <th>항공편 명</th>
                                <td colspan="3">
                                    <input type="text" name="airline_code[]" class="s_airline_code" id="flight_code" placeholder="예) KE 657">
                                </td>
                            </tr>
                            <tr>
                                <th>항공 도착 날짜</th>
                                <td colspan="3">
                                    <div class="datepicker_wrap">
                                        <input type="text" name="date_trip[]" class="date_form_trip s_date_trip">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>항공 도착 시간</th>
                                <td colspan="3">
                                    <div class="meeting_time">
                                        <select name="hours[]" class="s_hours" id="hours">
                                            <?php
                                            for ($i = 0; $i < 24; $i++) {
                                                $hour = str_pad($i, 2, '0', STR_PAD_LEFT);
                                                ?>
                                                <option value="<?= $hour ?>"><?= $hour ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        <label for="hours">시</label>
                                        <select name="minutes[]" class="s_minutes" id="minutes">
                                            <?php
                                            for ($i = 0; $i < 60; $i += 5) {
                                                $minute = str_pad($i, 2, '0', STR_PAD_LEFT);
                                                ?>
                                                <option value="<?= $minute ?>"><?= $minute ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        <label for="minutes">분</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    목적지
                                </th>
                                <td colspan="3">
                                    <div class="destination">
                                        <span class="destination_name"></span>
                                        <input type="text" name="destination_name[]" class="s_destination_name" placeholder="호텔명을 영어로 적어주세요(주소불가)">
                                    </div>
                                    <div class="departure__note">
                                        - 일반주택은 정확한 건물명, 주소, 태국어 가능한 호스트의 태국 전화번호를 남겨주세요. <br>
                                        - 예약 시 선택하신 지역과 입력하신 장소가 다른 경우, 바우처 발송 후에도 추가 요금이 발생할 수 있습니다. <br>
                                        - 윈저파크, 아티타야 등 대부분의 방콕 골프텔은 방콕 외곽 지역에 속합니다.
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>기타요청</th>
                                <td colspan="3">
                                    <textarea name="order_memo[]" id="order_memo" class="other_irregularities s_order_memo" placeholder="예약업무를 주로 현지인 직원들이 처리하므로 여기에는 가급적 영어로 요청사항을 적어주시기 바랍니다. 중요한 요청 및 한글 요청 사항은 1:1 게시판에 따로 남겨주셔야 정상적으로 처리가 가능합니다."></textarea>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            `;

            if ($(".cars_category_depth_1").siblings(".cars_category_depth_3").length > 0) {
                let text = $(".cars_category_depth_1").siblings(".cars_category_depth_3").find("input[type='radio']:checked").siblings("label").text().trim();

                $("#text_category_5401").val(text);
                if (text == "왕복") {
                    form_html += `
                        <div class="section_vehicle_table">
                            <div class="section_vehicle_2_7__head__ttl vehicle_ttl">
                                오는 편
                            </div>
                            <table>
                                <colgroup>
                                    <col width="150px">
                                    <col width="*">
                                    <col width="150px">
                                    <col width="*">
                                </colgroup>
                                <tbody>
                                    <input type="hidden" class="e_destination_name" name="destination_name[]" value="">
                                    <tr>
                                        <th>차량 미팅 날짜</th>
                                        <td colspan="3">
                                            <div class="datepicker_wrap">
                                                <input type="text" name="date_trip[]" class="date_form e_date_trip">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>미팅 시간</th>
                                        <td colspan="3">
                                            <div class="meeting_time">
                                                <select name="hours[]" class="e_hours" id="hours">
                                                    <?php
                                                    for ($i = 0; $i < 24; $i++) {
                                                        $hour = str_pad($i, 2, '0', STR_PAD_LEFT);
                                                        ?>
                                                        <option value="<?= $hour ?>"><?= $hour ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                                <label for="hours">시</label>
                                                <select name="minutes[]" class="e_minutes" id="minutes">
                                                    <?php
                                                    for ($i = 0; $i < 60; $i += 5) {
                                                        $minute = str_pad($i, 2, '0', STR_PAD_LEFT);
                                                        ?>
                                                        <option value="<?= $minute ?>"><?= $minute ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                                <label for="minutes">분</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            미팅 장소
                                        </th>
                                        <td colspan="3">
                                            <div class="departure">
                                                <span class="departure_name"></span>
                                                <input type="text" name="departure_name[]" class="e_departure_name" placeholder="호텔명을 영어로 적어주세요(주소불가)">
                                            </div>
                                            <div class="departure__note">
                                                - 일반주택은 정확한 건물명, 주소, 태국어 가능한 호스트의 태국 전화번호를 남겨주세요. <br>
                                                - 예약 시 선택하신 지역과 입력하신 장소가 다른 경우, 바우처 발송 후에도 추가 요금이 발생할 수 있습니다. <br>
                                                - 윈저파크, 아티타야 등 대부분의 방콕 골프텔은 방콕 외곽 지역에 속합니다.
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            항공편 명
                                        </th>
                                        <td colspan="3">
                                            <input type="text" name="airline_code[]" class="e_airline_code" placeholder="예) KE658">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>기타요청</th>
                                        <td colspan="3">
                                            <textarea name="order_memo[]" id="order_memo" class="other_irregularities e_order_memo" placeholder="예약업무를 주로 현지인 직원들이 처리하므로 여기에는 가급적 영어로 요청사항을 적어주시기 바랍니다. 중요한 요청 및 한글 요청 사항은 1:1 게시판에 따로 남겨주셔야 정상적으로 처리가 가능합니다."></textarea>
                                        </td>
                                    </tr>     
                                </tbody>
                            </table>
                        </div>
                    `;
                }

            }
        } else if (code_no == "5402") {
            form_html += `
                <div class="section_vehicle_table">
                    <table>
                        <colgroup>
                            <col width="150px">
                            <col width="*">
                            <col width="150px">
                            <col width="*">
                        </colgroup>
                        <tbody>
                            <tr>
                                <th>차량 미팅 날짜</th>
                                <td colspan="3">
                                    <div class="datepicker_wrap">
                                        <input type="text" name="date_trip[]" class="date_form s_date_trip">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>미팅 시간</th>
                                <td colspan="3">
                                    <div class="meeting_time">
                                        <select name="hours[]" class="s_hours" id="hours">
                                            <?php
                                            for ($i = 0; $i < 24; $i++) {
                                                $hour = str_pad($i, 2, '0', STR_PAD_LEFT);
                                                ?>
                                                <option value="<?= $hour ?>"><?= $hour ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        <label for="hours">시</label>
                                        <select name="minutes[]" class="s_minutes" id="minutes">
                                            <?php
                                            for ($i = 0; $i < 60; $i += 5) {
                                                $minute = str_pad($i, 2, '0', STR_PAD_LEFT);
                                                ?>
                                                <option value="<?= $minute ?>"><?= $minute ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        <label for="minutes">분</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    미팅 장소
                                </th>
                                <td colspan="3">
                                    <div class="departure">
                                        <span class="departure_name"></span>
                                        <input type="text" name="departure_name[]" class="s_departure_name" placeholder="호텔명을 영어로 적어주세요(주소불가)">
                                    </div>
                                    <div class="departure__note">
                                        - 일반주택은 정확한 건물명, 주소, 태국어 가능한 호스트의 태국 전화번호를 남겨주세요. <br>
                                        - 예약 시 선택하신 지역과 입력하신 장소가 다른 경우, 바우처 발송 후에도 추가 요금이 발생할 수 있습니다. <br>
                                        - 윈저파크, 아티타야 등 대부분의 방콕 골프텔은 방콕 외곽 지역에 속합니다.
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    항공편 명
                                </th>
                                <td colspan="3">
                                    <input type="text" name="airline_code[]" class="s_airline_code" placeholder="예) KE658">
                                </td>
                            </tr>
                            <tr>
                                <th>기타 요청</th>
                                <td colspan="3">
                                    <textarea name="order_memo[]" class="other_irregularities s_order_memo" id="order_memo" placeholder="예약업무를 주로 현지인 직원들이 처리하므로 여기에는 가급적 영어로 요청사항을 적어주시기 바랍니다. 중요한 요청 및 한글 요청 사항은 1:1 게시판에 따로 남겨주셔야 정상적으로 처리가 가능합니다."></textarea>
                                </td>
                            </tr>     
                        </tbody>
                    </table>
                </div>
            `;
        } else if (code_no == "5403") {
            let start_date_text = $("#meeting_date").val();
            let end_date_text = $("#return_date").val();
            if (start_date_text && end_date_text) {
                const startDate = new Date(start_date_text);
                const endDate = new Date(end_date_text);

                const differenceInTime = endDate - startDate;

                let differenceInDays = (differenceInTime / (1000 * 60 * 60 * 24)) + 1;

                let currentDate = new Date(startDate);
                let i = 1;
                while (currentDate <= endDate) {
                    let day = arr_days[currentDate.getDay()];
                    form_html += `
                        <div class="section_vehicle_table">
                            <div class="section_vehicle_2_7__head__ttl vehicle_ttl">
                                <span class="schedule_ttl">${i} 일차</span> 일정을 입력해주세요
                            </div>
                            <table>
                                <colgroup>
                                    <col width="150px">
                                    <col width="*">
                                    <col width="150px">
                                    <col width="*">
                                </colgroup>
                                <tbody>
                                    <tr>
                                        <th>차량 출발시간</th>
                                        <td colspan="3">
                                            <div class="meeting_time">
                                                <input type="hidden" name="date_trip[]" class="s_date_trip" value="${currentDate.toISOString().split('T')[0]}">
                                                <span class="meeting_time__date">${currentDate.toISOString().split('T')[0]}(${day})</span>
                                                <select name="hours[]" class="s_hours" id="hours">
                                                    <?php
                                                    for ($i = 0; $i < 24; $i++) {
                                                        $hour = str_pad($i, 2, '0', STR_PAD_LEFT);
                                                        ?>
                                                        <option value="<?= $hour ?>"><?= $hour ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                                <label for="hours">시</label>
                                                <select name="minutes[]" class="s_minutes" id="minutes">
                                                    <?php
                                                    for ($i = 0; $i < 60; $i += 5) {
                                                        $minute = str_pad($i, 2, '0', STR_PAD_LEFT);
                                                        ?>
                                                        <option value="<?= $minute ?>"><?= $minute ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                                <label for="minutes">분</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            출발지
                                        </th>
                                        <td colspan="3">
                                            <div class="departure">
                                                <span class="departure_name"></span>
                                                <input type="text" name="departure_name[]" class="s_departure_name" placeholder="호텔명을 영어로 적어주세요(주소불가)">
                                            </div>
                                            <div class="departure__note">
                                                - 일반주택은 정확한 건물명, 주소, 태국어 가능한 호스트의 태국 전화번호를 남겨주세요. <br>
                                                - 예약 시 선택하신 지역과 입력하신 장소가 다른 경우, 바우처 발송 후에도 추가 요금이 발생할 수 있습니다. <br>
                                                - 윈저파크, 아티타야 등 대부분의 방콕 골프텔은 방콕 외곽 지역에 속합니다.
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            이동루트
                                        </th>
                                        <td colspan="3">
                                            <textarea name="schedule_content[]" placeholder="가급적 영어로 적어주세요. 사전에 고지되지 않은 코스를 추가하실 때에는 추가 요금이 발생할 수 있으니 가급적 일정을 상세히 적어 주시기 바랍니다." class="other_irregularities schedule_content s_schedule_content"></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>기타요청</th>
                                        <td colspan="3">
                                            <textarea name="order_memo[]" placeholder="예약업무를 주로 현지인 직원들이 처리하므로 여기에는 가급적 영어로 요청사항을 적어주시기 바랍니다. 중요한 요청 및 한글 요청 사항은 1:1 게시판에 따로 남겨주셔야 정상적으로 처리가 가능합니다." class="other_irregularities order_memo s_order_memo"></textarea>
                                        </td>
                                    </tr>     
                                </tbody>
                            </table>
                        </div>
                    `;
                    i++;
                    currentDate.setDate(currentDate.getDate() + 1);
                }
            }

        } else if (code_no == "5404") {
            let startDate = $("#meeting_date").val();
            let currentDate = new Date(startDate);
            let day = arr_days[currentDate.getDay()];
            form_html += `
                <div class="section_vehicle_table">
                    <table>
                        <colgroup>
                            <col width="150px">
                            <col width="*">
                            <col width="150px">
                            <col width="*">
                        </colgroup>
                        <tbody>
                            <tr>
                                <th>차량 출발시간</th>
                                <td colspan="3">
                                    <div class="meeting_time">
                                        <input type="hidden" name="date_trip[]" class="s_date_trip" value="${currentDate.toISOString().split('T')[0]}">
                                        <span class="meeting_time__date">${currentDate.toISOString().split('T')[0]}(${day})</span>
                                        <select name="hours[]" class="s_hours" id="hours">
                                            <?php
                                            for ($i = 0; $i < 24; $i++) {
                                                $hour = str_pad($i, 2, '0', STR_PAD_LEFT);
                                                ?>
                                                <option value="<?= $hour ?>"><?= $hour ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        <label for="hours">시</label>
                                        <select name="minutes[]" class="s_minutes" id="minutes">
                                            <?php
                                            for ($i = 0; $i < 60; $i += 5) {
                                                $minute = str_pad($i, 2, '0', STR_PAD_LEFT);
                                                ?>
                                                <option value="<?= $minute ?>"><?= $minute ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        <label for="minutes">분</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    출발지(픽업호텔)
                                </th>
                                <td colspan="3">
                                    <div class="departure">
                                        <span class="departure_name"></span>
                                        <input type="text" name="departure_name[]" class="s_departure_name" placeholder="호텔명을 영어로 적어주세요(주소불가)">
                                    </div>
                                    <div class="departure__note">
                                        - 일반주택은 정확한 건물명, 주소, 태국어 가능한 호스트의 태국 전화번호를 남겨주세요. <br>
                                        - 예약 시 선택하신 지역과 입력하신 장소가 다른 경우, 바우처 발송 후에도 추가 요금이 발생할 수 있습니다. <br>
                                        - 윈저파크, 아티타야 등 대부분의 방콕 골프텔은 방콕 외곽 지역에 속합니다.
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    경유지
                                </th>
                                <td colspan="3">
                                    <input type="text" name="rest_name[]" class="s_rest_name" placeholder="가급적 영어로 적어주세요.">
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    목적지
                                </th>
                                <td colspan="3">
                                    <input type="text" name="destination_name[]" class="s_destination_name" placeholder="가급적 영어로 적어주세요.">
                                </td>
                            </tr>
                            <tr>
                                <th>기타요청</th>
                                <td colspan="3">
                                    <textarea name="order_memo[]" placeholder="예약업무를 주로 현지인 직원들이 처리하므로 여기에는 가급적 영어로 요청사항을 적어주시기 바랍니다. 중요한 요청 및 한글 요청 사항은 1:1 게시판에 따로 남겨주셔야 정상적으로 처리가 가능합니다." class="other_irregularities order_memo s_order_memo"></textarea>
                                </td>
                            </tr>     
                        </tbody>
                    </table>
                </div>
            `;
        } else if (code_no == "5405") {
            let startDate = $("#meeting_date").val();
            let currentDate = new Date(startDate);
            let day = arr_days[currentDate.getDay()];
            form_html += `
                <div class="section_vehicle_table">
                    <table>
                        <colgroup>
                            <col width="150px">
                            <col width="*">
                            <col width="150px">
                            <col width="*">
                        </colgroup>
                        <tbody>
                            <tr>
                                <th>미팅 시간</th>
                                <td colspan="3">
                                    <div class="meeting_time">
                                        <input type="hidden" name="date_trip[]" class="s_date_trip" value="${currentDate.toISOString().split('T')[0]}">
                                        <span class="meeting_time__date">${currentDate.toISOString().split('T')[0]}(${day})</span>
                                        <select name="hours[]" class="s_hours" id="hours">
                                            <?php
                                            for ($i = 0; $i < 24; $i++) {
                                                $hour = str_pad($i, 2, '0', STR_PAD_LEFT);
                                                ?>
                                                <option value="<?= $hour ?>"><?= $hour ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        <label for="hours">시</label>
                                        <select name="minutes[]" class="s_minutes" id="minutes">
                                            <?php
                                            for ($i = 0; $i < 60; $i += 5) {
                                                $minute = str_pad($i, 2, '0', STR_PAD_LEFT);
                                                ?>
                                                <option value="<?= $minute ?>"><?= $minute ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        <label for="minutes">분</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    출발지(픽업호텔)
                                </th>
                                <td colspan="3">
                                    <div class="departure">
                                        <span class="departure_name"></span>
                                        <input type="text" name="departure_name[]" class="s_departure_name" placeholder="호텔명을 영어로 적어주세요(주소불가)">
                                    </div>
                                    <div class="departure__note">
                                        - 일반주택은 정확한 건물명, 주소, 태국어 가능한 호스트의 태국 전화번호를 남겨주세요. <br>
                                        - 예약 시 선택하신 지역과 입력하신 장소가 다른 경우, 바우처 발송 후에도 추가 요금이 발생할 수 있습니다. <br>
                                        - 윈저파크, 아티타야 등 대부분의 방콕 골프텔은 방콕 외곽 지역에 속합니다.
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    목적지
                                </th>
                                <td colspan="3">
                                    <div class="destination">
                                        <span class="destination_name"></span>
                                        <input type="text" name="destination_name[]" class="s_destination_name" placeholder="호텔명을 영어로 적어주세요(주소불가)">
                                    </div>
                                    <div class="departure__note">
                                        - 일반주택은 정확한 건물명, 주소, 태국어 가능한 호스트의 태국 전화번호를 남겨주세요. <br>
                                        - 예약 시 선택하신 지역과 입력하신 장소가 다른 경우, 바우처 발송 후에도 추가 요금이 발생할 수 있습니다. <br>
                                        - 윈저파크, 아티타야 등 대부분의 방콕 골프텔은 방콕 외곽 지역에 속합니다.
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>기타요청</th>
                                <td colspan="3">
                                    <textarea name="order_memo[]" placeholder="예약업무를 주로 현지인 직원들이 처리하므로 여기에는 가급적 영어로 요청사항을 적어주시기 바랍니다. 중요한 요청 및 한글 요청 사항은 1:1 게시판에 따로 남겨주셔야 정상적으로 처리가 가능합니다." class="other_irregularities order_memo s_order_memo"></textarea>
                                </td>
                            </tr>     
                        </tbody>
                    </table>
                </div>
            `;
        } else {
            let startDate = $("#meeting_date").val();
            let currentDate = new Date(startDate);
            let day = arr_days[currentDate.getDay()];
            form_html += `
                <div class="section_vehicle_table">
                    <table>
                        <colgroup>
                            <col width="150px">
                            <col width="*">
                            <col width="150px">
                            <col width="*">
                        </colgroup>
                        <tbody>
                            <tr>
                                <th>미팅 시간</th>
                                <td colspan="3">
                                    <div class="meeting_time">
                                        <input type="hidden" name="date_trip[]" class="s_date_trip" value="${currentDate.toISOString().split('T')[0]}">
                                        <span class="meeting_time__date">${currentDate.toISOString().split('T')[0]}(${day})</span>
                                        <select name="hours[]" class="s_hours" id="hours">
                                            <?php
                                            for ($i = 0; $i < 24; $i++) {
                                                $hour = str_pad($i, 2, '0', STR_PAD_LEFT);
                                                ?>
                                                <option value="<?= $hour ?>"><?= $hour ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        <label for="hours">시</label>
                                        <select name="minutes[]" class="s_minutes" id="minutes">
                                            <?php
                                            for ($i = 0; $i < 60; $i += 5) {
                                                $minute = str_pad($i, 2, '0', STR_PAD_LEFT);
                                                ?>
                                                <option value="<?= $minute ?>"><?= $minute ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        <label for="minutes">분</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    출발지(픽업호텔)
                                </th>
                                <td colspan="3">
                                    <div class="departure">
                                        <span class="departure_name"></span>
                                        <input type="text" name="departure_name[]" class="s_departure_name" placeholder="호텔명을 영어로 적어주세요(주소불가)">
                                    </div>
                                    <div class="departure__note">
                                        - 일반주택은 정확한 건물명, 주소, 태국어 가능한 호스트의 태국 전화번호를 남겨주세요. <br>
                                        - 예약 시 선택하신 지역과 입력하신 장소가 다른 경우, 바우처 발송 후에도 추가 요금이 발생할 수 있습니다. <br>
                                        - 윈저파크, 아티타야 등 대부분의 방콕 골프텔은 방콕 외곽 지역에 속합니다.
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    목적지(골프장명)
                                </th>
                                <td colspan="3">
                                    <input type="text" name="destination_name[]" class="s_destination_name" placeholder="가급적 영어로 적어주세요.">
                                </td>
                            </tr>
                            <tr>
                                <th>기타 요청</th>
                                <td colspan="3">
                                    <textarea name="order_memo[]" class="other_irregularities order_memo s_order_memo" placeholder="예약업무를 주로 현지인 직원들이 처리하므로 여기에는 가급적 영어로 요청사항을 적어주시기 바랍니다. 중요한 요청 및 한글 요청 사항은 1:1 게시판에 따로 남겨주셔야 정상적으로 처리가 가능합니다."></textarea>
                                </td>
                            </tr>     
                        </tbody>
                    </table>
                </div>
            `;
        }

        $(".cart_info_pop .popup_vehicle_wrap").html(form_html);

        if (code_no == "5401") {
            let ca_idx = $(".cars_category_depth_2").children(".section_vehicle_2_2__head__tabs__item.active").data("ca_idx");

            $("#ca_idx_5401").val(ca_idx);

            $.ajax({
                url: '/ajax/get_flight',
                type: "GET",
                data: {
                    ca_idx
                },
                error: function (request, status, error) {
                    alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                },
                success: function (response, textStatus) {
                    let data = response.flight_list;

                    let html = `<option value="">항공편 명을 선택해주세요.</option>`;

                    for (let i = 0; i < data.length; i++) {

                        html += `<option value="${data[i].code_flight}" data-id="${data[i].cf_idx}" data-depature_time="${data[i].f_depature_time}" data-destination_time="${data[i].f_destination_time}">
                                ${data[i].airline_name} ${data[i].code_flight}(${data[i].f_depature_name} ${data[i].f_depature_time} - ${data[i].f_destination_name} ${data[i].f_destination_time})
                                </option>`;
                    }

                    html += `<option value="other">직접입력</option>`;

                    $("#flight_arr").html(html);

                }
            });

        }

        let selected_meeting_date = $("#meeting_date").val();

        if (code_no == "5401") {
            $(".date_form_trip").val(selected_meeting_date);

            let currentDate = new Date(selected_meeting_date);

            currentDate.setDate(currentDate.getDate() + 1);

            let nextDate = currentDate.toISOString().split('T')[0];

            // $(".date_form_trip").datepicker({
            //     dateFormat: "yy-mm-dd",
            //     showOn: "both",
            //     buttonImage: "/images/ico/date_ico.png",
            //     buttonImageOnly: true,
            //     minDate: new Date(selected_meeting_date),
            //     maxDate: new Date(nextDate)
            // });
        }

        $(".date_form").val(selected_meeting_date);
        $(".date_form").datepicker({
            dateFormat: "yy-mm-dd",
            showOn: "both",
            buttonImage: "/images/ico/date_ico.png",
            buttonImageOnly: true,
            minDate: new Date(selected_meeting_date)
        });

        let departure_name = $(".place_chosen__start_pop .popup_place__list li span.active").text();
        let destination_name = $(".place_chosen__end_pop .popup_place__list li span.active").text();
        $(".departure_name").text(departure_name);
        $(".destination_name").text(destination_name);

        $(".ip_only_ko").on("input", function () {
            $(this).val($(this).val().replace(/[^가-힣\s]/g, ""));
        });

        $(".ip_only_en").on("input", function () {
            $(this).val($(this).val().replace(/[^a-zA-Z\s]/g, ""));
        });
    }

    function handleSelectVehicle(e) {

        $(e).closest("tr").siblings().find(".vehicle_options input[type='checkbox']").prop("checked", false);

        let id = $(e).data("id");

        $("#cp_idx").val("");
        $("#product_vehicle_list_selected").empty();
        $(".section_vehicle_2_7").hide();
        $(".section_vehicle_info_wrap").empty();

        const min_cnt = Number($(`#minium_people_cnt_${id}`).val());
        const max_cnt = Number($(`#total_people_cnt_${id}`).val());
        let cnt = Number($(`#product_vehicle_list tr.product_${id}`).find("select.vehicle_cnt").val());

        let total_adult_cnt = Number($(`#adult_cnt_${id}`).val()) * cnt;
        let total_people_cnt = Number($(`#people_cnt_${id}`).val()) * cnt;

        let select_adult_cnt = Number($("#adult_cnt").val()) ?? 0;
        let select_child_cnt = Number($("#child_cnt").val()) ?? 0;

        if (max_cnt - min_cnt <= 0) {
            alert("제품 수량이 충분하지 않습니다.");
            $(e).prop("checked", false);
            calculatePrice();
            return false;
        }

        if (cnt === 0) {
            alert("0보다 큰 수량을 선택하세요.");
            $(e).prop("checked", false);
            calculatePrice();
            return false;
        }

        if ((select_adult_cnt > total_adult_cnt && select_child_cnt == 0) || (select_adult_cnt + select_child_cnt > total_people_cnt && select_child_cnt != 0)) {
            alert("차량은 자리수 부족합니다. 다른 분류 선택하거나 수량 확인부탁드립니다");
            $(e).prop("checked", false);
            calculatePrice();
            return false;
        }

        let cp_idx = $("#cp_idx").val();

        let product_idx_c = $(`#product_idx_${id}`).val();

        if ($(e).is(":checked")) {

            if (cp_idx != id) {
                const $tr = $(`#product_vehicle_list tr.product_${id}`).clone();
                $tr.find(".vehicle_options").hide();
                $tr.find("button").attr("disabled", true);
                $tr.data("cnt", $(`#product_vehicle_list tr.product_${id}`).find("select.vehicle_cnt").val());
                $("#product_vehicle_list_selected").html($tr);

                addFormReservation();

                $(".section_vehicle_2_7").show();

                cp_idx = id;
            }

        } else {
            $(`#product_vehicle_list_selected .product_${id}`).remove();
            cp_idx = "";
        }
        $("#cp_idx").val(cp_idx);
        // $(".vehicle_ttl__link").attr("data-product-idx", product_idx_c);

        calculatePrice();
    }
</script>

<script>
    initCars();

    function initCars() {
        get_destination();
    }
</script>

<script>
    function closePopup() {
        $(".popup_wrap").hide();
        // $(".dim").hide();
    }

    function init_datepicker() {
        let today = new Date();
        let departureDate = new Date($("#meeting_date").val());
        let destinationDate = new Date($("#return_date").val());
        let code_no = $(".cars_category_depth_1").children(".section_vehicle_2_2__head__tabs__item.active").data("code");

        $("#departure_date").datepicker({
            dateFormat: "yy-mm-dd",
            minDate: today,
            onSelect: function (dateText, inst) {
                departureDate = $(this).datepicker('getDate');

                const year = String(departureDate.getFullYear()).slice(-2);
                const month = String(departureDate.getMonth() + 1).padStart(2, '0');
                const day = String(departureDate.getDate()).padStart(2, '0');
                const dayOfWeek = daysOfWeek[departureDate.getDay()];

                $("#departure_date_text").text(`${year}.${month}.${day}(${dayOfWeek})`);
                $(".meeting_time__date").text(`${departureDate.getFullYear()}-${month}-${day}(${dayOfWeek})`);
                $("#meeting_date").val(`${departureDate.getFullYear()}-${month}-${day}`);

                let returnDateVal = $("#return_date").val();
                let returnDate = returnDateVal ? new Date(returnDateVal) : null;

                if (returnDate < departureDate) {
                    destinationDate = new Date(departureDate);
                    const fullYear = departureDate.getFullYear();
                    $("#return_date").val(`${fullYear}-${month}-${day}`);
                    $("#destination_date_text").text(`${year}.${month}.${day}(${dayOfWeek})`);
                    $("#destination_date").datepicker('setDate', destinationDate);
                }

                $("#destination_date").datepicker('option', 'minDate', departureDate);
                calculate_days(departureDate, destinationDate);

                $(".section_vehicle_info_wrap").empty();
                addFormReservation();
            },
            beforeShowDay: function (date) {
                if (code_no != "5403" && code_no != "5401" && code_no != "5402" && code_no != "5404" && code_no != "5405" && code_no != "5406" && code_no != "" && destinationDate && date > destinationDate) {
                    return [false, 'ui-state-disabled'];
                }
                return [true, ''];
            }
        });

        $("#destination_date").datepicker({
            dateFormat: "yy-mm-dd",
            minDate: today,
            onSelect: function (dateText, inst) {
                destinationDate = $(this).datepicker('getDate');

                const year = String(destinationDate.getFullYear()).slice(-2);
                const month = String(destinationDate.getMonth() + 1).padStart(2, '0');
                const day = String(destinationDate.getDate()).padStart(2, '0');
                const dayOfWeek = daysOfWeek[destinationDate.getDay()];

                $("#destination_date_text").text(`${year}.${month}.${day}(${dayOfWeek})`);
                $("#return_date").val(`${destinationDate.getFullYear()}-${month}-${day}`);

                $("#departure_date").datepicker('option', 'maxDate', null);

                calculate_days(departureDate, destinationDate);

                $(".section_vehicle_info_wrap").empty();
                addFormReservation();
            },
            beforeShowDay: function (date) {
                if (date < today) {
                    return [false, 'ui-state-disabled'];
                }
                if (code_no != "5403" && code_no != "5401" && code_no != "5402" && code_no != "5404" && code_no != "5405" && code_no != "5406"
                    && departureDate && date < departureDate) {
                    return [false, 'ui-state-disabled'];
                }
                return [true, ''];
            }
        });
    }

    function calculate_days(departureDate, destinationDate) {
        if (departureDate && destinationDate) {
            let startDate = moment(departureDate);
            let endDate = moment(destinationDate);

            let daysDiff = endDate.diff(startDate, 'days');
            daysDiff = daysDiff + 1;
            $("#day_range_total").val(daysDiff);
            $("#day_range_text").text(daysDiff);
        }
    }

    $("#place_chosen__start").on("click", function () {
        $(".place_chosen__start_pop, .place_chosen__start_pop .dim").show();
    });

    $("#place_chosen__end").on("click", function () {
        $(".place_chosen__end_pop, .place_chosen__end_pop .dim").show();
    });

    // $(".vehicle_ttl__link").on("click", function() {
    //     $(".policy_pop, .policy_pop .dim").show();
    // });

    $(".date_form").datepicker({
        dateFormat: "yy-mm-dd",
        showOn: "both",
        buttonImage: "/images/ico/date_ico.png",
        buttonImageOnly: true
    });

    $("#place_chosen__people").on("click", function () {
        $(".place_chosen__people_pop").toggle();
    });

    $(".btn_minus").on("click", function () {
        const val = Number($(this).parent().find("input").val()) || 0;
        if (val === 1) {
            $(this).attr("disabled", true);
        }
        if (val > 0) {
            $(this).parent().find("input").val(val - 1);
        }
    });

    $(".btn_plus").on("click", function () {
        const val = Number($(this).parent().find("input").val()) || 0;
        $(this).parent().find("input").val(val + 1);
        $(this).parent().find(".btn_minus").attr("disabled", false);
    });

    $("#btn_pickup_people").on("click", function () {

        $(".pickup_amount__num").each(function () {
            const name = $(this).attr("name");
            $("#people_" + name).text($(this).val());
            $("#" + name).val($(this).val());
        })

        $(".place_chosen__people_pop").hide();

        let selected_product = $("#product_vehicle_list").children("tr").find(".vehicle_options input[type='checkbox']:checked");

        if (selected_product.length > 0) {
            let id = selected_product.data("id");

            let cnt = Number($(`#product_vehicle_list tr.product_${id}`).find("select.vehicle_cnt").val());

            let total_adult_cnt = Number($(`#adult_cnt_${id}`).val()) * cnt;
            let total_people_cnt = Number($(`#people_cnt_${id}`).val()) * cnt;

            let select_adult_cnt = Number($("#adult_cnt").val()) ?? 0;
            let select_child_cnt = Number($("#child_cnt").val()) ?? 0;

            $("#frm_adult_cnt").text(select_adult_cnt);
            $("#frm_child_cnt").text(select_child_cnt);

            if ((select_adult_cnt > total_adult_cnt && select_child_cnt == 0) || (select_adult_cnt + select_child_cnt > total_people_cnt && select_child_cnt != 0)) {
                alert("차량은 자리수 부족합니다. 다른 분류 선택하거나 수량 확인부탁드립니다");
                selected_product.prop("checked", false);
                $("#cp_idx").val("");
                $("#product_vehicle_list_selected").empty();
                $(".section_vehicle_2_7").hide();
                $(".section_vehicle_info_wrap").empty();
                calculatePrice();
                return false;
            }

        }

    });

    $("#add_cart").on("click", function () {
        let code_no = $(".cars_category_depth_1").children(".section_vehicle_2_2__head__tabs__item.active").data("code");

        if (code_no == "5401") {
            if ($(".s_destination_name").val() == "") {
                alert("목적지 입력해주세요!");
                $(this).focus();
                return false;
            }

            if ($(".e_departure_name").val() == "") {
                alert("미팅 장소 입력해주세요!");
                $(this).focus();
                return false;
            }
        } else {
            if ($(".s_departure_name").val() == "") {
                alert("미팅 장소 입력해주세요!");
                $(this).focus();
                return false;
            }

            if ($(".s_destination_name").val() == "") {
                alert("목적지 입력해주세요!");
                $(this).focus();
                return false;
            }
        }

        if ($(".s_airline_code").val() == "") {
            alert("항공편 명 선택해주세요!");
            return false;
        }

        if ($(".s_date_trip").val() == "") {
            alert("항공 도착 날짜 선택해주세요!");
            return false;
        }

        if ($(".s_hours").val() == "") {
            alert("항공 도착 시간 선택해주세요!");
            return false;
        }

        if ($(".s_minutes").val() == "") {
            alert("항공 도착 시간 선택해주세요!");
            return false;
        }

        if ($(".s_schedule_content").val() == "") {
            alert("이동루트 선택해주세요!");
            $(this).focus();
            return false;
        }

        if ($(".s_rest_name").val() == "") {
            alert("경유지 선택해주세요!");
            $(this).focus();
            return false;
        }

        if ($(".s_order_memo").val() == "") {
            alert("기타요청 입력해주세요!");
            $(this).focus();
            return false;
        }

        if ($(".e_date_trip").val() == "") {
            alert("차량 미팅 날짜 선택해주세요!");
            return false;
        }

        if ($(".e_hours").val() == "") {
            alert("미팅 시간 선택해주세요!");
            return false;
        }

        if ($(".e_hours").val() == "") {
            alert("미팅 시간 선택해주세요!");
            return false;
        }

        if ($(".s_minutes").val() == "") {
            alert("항공 도착 시간 선택해주세요!");
            return false;
        }

        if ($(".e_departure_name").val() == "") {
            alert("미팅 장소 입력해주세요!");
            $(this).focus();
            return false;
        }

        if ($(".e_airline_code").val() == "") {
            alert("항공편 명 선택해주세요!");
            return false;
        }

        if ($(".e_order_memo").val() == "") {
            alert("기타요청 입력해주세요!");
            $(this).focus();
            return false;
        }

        const $form1 = $('#frmCar');
        const $form2 = $('#frm_pop_cart');

        $form2.find('input[name], select[name], textarea[name]').each(function () {
            const $original = $(this);
            const name = $original.attr('name');
            const value = $original.val();

            $('<input>').attr({
                type: 'hidden',
                name: name,
                value: value
            }).appendTo($form1);
        });

        $.ajax({
            url: "/vehicle-guide/vehicle-order",
            type: "POST",
            data: $("#frmCar").serialize(),
            error: function (request, status, error) {
                alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
            },
            success: function (response, status, request) {
                if (response.result == true) {
                    alert(response.message);
                    window.location.href = '/product/completed-order';
                } else {
                    alert(response.message);
                }
            }
        });
    });

    $(".btn_submit, #btn_show_cart").on("click", function () {

        <?php
        if (empty(session()->get("member")["id"])) {
            ?>
            alert("주문하시려면 로그인해주세요!");
            return false;
            <?php
        }
        ?>

        let departure_name = $(".place_chosen__start_pop .popup_place__list li span.active").text();
        let destination_name = $(".place_chosen__end_pop .popup_place__list li span.active").text();

        $("#text_destination_name").val(departure_name);
        $("#text_departure_name").val(destination_name);

        $("#order_status").val($(this).val());

        var frm = document.frmCar;

        if (frm.departure_area.value == "") {
            alert("출발지역 선택해주세요!");
            return false;
        }

        if (frm.destination_area.value == "") {
            alert("출발지역 선택해주세요!");
            return false;
        }

        if (!frm.adult_cnt.value) {
            alert("성인 선택해주세요!");
            return false;
        }

        if (frm.cp_idx.value == "") {
            alert("제품을 선택해주세요!");
            return false;
        }

        addFormReservation();

        if ($(this).val() == "B") {

            $(".cart_info_pop").show();

            return false;
        }

        $("#frmCar").submit();

    });
</script>

<script>
    var swiper = new Swiper('.swiper_container_ticket', {
        slidesPerView: 1,
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        spaceBetween: 22,
        navigation: {
            nextEl: '.swiper-button-next-vehicle',
            prevEl: '.swiper-button-prev-vehicle',
        },
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        on: {
            init: function () {
                updateSlideCounter(this);
            },
            slideChange: function () {
                updateSlideCounter(this);
            }
        }
    });

    function updateSlideCounter(swiper) {
        var currentIndex = swiper.realIndex + 1;
        var totalSlides = swiper.slides.length
    }

    document.getElementById('autoplay-button')?.addEventListener('click', function () {
        var playButton = document.getElementById('play-button');
        var pauseButton = document.getElementById('pause-button');
        if (swiper.autoplay.running) {
            swiper.autoplay.stop();
            playButton.style.display = 'block';
            pauseButton.style.display = 'none';
        } else {
            swiper.autoplay.start();
            playButton.style.display = 'none';
            pauseButton.style.display = 'block';
        }
    });
</script>

<script>
let productListTimeout;

function showProductList(el) {
    const golfCode = el.dataset.golf_code;
    let code_first = "5406";

    if (code_first === "5406") {
        clearTimeout(productListTimeout);

        $.ajax({
            url: '/ajax/get_products_by_golf_code',
            type: 'GET',
            data: { golf_code: golfCode },
            success: function(response) {
                const products = response.products;
                if (!products || products.length === 0) {
                    $('#product-hover-box').remove(); 
                    return;
                }

                let html = `<div id="product-hover-box" class="product-hover-box" onmouseenter="clearTimeout(productListTimeout)" onmouseleave="hideProductList()">`;
                html += `<ul>`;
                for (let i = 0; i < products.length; i++) {
                    html += `<li class="product-item" data-name="${products[i].product_name}" data-idx="${products[i].product_idx}">
                                ${products[i].product_name}
                            </li>`;
                }
                html += `</ul>`;
                html += `</div>`;

                $('#product-hover-box').remove();
                $('body').append(html);

                const offset = $(el).offset();
                $('#product-hover-box').css({
                    top: offset.top + $(el).outerHeight() + 10,
                    left: offset.left,
                    position: 'absolute',
                    zIndex: 9999,
                    background: '#fff',
                    border: '1px solid #ccc',
                    padding: '10px',
                    boxShadow: '0 2px 6px rgba(0,0,0,0.2)',
                    cursor: 'pointer'
                });
            }
        });
    }
}

function hideProductList() {
    productListTimeout = setTimeout(() => {
        $('#product-hover-box').remove();
    }, 200);
}

$(document).on('click', '.product-item', function () {
    const productName = $(this).data('name');
    const productIdx = $(this).data('idx');

    $('#product_code').val(productIdx);
    $('.section_vehicle_golf_choose').html(`<p>(${productName})</p>`);
    $('#product-hover-box').remove();
});

</script>

<?php $this->endSection(); ?>