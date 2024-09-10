<?php
try {
    helper("setting");
    $setting = homeSetInfo();
} catch (\Throwable $th) {
    die("Something went wrong!");
}
?>
<?php echo view('inc/head', ["setting" => $setting]); ?>
<?php echo view('inc/header', ["setting" => $setting]); ?>
<main>
    <?php echo $this->renderSection('content'); ?>
    <?php
        echo view("inc/sidebar_inc");
    ?>
</main>
<?php echo view('inc/footer', ["setting" => $setting]); ?>
<script>
    // $(document).ready(function () {
    //     let currentHeader = $('#currentHeader').text();
    //     if (currentHeader) {
    //         let number = parseInt(currentHeader);
    //         $('.flex_header_top_content_list').find('a').eq(number - 1).addClass('active_');
    //     }
    // })
</script>
