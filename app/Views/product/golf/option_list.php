<?php foreach ($options as $option) { ?>
    <div class="card-item" 
        data-hole              = "<?=$option['hole_cnt']?>" 
        data-hour              = "<?=$option['hour']?>" 
        data-minute            = "<?=$option['minute']?>"
        data-idx               = "<?=$option['idx']?>"
        data-option_price      = "<?=$option['option_price']?>"
        data-option_price_baht = "<?=$option['option_price_baht']?>"
        data-caddy_fee         = "<?=$option['caddy_fee']?>"
        data-cart_pie_fee      = "<?=$option['cart_pie_fee']?>" onclick="selectOption(this)">
        <div class="header">
            <div class="header-con">
                <img class="only_web" src="/uploads/icons/timer_gray_icon.png"    alt="timer_gray_icon">
                <img class="only_mo"  src="/uploads/icons/timer_gray_icon_mo.png" alt="timer_gray_icon_mo">
                <p><?=$option['hour']?>:<?=$option['minute']?></p>
            </div>
            <p class="cus-text">캐디피 : <?=$option['caddy_fee']?></p>
            <p class="cus-text">카트피 : <?=$option['cart_pie_fee']?></p>
            <p class="cus-text">그린피 : <span class="font-bold"><?=number_format($option['option_price'])?> 원(<?=number_format($option['option_price_baht'])?>바트)</span></p>
        </div>
    </div>
<?php } ?>