<?php
try {
    helper(["setting", "my_helper"]);
    $setting = homeSetInfo();
    getLocationUrl();
} catch (\Throwable $th) {
    die("Something went wrong!");
}
?>
<?php echo view('inc/head', ["setting" => $setting]); ?>
<?php echo view('inc/header', ["setting" => $setting]); ?>
<style>
    .layout_loading {
        display: none;
        position: fixed;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        background-color: rgba(0, 0, 0, 0.3);
        z-index: 9999;
        justify-content: center;
        align-items: center;
    }

    .layout_loading.open {
        display: flex;
    }

    .load-container {
        position: absolute;
        margin: auto;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 100px;
    }

    .blocks {
        position: relative;
        z-index: 1000;
        width: 6px;
        height: 30px;
        margin-left: 6px;
        float: left;
        background-color: var(--bs-point);
        animation: spiner 1s infinite ease-in-out;
    }

    .blocks:first-child {
        margin-left: 0;
    }

    .b-one {
        animation-delay: -1s;
    }

    .b-two {
        animation-delay: -0.9s;
    }

    .b-three {
        animation-delay: -0.8s;
    }

    .b-four {
        animation-delay: -0.7s;
    }

    .b-five {
        animation-delay: -0.6s;
    }

    @keyframes spiner {
        0% {
            transform: scaleY(1);
        }
        50% {
            transform: scaleY(2);
        }
        100% {
            transform: scaleY(1);
        }
    }
</style>
<div class="layout_loading" id="layout_loading">
    <div class="load-container">
        <div class="blocks b-one"></div>
        <div class="blocks b-two"></div>
        <div class="blocks b-three"></div>
        <div class="blocks b-four"></div>
        <div class="blocks b-five"></div>
    </div>
</div>
<script>
    function LoadingPage() {
        let layout_loading = $('#layout_loading');

        if (layout_loading.hasClass('open')) {
            layout_loading.removeClass('open');
        } else {
            layout_loading.addClass('open');
        }
    }

    function convertNum(num) {
        // let number = Number(num);
        // return number.toLocaleString();
        let number = Number(num);
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    }
</script>

<main>
<?php 
    $banner_ = getLeftBottomBanner(); 
    $time_sale_list = getTimeSale()->findAll();

    $currentDateTime = new DateTime();
    
    session()->set('redirect_url', current_url());

?>

<?php
    $c_path = service('uri');
    if ($c_path->getSegment(1) !== 'promotion') {
?>
<div class="main_sale_banner flex__c">
    <?php foreach ($banner_ as $row) { ?>
        <div class="time_sale_banner flex__c">
           <a href="<?=$row['url']?>"><img src="/data/bbs/<?=$row['ufile5']?>" alt="main_sale_img"></a>
        </div>
	<?php } ?>	
</div>
<?php
    }
?>
    <?php echo $this->renderSection('content'); ?>
    <?php
        if ($c_path->getSegment(1) !== 'promotion') {
    ?>
        <?php echo view("inc/sidebar_inc"); ?>
    <?php } ?>
    <?php echo view("inc/popup_login"); ?>
</main>
<?php echo view('inc/footer', ["setting" => $setting]); ?>
<script>
    $(document).ready(function() {
        const items = $('.time_sale_wrap');
        const totalItems = items.length;
        let currentIndex = 0;

        if (totalItems > 1){
            $(items[currentIndex]).addClass('active');
    
            function changeItem() {
                $(items[currentIndex]).removeClass('active');
    
                currentIndex = (currentIndex + 1) % totalItems;
    
                $(items[currentIndex]).addClass('active');
            }
    
            setInterval(changeItem, 5000);
        
        }

        //decrease time
        $('.time_sale_wrap').each(function() {
            let hours = parseInt($(this).find('.hours').text());
            let minutes = parseInt($(this).find('.minutes').text());
            let seconds = parseInt($(this).find('.seconds').text());

            function decreaseTime() {
                if (seconds > 0) {
                    seconds--;
                } 
                else if (minutes > 0) {
                    minutes--;
                    seconds = 59;
                } 
                else if (hours > 0) {
                    hours--;
                    minutes = 59;
                    seconds = 59;
                }else{
                    $(this).hide();
                    return;
                }

                $(this).find('.hours').text(str_pad(hours));
                $(this).find('.minutes').text(str_pad(minutes));
                $(this).find('.seconds').text(str_pad(seconds));
            }

            function str_pad(value) {
                return value < 10 ? '0' + value : value;
            }

            setInterval(decreaseTime.bind(this), 1000);

        });
    });
    
</script>
