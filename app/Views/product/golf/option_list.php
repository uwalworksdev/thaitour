<?php foreach ($options as $option) { ?>
    <div class="card-item" 
        data-hole              = "<?=$option['goods_name']?>" 
        data-hour              = "<?=$option['hour']?>" 
        data-minute            = "<?=$option['minute']?>"
        data-idx               = "<?=$option['idx']?>"
        data-option_price      = "<?=$option['option_price']?>"
		data-o_afternoon_yn    = "<?=$option['o_afternoon_yn']?>"
		data-o_night_yn        = "<?=$option['o_night_yn']?>"
        data-option_price_baht = "<?=$option['option_price_baht']?>"
        data-caddy_fee         = "<?=$option['caddy_fee']?>"
        data-cart_pie_fee      = "<?=$option['cart_pie_fee']?>" onclick="selectOption(this)">
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