<!-- 허니문 -->
<div class="invoice_table">
    <h2>상품정보</h2>
    <table>
        <colgroup>
            <col width="10%">
            <col width="*">
        </colgroup>
        <tbody>
            <tr>
                <td class="subject">상품구분</td>
                <td class="content"><?= $code_name_1 ?> > <?= $code_name_2 ?> > <?= $code_name_3 ?></td>
            </tr>
            <tr>
                <td class="subject">상품명</td>
                <td class="content"><?= $product_name ?></td>
            </tr>
            <tr>
                <td class="subject">이용항공</td>
                <td class="content logo">
                    <i style="background-image: url(/data/code/<?= $air_image ?>)"></i>
                    <span><?= $air_code_name ?> (<?= $air_name_1 ?>)</span>
                </td>
            </tr>
            <tr>
                <td class="subject">여행기간</td>
                <td class="content">
                    <?= date("Y년 m월 d일", strtotime($start_date)) ?> (<?= yoil_convert($start_date) ?>) ~
                    <?= date("Y년 m월 d일", strtotime($end_date)) ?> (<?= yoil_convert($end_date) ?>) / <?= $product_period ?>
                </td>
            </tr>
            <tr>
                <td class="subject">일정</td>
                <td class="content schedule">
                    <div class="schedule_list">
                        <span>한국출발 <?= date("Y년 m월 d일", strtotime($start_date)) ?> (<?= yoil_convert($start_date) ?>)
                            <?= $s_air_time_1 ?><?= $air_no_1 ?>
                        </span>
                        <span>현지도착 <?= date("Y년 m월 d일", strtotime($start_date)) ?> (<?= yoil_convert($start_date) ?>)
                            <?= $e_air_time_1 ?><?= $air_no_1 ?></span>
                        <span>현지출발
                            <?= date("Y년 m월 d일", strtotime(DateAdd("d", ($tour_period - 1), strtotime($start_date)))) ?>
                            (<?= yoil_convert(DateAdd("d", ($tour_period - 1), strtotime($start_date))) ?>)
                            <?= $s_air_time_2 ?><?= $air_no_2 ?>
                        </span>
                        <span>한국도착
                            <?= date("Y년 m월 d일", strtotime(DateAdd("d", ($tour_period - 1), strtotime($start_date)))) ?>
                            (<?= yoil_convert(DateAdd("d", ($tour_period - 1), strtotime($start_date))) ?>)
                            <?= $e_air_time_2 ?><?= $air_no_2 ?></span>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="subject">여행인원</td>
                <td class="content">
                    <span class="num">성인: <span><?= $people_adult_cnt ?></span></span>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<div class="invoice_table">
    <h2>예약자정보</h2>
    <table>
        <colgroup>
            <col width="15%">
            <col width="*">
        </colgroup>
        <tbody>
            <tr>
                <td class="subject">한글명</td>
                <td class="content">
                    <?= $order_user_name ?>
                </td>
            </tr>
            <!-- <tr>
                        <td class="subject">영문명</td>
                        <td class="content"></td>
                    </tr> -->
            <tr>
                <td class="subject">한국전화번호</td>
                <td class="content"><?= $order_user_mobile ?></td>
            </tr>
            <tr>
                <td class="subject">현지비상 전화번호</td>
                <td class="content">

                </td>
            </tr>
            <tr>
                <td class="subject">카카오톡 ID</td>
                <td class="content">

                </td>
            </tr>
            <tr>
                <td class="subject">이메일</td>
                <td class="content">
                    <?= $order_user_email ?>
                </td>
            </tr>
            <tr>
                <td class="subject">호주/해외 전화번호</td>
                <td class="content">
                    <?= $local_phone ?>
                </td>
            </tr>
            <tr>
                <td class="subject">숙소</td>
                <td class="content">
                    <?= $addr1 ?> <?= $addr2 ?>
                </td>
            </tr>
            <tr>
                <td class="subject">기타 요청사항</td>
                <td class="content">

                </td>
            </tr>
        </tbody>
    </table>
</div>
<?
$n = 1;
foreach ($order_detail_extra as $row) {
    ?>
    <div class="invoice_table">
        <h2>여행자정보</h2>
        <table>
            <colgroup>
                <col width="15%">
                <col width="*">
            </colgroup>
            <tbody>
                <tr>
                    <td class="subject">여행자<?= $n ?></td>

                    <td class="content"><?= $row['order_name_kor'] ?> / <?= $row['order_first_name'] ?>
                        <?= $row['order_last_name'] ?></td>
                </tr>
                <!-- <tr>
                                <td class="subject">여권번호</td>
                                <td class="content"><?= $row['passport_num'] ?></td>
                            </tr> -->
                <tr>
                    <td class="subject">생년월일</td>
                    <td class="content"><?= $row['order_birthday'] ?></td>
                </tr>
                <tr>
                    <td class="subject">전화번호</td>
                    <td class="content"><?= $row['order_mobile'] ?></td>
                </tr>
                <tr>
                    <td class="subject">이메일</td>
                    <td class="content"><?= $row['order_email'] ?></td>
                </tr>
                <tr>
                    <td class="subject">여권첨부</td>
                    <td class="content file">
                        <a href="/data/tour/<?= $row['ufile'] ?>" download="<?= $row['rfile'] ?>">
                            <span><?= $row['rfile'] ?></span>
                            <?php if (!empty($row['ufile'])): ?>
                                <i></i>
                            <?php endif; ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <?
    $n++;
}
?>