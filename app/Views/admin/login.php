<?=$this->extend("admin/inc/layout_login")?>
<?=$this->section("body")?>
<div id="ajax_loader" class="wrap-loading display-none">
    <div>
        <!-- <img src="/js/ajax-loader.gif" /> -->
    </div>
</div>
<div class="bk_box">
    <div class="login_cell">
        <div class="login_wrap">
            <div class="login_logo">
                <h1>Welcome to Back<br> Thaitour CMS</h1>
            </div>
            <div class="login_form">
                <form action="/AdmMaster/login" method="post" name="loginForm">
                    <div class="login_box">
                        <h2>관리자 로그인</h2>

                        <input type="text" name="user_id" placeholder="아이디" value="" style="ime-mode:disabled" />

                        <input type="password" name="user_pw" placeholder="비밀번호" value="" />

                        <div class="save_id">
                            <input type="checkbox" name="saveId" value="Y" id="save_id" class="input_checkbox" />
                            <label for="save_id">아이디 저장</label>
                        </div>

                        <button type='submit' class="login_btn">로그인</button>
                    </div>

                </form>
            </div>
            <p class="copy">designed by uwal communication</p>
        </div>
    </div>

</div>
<?=$this->endSection()?>