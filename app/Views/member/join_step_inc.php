<div class="join_step">
    <ul>
        <li class="step01" data-step="step01">
            <div class="step_ele">
               <span class="step_ele_num">01</span> <span class="step_ele_txt">약관동의</span>
            </div>
        </li>
        <li class="step02" data-step="step02">
            <div class="step_ele">
            <span class="step_ele_num">02</span> <span class="step_ele_txt">기본 정보입력</span>
            </div>
        </li>
        <li class="step03" data-step="step03">
            <div class="step_ele">
            <span class="step_ele_num">03</span> <span class="step_ele_txt">가입완료</span>
            </div>
        </li>
    </ul>
</div>


<script>
    $(function() {
        var joinWrapData = $('#container').data('step-page');
        $('.join_step li[data-step="' + joinWrapData + '"]').addClass('on');
    })
</script>