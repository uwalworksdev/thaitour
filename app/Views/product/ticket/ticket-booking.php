<?php $this->extend('inc/layout_index'); ?>

<?php $this->section('content'); ?>

<?php $order_gubun = 'ticket' ?>
<?php echo view("/product/inc/spa_ticket_restaurant/booking.php"); ?>
    <script>
        function completeOrder() {
            $("#ajax_loader").removeClass("display-none");

            let fullagreement = $("#fullagreement").val().trim();
            let terms = $("#terms").val().trim();
            let policy = $("#policy").val().trim();
            let information = $("#information").val().trim();
            let guidelines = $("#guidelines").val().trim();

            if ([fullagreement, terms, policy, information, guidelines].includes("N")) {
                alert("모든 약관에 동의해야 합니다.");
                return false;
            }

            let formData = new FormData($('#formOrder')[0]);

            let url = `<?= route_to('api.spa_.handleBooking') ?>`;

            $.ajax({
                url: url,
                type: "POST",
                data: formData,
                async: false,
                cache: false,
                processData: false,
                contentType: false,
                success: function (data, textStatus) {
                    console.log(data);
                    alert(data.message);
                    window.location.href = "/ticket/completed-order";
                },
                error: function (request, status, error) {
                    alert("code = " + request.status + " message = " + request.responseText + " error = " + error);
                }
            });
        }
    </script>

<?php $this->endSection(); ?>