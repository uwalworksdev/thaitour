        <?=$this->include("admin/inc/header")?>
        <?=$this->renderSection("body")?>
        <footer id="footer">
            <!--
            <p class="tel"><img src="/AdmMaster/_images/common/tel.png" alt="시스템 이용관련 문의 02.3667.6635" /></p>
            -->
            <p class="btnTop"><a href="#" class="scrollTop"><img src="/AdmMaster/_images/common/btn_scrolltop.png" alt="top" /></a></p>
        </footer><!-- // footer -->


        </div><!-- // wrap -->


        <script type="text/javascript" src="/AdmMaster/_common/js/jquery.easing.min.js" charset="utf-8"></script>
        <script type="text/javascript" src="/AdmMaster/_common/js/common.js" charset="utf-8"></script>
        <script>
            //$(".imgpop").colorbox({rel:'imgpop'});
            $(document).ready(function(){
                $(".imgpop").colorbox({
                    rel:'imgpop',
                    maxWidth: '90%',
                    maxHeight: '90%'
                });
            });
            //$('#colorbox').draggable();

            $(".price").number(true);

        </script>

        </body>
        </html>
