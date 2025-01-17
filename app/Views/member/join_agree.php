<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>

<script>
var id = "<?=session('member.id')?>";
if(id) location.href='/';
</script>

<main id="container" class="sub login member pt100" data-step-page="step01">
  <div class="inner_620">

    <div class="sub_sec_ttl tac ">
      <h2 class="ttl">회원가입</h2>
    </div>

         <?php echo view('member/join_step_inc'); ?>
         <form name="mem_fm" id="mem_fm"  action="join_form" method="post">
      <h3 class="mem_ttl">약관동의</h3>
      <ul class="form_list">
        <li>
		  <div class="bs-input-check">
            <input type="checkbox" name="" id="agree1" class="agree">
            <label for="agree1">이용약관 동의 <span class="text-red">(필수)</span></label>
          </div>
          <div class="terms_view"><?=viewSQ($policy['policy_contents']);?>
          </div>
        </li>
        <li>
          <div class="bs-input-check">
            <input type="checkbox" name="" id="agree2" class="agree">
            <label for="agree2">개인정보처리방침 <span class="text-red">(필수)</span></label>
          </div>
          <div class="terms_view">
            <ul class="mytlist2 mt20"><?=viewSQ($policy1['policy_contents']);?>
            </ul>
          </div>
        </li>
        <li>
          <div class="bs-input-check">
            <input type="checkbox" name="" id="agree3" class="agree">
            <label for="agree3">개인정보 제 3자 제공 및 공유안내 <span class="text-red">(필수)</span></label>
          </div>
          <div class="terms_view"><?=viewSQ($policy2['policy_contents']);?></div>
        </li>
        <li>
          <div class="bs-input-check">
            <input type="checkbox" name="all_agree" id="agree4" class="all_agree">
            <label for="agree4">전체 동의하기</label>
          </div>
        </li>

      </ul>
      <div class="bot_btn">
        <!-- <a href="./join_form.php" onclick="fn_submit();" class="cta_btn btn-light">다음</a> -->
        <input type="button" onclick="fn_submit();" value="다음" class="cta_btn btn-light" id="cta_btn"></input>
      </div>



    </form>


  </div>

</main>
<script>
  function fn_submit() {
    var frm= document.mem_fm;
    if (frm.agree1.checked == '') {
			alert("이용약관 동의해주세요!");
			return;
		}

    if (frm.agree2.checked == '') {
			alert("개인정보처리방침 동의해주세요!");
			return;
		}

    //if (frm.agree3.checked == '') {
	//		alert("약관동의 전체 동의해주세요!");
	//		return;
	//	}

    //if (frm.all_agree.checked == '') {
	//		alert("약관동의 전체 동의해주세요!");
	//		return;
	//	}

    frm.submit();
  }

  $(".all_agree").click(function () {
    if ($(this).prop("checked")) {
      $("#agree1").prop("checked", true);
      $("#agree2").prop("checked", true);
      $("#agree3").prop("checked", true);
      $("#cta_btn").addClass("btn-blue");
      $("#cta_btn").removeClass("btn-light");
    } else {
      $("#agree1").prop("checked", false);
      $("#agree2").prop("checked", false);
      $("#agree3").prop("checked", false);
      $("#cta_btn").addClass("btn-light");
      $("#cta_btn").removeClass("btn-blue");
    }
  });

  $(".agree").on("click", function() {
    let checked = true;
    $(".agree").each(function(index, elm) {
      if (!$(elm).prop("checked")) {
        checked = false;
      }
    });

    if (checked) {
      $(".all_agree").prop("checked", true);

      $("#cta_btn").addClass("btn-blue");
      $("#cta_btn").removeClass("btn-light");
    } else {
      $(".all_agree").prop("checked", false);
      $("#cta_btn").addClass("btn-light");
      $("#cta_btn").removeClass("btn-blue");
    }
  })

</script>

<?php $this->endSection(); ?>
