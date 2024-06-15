<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>
<link href="/css/community/community.css" rel="stylesheet" type="text/css" />
<link href="/css/community/community_responsive.css" rel="stylesheet" type="text/css" />
<div id="container" class="sub view_container">
    
    <section class="view_sect">
        <div class="inner">
            <div class="view_top">
                <div class="sect_ttl_box">
                    <h2><?=$announcement['subject']?></h2>
                </div>
                <span class="date"><?=$announcement['r_date']?></span>
            </div>
            <div class="view_content">
                <div class="view_content-detail">
                       <?=viewSQ($announcement['contents'])?>
                </div>
            </div>
            <div class="btn-wrap">
                    <button type="button" class="btn btn-lg go_to_list" onclick="go_list();">목록으로</button>
                </div>
        </div>
    </section>
</div>

<script>
function go_list()
{
    window.history.back();
}
</script>
<?php $this->endSection(); ?>
