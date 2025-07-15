<?php $this->extend('inc/layout_index'); ?>

<?php $this->section('content'); ?>

<?php echo view("/product/inc/spa_ticket_restaurant/booking.php"); ?>

    <script>

        function completeOrder(status) {
            const $btn = $(document.activeElement); 
            if ($btn.prop("disabled")) return;
            $btn.prop("disabled", true); 
            let time_line = $("#hours").val() + ":" + $("#minutes").val();
            $("#time_line").val(time_line);

    		if(status == "W") {
					if ($("#order_user_name").val() === "") {
						alert("한국이름을 입력해주세요.");
						$("#order_user_name").focus();
                        $btn.prop("disabled", false); 
						return false;
					}
					if ($("#order_user_first_name_en").val() === "") {
						alert("영문 이름(First Name)을 입력해주세요.");
						$("#order_user_first_name_en").focus();
                        $btn.prop("disabled", false); 
						return false;
					}

					if ($("#order_user_last_name_en").val() === "") {
						alert("영문 성(Last Name)을 입력해주세요.");
						$("#order_user_last_name_en").focus();
                        $btn.prop("disabled", false); 
						return false;
					}

					if ($("#order_passport_number").val() === "") {
						alert("여권번호를 입력해주세요!");
						$("#order_passport_number").focus();
                        $btn.prop("disabled", false); 
						return false;
					}

					if ($("#order_passport_expiry_date").val() === "") {
						alert("여권만기일을 입력해주세요!");
						$("#order_passport_expiry_date").focus();
                        $btn.prop("disabled", false); 
						return false;
					}

					if ($("#order_birth_date").val() === "") {
						alert("생년월일을 입력해주세요!");
						$("#order_birth_date").focus()
                        $btn.prop("disabled", false); 
						return false;
					}
			}		
					
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
					if($("#order_status").val() == "W") {
                       window.location.href = "/product-spa/completed-order";
					} else {   
                       window.location.href = "/product-spa/completed-cart";
					}   
                },
                error: function (request, status, error) {
                    console.log(request);
                    $btn.prop("disabled", false); 
                    alert("code = " + request.status + " message = " + request.responseText + " error = " + error);
                }
            });
        }
    </script>

    <script>
        function completePayment(status) {

            $("#order_status").val(status);

            if (status == "B") {
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