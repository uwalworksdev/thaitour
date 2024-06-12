<?=$this->extend("inc/layout_admin")?>
<?=$this->section("body")?>
<div id="container">
    <span id="print_this">
        <header id="headerContainer">
            <div class="inner">
                <h2>약관 및 정책</h2>
                <div class="menus">
                    <ul>
                        <li>
                            <button type='submit' form="frm" class="btn btn-default">
                                <span class="glyphicon glyphicon-cog"></span>
                                <span class="txt">수정</span>
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </header>
        <div id="contents">
            <div class="listWrap_noline">
                <form name='frm' id="frm" method="POST" enctype="multipart/form-data">
                    <div class="listTop">
                        <div class="left">
                            <p class="schTxt">■ 회원약관</p>
                        </div>
                    </div>

                    <div class="listBottom">
                        <table class="listTable mem_detail">
                            <tbody>
                                <tr>
                                    <td>
                                        <textarea name="" id="members" class="input_txt"
                                            style="width:100%; height:400px;" cols="30" rows="10"></textarea>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="listTop">
                        <div class="left">
                            <p class="schTxt">■ 수집하는 개인정보의 항목</p>
                        </div>
                    </div>

                    <div class="listBottom">
                        <table class="listTable mem_detail">
                            <tbody>
                                <tr>
                                    <td>
                                        <textarea name="minfo1" id="minfo1" rows="10" cols="100" class="input_txt"
                                            style="width:100%; height:400px;"></textarea>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="listTop">
                        <div class="left">
                            <p class="schTxt">■ 개인정보의 수집이용 목적</p>
                        </div>
                    </div>

                    <div class="listBottom">
                        <table class="listTable mem_detail">
                            <tbody>
                                <tr>
                                    <td>
                                        <textarea name="minfo2" id="minfo2" rows="10" cols="100" class="input_txt"
                                            style="width:100%; height:400px;"></textarea>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="listTop">
                        <div class="left">
                            <p class="schTxt">■ 개인정보의 보유 및 이용시간</p>
                        </div>
                    </div>

                    <div class="listBottom">
                        <table class="listTable mem_detail">
                            <tbody>
                                <tr>
                                    <td>
                                        <textarea name="minfo3" id="minfo3" rows="10" cols="100" class="input_txt"
                                            style="width:100%; height:400px;"></textarea>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </form>
            </div>
        </div>

    </span>
</div>

<?=$this->endSection()?>