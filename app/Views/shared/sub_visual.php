<section class="sub_visual tours">
    <?php if (!empty($sub_banners)): ?>
        <section class="list_top_banner">
            <a href="<?= $sub_banners[0]['url'] ?>" id="myLink">
                <picture>
                    <source media="(max-width: 850px)" srcset="/data/catebanner/<?= $sub_banners[1]['ufile1'] ?>">
                    <img src="/data/catebanner/<?= $sub_banners[0]['ufile1'] ?>" alt="패키지 탑 배너">
                </picture>
            </a>
        </section>
    <?php endif; ?>
    <div class="inner">
        <h3 class="sub_visual_ttl">호주 <?= $code_name1 ?><?= $code_name2 ?><?= $code_name3 ?></h3>

    </div>
</section>

<script>
    $(document).ready(function() {
        var message = "";
        var img_url = "";
        $.ajax({
            url: "/ajax/ajax.subpage_image.php",
            type: "POST",
            data: {
                "s_code": '112'
            },
            dataType: "json",
            async: false,
            cache: false,
            success: function(data, textStatus) {
                message = data.message;
                if(message) img_url = "/data/bbs/" + message;
            },
            error: function(request, status, error) {
                alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
            }
        });

        if(img_url != "") {
            $(".sub_visual_ttl").css("background-image", "url(" + img_url + ")");
        }
    });

    document.addEventListener("DOMContentLoaded", function() {
        var myLink = document.getElementById("myLink");

        if (myLink.getAttribute("href") === "") {
            myLink.addEventListener("click", function(event) {
                event.preventDefault();
            });
        }
    });
</script>
