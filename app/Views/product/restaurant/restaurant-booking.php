<?php $this->extend('inc/layout_index'); ?>

<?php $this->section('content'); ?>

<?php echo view("/product/inc/spa_ticket_restaurant/booking.php"); ?>

    <script>
        function completeOrder() {
            $("#ajax_loader").removeClass("display-none");

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
                    // window.location.href = "/product-restaurant/completed-order";
                },
                error: function (request, status, error) {
                    alert("code = " + request.status + " message = " + request.responseText + " error = " + error);
                }
            });
        }
    </script>

<?php $this->endSection(); ?>