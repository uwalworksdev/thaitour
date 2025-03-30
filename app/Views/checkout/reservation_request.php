<?php $this->extend('inc/layout_index'); ?>

<?php $this->section('content'); ?>

<style>
    @media screen and (max-width : 850px) {
        
    }
</style>
<div class="completed-order-page">
    <div class="body_inner">
        <div class="container-card">
            <div class="img-con">
                <img src="/uploads/sub/completed_order.png" alt="completed_order">
            </div>
            <h3 class="title-main-o">
                예약신청이 완료되었습니다
            </h3>
            <button class="btb-back-order" onclick="go_payment();">결제하기</button>
        </div>
    </div>
</div>

<script>
function go_payment()
{
         location.href='/mypage/booklist';
}
</script>

<script>
    $(document).ready(function () {
        function formatDate(date) {
            var d = new Date(date),
                month = '' + (d.getMonth() + 1),
                day = '' + d.getDate(),
                year = d.getFullYear();

            if (month.length < 2) month = '0' + month;
            if (day.length < 2) day = '0' + day;

            return [year, month, day].join('/');
        }

        $("#checkin, #checkout").datepicker({
            dateFormat: 'yy/mm/dd',
            onSelect: function (dateText, inst) {
                var date = $(this).datepicker('getDate');
                $(this).val(formatDate(date));
            }
        });

        $('#checkin').val(formatDate('2024/07/09'));
        $('#checkout').val(formatDate('2024/07/10'));


        $('.tab_box_element_').on('click', function () {

            $('.tab_box_element_').removeClass('tab_active_');


            $(this).addClass('tab_active_');


            const tabId = $(this).attr('rel');
            $('.tab_content').hide();
            $('#' + tabId).show();
        });
    });
</script>

<?php $this->endSection(); ?>