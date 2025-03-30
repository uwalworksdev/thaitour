<?php $this->extend('inc/layout_index'); ?>

<?php $this->section('content'); ?>

<?php echo view("/product/inc/spa_ticket_restaurant/booking.php"); ?>
    <script>
        function completeOrder(status) {

			$("#order_status").val(status);

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
					if(status == "W") {
                       window.location.href = "/ticket/completed-order";
					} else {   
                       window.location.href = "/ticket/completed-cart";
					}   
                },
                error: function (request, status, error) {
                    alert("code = " + request.status + " message = " + request.responseText + " error = " + error);
                }
            });
        }
    </script>

	<script>
	function completePayment(status) {

		$("#order_status").val(status);

		if(status == "B") {
				if ($("#order_user_name").val() === "") {
					alert("한국이름을 입력해주세요.");
					$("#order_user_name").focus();
					return false;
				}
				if ($("#order_user_first_name_en").val() === "") {
					alert("영문 이름(First Name)을 입력해주세요.");
					$("#order_user_first_name_en").focus();
					return false;
				}

				if ($("#order_user_last_name_en").val() === "") {
					alert("영문 성(Last Name)을 입력해주세요.");
					$("#order_user_last_name_en").focus();
					return false;
				}

				if ($("#email_1").val() === "" || $("#email_2").val() === "") {
					alert("이메일 주소를 입력해주세요.");
					$("#email_1").focus();
					return false;
				}

				if ($("input[name='radio_phone']:checked").val() === "kor") {
					if ($("#phone_1").val() === "" || $("#phone_2").val() === "" || $("#phone_3").val() === "") {
						alert("한국번호를 입력해주세요.");
						return false;
					}
				} else if ($("input[name='radio_phone']:checked").val() === "thai") {
					if ($("#phone_thai").val() === "") {
						alert("태국번호를 입력해주세요.");
						return false;
					}
				}
		}

		$('#formOrder').attr('action', '/product-spa/spa-payment-ok');
		$("#formOrder").submit();
	}	
	</script>
	
<?php $this->endSection(); ?>