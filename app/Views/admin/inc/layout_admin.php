        <?=$this->include("admin/inc/header")?>
        <?=$this->renderSection("body")?>
        <footer id="footer">
            <!--
            <p class="tel"><img src="/AdmMaster/_images/common/tel.png" alt="시스템 이용관련 문의 02.3667.6635" /></p>
            -->
            <p class="btnTop"><a href="#" class="scrollTop"><img src="/images/ico/btn_scrolltop.png" alt="top" /></a></p>
        </footer><!-- // footer -->


        </div><!-- // wrap -->


        <script type="text/javascript" src="/lib/jquery/jquery.easing.min.js" charset="utf-8"></script>
        <script src="/js/admin/common.js"></script>
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
