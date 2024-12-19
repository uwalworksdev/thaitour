<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>
<style>

</style>
    <div id="iframeContainer">
        <iframe id="myIframe" src="https://tourlab.toursafe.co.kr/" frameborder="0" width="100%" ></iframe>
    </div>

    <script>
    $(document).ready(function () {
        $('a[data-key="travel_insurance"]').addClass("active_");
    })
</script>
<?php $this->endSection(); ?>