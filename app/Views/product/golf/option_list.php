<?php foreach ($options as $option) { ?>
	<?php
     	
        $baht_thai           = (float)($setting['baht_thai']);
	    $vehicle_price1_won  = (int)($option['vehicle_price1'] * $baht_thai);
	    $vehicle_price2_won  = (int)($option['vehicle_price2'] * $baht_thai);
	    $vehicle_price3_won  = (int)($option['vehicle_price3'] * $baht_thai);
		
	    $vehicle_price1_baht = $option['vehicle_price1'];
	    $vehicle_price2_baht = $option['vehicle_price2'];
	    $vehicle_price3_baht = $option['vehicle_price3'];
	
	?>
    <div class="card-item" 
        data-hole                = "<?=$option['goods_name']?>" 
        data-hour                = "<?=$option['hour']?>" 
        data-minute              = "<?=$option['minute']?>"
        data-idx                 = "<?=$option['idx']?>"
        data-vehicle_price1_won  = "<?=$vehicle_price1_won?>"
        data-vehicle_price2_won  = "<?=$vehicle_price2_won?>"
        data-vehicle_price3_won  = "<?=$vehicle_price3_won?>"
        data-vehicle_price1_baht = "<?=$vehicle_price1_baht?>"
        data-vehicle_price2_baht = "<?=$vehicle_price2_baht?>"
        data-vehicle_price3_baht = "<?=$vehicle_price3_baht?>"
        data-o_cart_due          = "<?=$option['o_cart_due']?>"
	    data-o_caddy_due         = "<?=$option['o_caddy_due']?>"
	    data-o_cart_cont         = "<?=$option['o_cart_cont']?>"	
	    data-o_caddy_cont        = "<?=$option['o_caddy_cont']?>"
        data-option_price        = "<?=$option['option_price']?>"
		data-o_afternoon_yn      = "<?=$option['o_afternoon_yn']?>"
		data-o_night_yn          = "<?=$option['o_night_yn']?>"
        data-option_price_baht   = "<?=$option['option_price_baht']?>"
        data-caddy_fee           = "<?=$option['caddy_fee']?>"
        data-cart_pie_fee        = "<?=$option['cart_pie_fee']?>" onclick="selectOption(this)">
        <div class="header">
            <div class="header-con">
                <img class="only_web" src="/uploads/icons/timer_gray_icon.png"    alt="timer_gray_icon">
                <img class="only_mo"  src="/uploads/icons/timer_gray_icon_mo.png" alt="timer_gray_icon_mo">
                <p id="time_type"></p>
            </div>
            <p class="cus-text">그린피 : <span class="font-bold"><?=number_format($option['option_price_won'])?>0 원(<?=number_format($option['option_price_baht'])?>바트)</span></p>
            <p class="cus-text">캐디피 : 그린피에 포함</p>
            <p class="cus-text">카트피 : 그린피에 포함</p>
        </div>
    </div>
<?php } ?>