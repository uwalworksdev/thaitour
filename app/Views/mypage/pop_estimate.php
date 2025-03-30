<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<style>
    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Noto Sans KR', sans-serif;
        padding: 30px;
    }

    h1 {
        text-align: center;
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 30px
    }

    .sec1 {
        display: flex;
        /* gap: 30px; */
        justify-content: space-between;
    }

    .sec1 .left {
        position: relative;
        width: 294px;
    }

    .sec1 .left .img_stem {
        position: absolute;
        top: 12px;
        right: 5px;
        width: 60px;
    }

    .sec1 .ttl {
        font-size: 16px;
        margin-bottom: 8px;
        color: #353535;
        font-weight: 600;
    }

    .sec1 .left>span {
        font-size: 14px;
        color: #757575;
        margin-bottom: 5px;
        display: block;
    }

    .sec1 .left .day,
    .sec1 .left .name {
        font-size: 14px;
        color: #252525;
        padding: 10px 0;
        border-bottom: 1px solid #999
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }

    td,
    th {
        border: 1px solid #dbdbdb;
        padding: 6px;
        text-align: center;
        font-size: 14px;
        color: #252525
    }

    th {
        background-color: #fafafa
    }

    tr .total {
        color: rgb(250, 17, 17)
    }

    .sec2 {
        margin-top: 40px
    }

    .sec2 .time {
        font-size: 14px;
        font-weight: 600;
        text-align: left;
        margin-bottom: 4px;

    }

    .sec2 .time+p {
        text-align: left;
        color: #757575;
        font-size: 12px
    }

    .sec2 td {
        padding: 12px
    }

    .list_desc {
        margin-top: 20px;
        margin-bottom: 34px;
    }

    .list_desc p {
        font-size: 13px;
        color: #656565;
        line-height: 1.4;
    }

    .send_mail {
        display: flex;
        align-items: center;
        gap : 8px;
        padding-top: 35px;
        border-top: 1px solid #dbdbdb;
    }

    .send_mail input {
        flex: 1;
        padding: 0 10px;
        border: 1px solid #dbdbdb;
        outline: none;
        height: 45px;
        font-size: 14px;
        color : #555
    }

    .send_mail button {
        font-size: 14px;
        font-weight: 700;
        color: #666;
        border: 1px solid #dbdbdb;
        height: 45px;
        padding: 10px 20px;
    }

    .btns_download {
        display: flex;
        align-items: center;
        justify-content: center;
        gap : 4px;
        margin-top: 35px
    }

    .btns_download button {
        font-size: 15px;
        font-weight: 700;
        padding: 16px 36px;
        background-color: #17469e;
        color: #fff;
        border: none;

    }
</style>

<body>
    <h1>더투어랩 여행견적서 </h1>
    <div class="sec1">
        <div class="left">
            <p class="ttl">TOTO Booking Co., Ltd. </p>
            <span>Sukhumvit 101 Bangjak </span>
            <span>Prakhanong Bangkok 10260 </span>
            <span>서비스/여행업 No. 101-86-79949 </span>
            <p class="day">견적일 : 2025년 03월 14일 </p>
            <p class="name">고객명 : 김평진 님 귀하 </p>
            <img src="/images/mypage/stem.jpg" class="img_stem">
        </div>
        <div class="right">
            <table>
                <colgroup>
                    <col width="110px">
                    <col width="110px">
                    <col width="110px">
                </colgroup>
                <tbody>
                    <tr>
                        <th>호텔 </th>
                        <td>0건 </td>
                        <td>0원 </td>
                    </tr>
                    <tr>
                        <th>골프 </th>
                        <td>1건 </td>
                        <td>303,175원 </td>
                    </tr>
                    <tr>
                        <th>투어 </th>
                        <td>1건 </td>
                        <td>39,000원 </td>
                    </tr>
                    <tr>
                        <th>차량 </th>
                        <td>0건 </td>
                        <td>0원 </td>
                    </tr>
                    <tr>
                        <th>가이드 </th>
                        <td>0건 </td>
                        <td>0원 </td>
                    </tr>
                    <tr>
                        <th class="total">합계 </th>
                        <td class="total">2건 </td>
                        <td class="total">342,175원 </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="sec2">
        <table>
            <colgroup>
                <col width="70px">
                <col width="*">
                <col width="110px">
            </colgroup>
            <tbody>
                <tr>
                    <th>품목</th>
                    <th>상세</th>
                    <th>금액</th>
                </tr>
                <tr>
                    <td>골프 </td>
                    <td>
                        <p class="time">2025-03-28(금) | 로얄 방파인 골프 클럽 </p>
                        <p>18홀 오전 | 성인 2명 | 그린피 : 6,700바트 | 3,350바트 X 2명 </p>
                    </td>
                    <td>
                        <p>303,175원 </p>
                        <p>(6,700바트) </p>
                    </td>
                </tr>
                <tr>
                    <td>투어 </td>
                    <td>
                        <p class="time">2025-03-28(금) | (아속출발) 아유타야 선셋 리버크루즈 반일 투어 </p>
                        <p>[프로모션] 아유타야 오후 | 성인 1명 | 39,000원 X 1명 </p>
                    </td>
                    <td>
                        <p>39,000원 </p>
                    </td>
                </tr>

        </table>
    </div>

    <div class="list_desc">
        <p>- 상기 견적은 고객님께서 직접 선택하신 상품으로 발행된 견적서입니다. </p>
        <p>- 견적서상 내용은 확정 예약시 상품의 예약가능여부/환을 등에 따라 금액 및 내용에 변동이 있을 수 있습니다. </p>
        <p>- 한국 : 국민은행 636101-01-301315 (주) 토토부킹 </p>
        <p>- 태국: Kasikorn Bank 895-2-19850-6 (Totobooking) </p>
    </div>
    <div class="send_mail">
        <input type="text" value="lifeess@naver.com ">
        <button>메일보내기 </button>
    </div>
    <div class="btns_download">
        <button>다운로드</button>
        <button>엑셀다운로드</button>
    </div>
</body>

</html>