<style>
    .completed-order-page .img-con img {
        width: unset;
        height: unset;
    }

    .completed-order-page .title-main-o {
        margin-top: 40px;
    }

    @media screen and (max-width: 850px) {

        .completed-order-page .img-con img {
            width: 35.7rem;
            height: 54.2rem;
        }

        .completed-order-page .title-main-o {
            margin-top: 4rem;
        }
    }
</style>
<div class="completed-order-page">
    <div class="body_inner">
        <div class="container-card">
            <div class="img-con">
                <img class="only_web" src="/uploads/sub/spa_completed_order.png" alt="completed_order">
                <img class="only_mo" src="/uploads/sub/spa_completed_order_mo.png" alt="completed_order">
            </div>
            <h3 class="title-main-o">
                장바구니에 담겼습니다
            </h3>
            <button class="btb-back-order" onclick="go_cart();">장바구니 확인</button>
        </div>
    </div>
</div>

<script>
function go_cart()
{
         location.href='/cart/item-list/123';
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
