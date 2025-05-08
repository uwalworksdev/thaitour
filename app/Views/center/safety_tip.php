<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>
<link href="/css/center/center.css" rel="stylesheet" type="text/css" />
<link href="/css/center/center_responsive.css" rel="stylesheet" type="text/css" />
<section class="terms">
    <?php
    echo view("center/center_term", ["tab1" => "on"]);
    ?>
    <div class="inner">
        <div class="contentArea">
            <div class="content_wrap">
                <?= viewSQ($policy['policy_contents']) ?>
            </div>
            <!-- <div class="content_wrap">
                <p><span style="font-size: 22.5pt; background-color: white; text-indent: -42pt;">여행 안전 수칙</span></p>
                <p><span style="font-size: 22.5pt; background-color: white; text-indent: -42pt;"><br></span></p>

                <p class="MsoNormal" align="left" style="text-align:left;line-height:19.5pt;
mso-pagination:widow-orphan;background:white;text-autospace:ideograph-numeric ideograph-other;
word-break:normal"><span lang="KO" style="mso-bidi-font-size:10.0pt;font-family:
" noto="" sans="" kr",sans-serif;mso-bidi-font-family:gulim;color:#555555;letter-spacing:="" -.15pt;mso-font-kerning:0pt;mso-ligatures:none"="">더투어랩은 기획여행 또는 패키지여행 상품을 판매</span><span style="mso-bidi-font-size:10.0pt;font-family:" noto="" sans="" kr",sans-serif;="" mso-bidi-font-family:gulim;color:#555555;letter-spacing:-.15pt;mso-font-kerning:="" 0pt;mso-ligatures:none"="">/<span lang="KO">운영하는 일반 여행사와는 달리 자유여행의 편의를 위해 최소한의 수수료만 받고
                            호텔</span>, <span lang="KO">투어</span>, <span lang="KO">입장권 등과 같은 현지의 여행서비스를 예약 대행해 드리고
                            있습니다</span>. <span lang="KO">따라서 당사는 해당 상품 운영에 직접 관여하지 못하며</span>, <span lang="KO">예약자
                            본인의 판단 하에 상품을 선택하고 이용하는 것인 만큼 상품 이용 시 안전에도 본인 스스로 만전을 기해 주셔야 합니다</span>.<br>
                        <span lang="KO">또한 모든 상품의 운영사가 현지의 업체이므로 이용 중 사고 발생시 현지 보험과 법에 따라 보장됩니다</span>. <span lang="KO">만약 이용 중에 다치거나 사고가 발생되면 업체 관계자 또는 투어 가이드에게 말씀하시고 현장에서 반드시 조치를 취하셔야 하며</span>,
                        <span lang="KO">아무런 조치없이 한국에 돌아가실 경우 그 어떠한 보상 및 치료를 보장받지 못하실 수 있습니다</span>.<br>
                        <span lang="KO">현지의 보험으로는 보장 받을 수 있는 수준이 부족할 수도 있으니 한국에서 별도로 여행자 보험을 가입하고 여행하시는 것을
                            적극 권장합니다</span>.<o:p></o:p></span></p>

                <p class="MsoNormal" align="left" style="margin-bottom:0in;text-align:left;
line-height:normal;mso-pagination:widow-orphan;mso-outline-level:4;background:
white;text-autospace:ideograph-numeric ideograph-other;word-break:normal"><span lang="KO" style="font-size:13.5pt;font-family:" noto="" sans="" kr",sans-serif;="" mso-bidi-font-family:gulim;color:#555555;letter-spacing:-.75pt;mso-font-kerning:="" 0pt;mso-ligatures:none"="">기본 주의 사항</span><span style="font-size:13.5pt;
font-family:" noto="" sans="" kr",sans-serif;mso-bidi-font-family:gulim;color:#555555;="" letter-spacing:-.75pt;mso-font-kerning:0pt;mso-ligatures:none"="">
                        <o:p></o:p>
                    </span></p>

                <ul style="margin-top:0in" type="disc">
                    <li class="MsoNormal" style="color:#555555;margin-bottom:0in;text-align:left;
     line-height:19.5pt;mso-pagination:widow-orphan;mso-list:l0 level1 lfo1;
     tab-stops:list .5in;background:white;text-autospace:ideograph-numeric ideograph-other;
     word-break:normal"><span lang="KO" style="mso-bidi-font-size:10.0pt;
     font-family:" noto="" sans="" kr",sans-serif;mso-bidi-font-family:gulim;="" letter-spacing:-.15pt;mso-font-kerning:0pt;mso-ligatures:none"="">ㆍ차량 이용 시 반드시
                            안전벨트를 착용하시기 바랍니다</span><span style="mso-bidi-font-size:10.0pt;font-family:
     " noto="" sans="" kr",sans-serif;mso-bidi-font-family:gulim;letter-spacing:-.15pt;="" mso-font-kerning:0pt;mso-ligatures:none"="">.<o:p></o:p></span></li>
                    <li class="MsoNormal" style="color:#555555;margin-bottom:0in;text-align:left;
     line-height:19.5pt;mso-pagination:widow-orphan;mso-list:l0 level1 lfo1;
     tab-stops:list .5in;background:white;text-autospace:ideograph-numeric ideograph-other;
     word-break:normal"><span lang="KO" style="mso-bidi-font-size:10.0pt;
     font-family:" noto="" sans="" kr",sans-serif;mso-bidi-font-family:gulim;="" letter-spacing:-.15pt;mso-font-kerning:0pt;mso-ligatures:none"="">ㆍ차를 타고 내리실 때</span><span style="mso-bidi-font-size:10.0pt;font-family:" noto="" sans="" kr",sans-serif;="" mso-bidi-font-family:gulim;letter-spacing:-.15pt;mso-font-kerning:0pt;="" mso-ligatures:none"="">, <span lang="KO">길을 건너실 때 반드시 주위를 살펴주세요</span>.<o:p></o:p></span></li>
                    <li class="MsoNormal" style="color:#555555;margin-bottom:0in;text-align:left;
     line-height:19.5pt;mso-pagination:widow-orphan;mso-list:l0 level1 lfo1;
     tab-stops:list .5in;background:white;text-autospace:ideograph-numeric ideograph-other;
     word-break:normal"><span lang="KO" style="mso-bidi-font-size:10.0pt;
     font-family:" noto="" sans="" kr",sans-serif;mso-bidi-font-family:gulim;="" letter-spacing:-.15pt;mso-font-kerning:0pt;mso-ligatures:none"="">ㆍ물놀이 또는 해양 스포츠
                            이용 시 안전에 각별히 주의해 주세요</span><span style="mso-bidi-font-size:10.0pt;
     font-family:" noto="" sans="" kr",sans-serif;mso-bidi-font-family:gulim;="" letter-spacing:-.15pt;mso-font-kerning:0pt;mso-ligatures:none"="">.<o:p></o:p></span></li>
                    <li class="MsoNormal" style="color:#555555;margin-bottom:0in;text-align:left;
     line-height:19.5pt;mso-pagination:widow-orphan;mso-list:l0 level1 lfo1;
     tab-stops:list .5in;background:white;text-autospace:ideograph-numeric ideograph-other;
     word-break:normal"><span lang="KO" style="mso-bidi-font-size:10.0pt;
     font-family:" noto="" sans="" kr",sans-serif;mso-bidi-font-family:gulim;="" letter-spacing:-.15pt;mso-font-kerning:0pt;mso-ligatures:none"="">ㆍ물놀이 전 준비운동은
                            필수이며 음주</span><span style="mso-bidi-font-size:10.0pt;font-family:" noto="" sans="" kr",sans-serif;="" mso-bidi-font-family:gulim;letter-spacing:-.15pt;mso-font-kerning:0pt;="" mso-ligatures:none"="">, <span lang="KO">과식 후 물놀이는 절대 금합니다</span>.<o:p></o:p></span></li>
                    <li class="MsoNormal" style="color:#555555;margin-bottom:0in;text-align:left;
     line-height:19.5pt;mso-pagination:widow-orphan;mso-list:l0 level1 lfo1;
     tab-stops:list .5in;background:white;text-autospace:ideograph-numeric ideograph-other;
     word-break:normal"><span lang="KO" style="mso-bidi-font-size:10.0pt;
     font-family:" noto="" sans="" kr",sans-serif;mso-bidi-font-family:gulim;="" letter-spacing:-.15pt;mso-font-kerning:0pt;mso-ligatures:none"="">ㆍ심신이 미약하신 분</span><span style="mso-bidi-font-size:10.0pt;font-family:" noto="" sans="" kr",sans-serif;="" mso-bidi-font-family:gulim;letter-spacing:-.15pt;mso-font-kerning:0pt;="" mso-ligatures:none"="">, <span lang="KO">건강상에 문제가 있거나 기타 질병이 있으신 분은 무리한 활동이 포함된
                                상품이용을 자제해 주시기 바랍니다</span>.<o:p></o:p></span></li>
                    <li class="MsoNormal" style="color:#555555;text-align:left;line-height:19.5pt;
     mso-pagination:widow-orphan;mso-list:l0 level1 lfo1;tab-stops:list .5in;
     background:white;text-autospace:ideograph-numeric ideograph-other;
     word-break:normal"><span lang="KO" style="mso-bidi-font-size:10.0pt;
     font-family:" noto="" sans="" kr",sans-serif;mso-bidi-font-family:gulim;="" letter-spacing:-.15pt;mso-font-kerning:0pt;mso-ligatures:none"="">ㆍ귀중품 및 현금 등의
                            분실사고에 각별히 유의해 주세요</span><span style="mso-bidi-font-size:10.0pt;font-family:
     " noto="" sans="" kr",sans-serif;mso-bidi-font-family:gulim;letter-spacing:-.15pt;="" mso-font-kerning:0pt;mso-ligatures:none"="">.<o:p></o:p></span></li>
                </ul>

                <p class="MsoNormal" align="left" style="margin-bottom:0in;text-align:left;
line-height:normal;mso-pagination:widow-orphan;mso-outline-level:4;background:
white;text-autospace:ideograph-numeric ideograph-other;word-break:normal"><span lang="KO" style="font-size:13.5pt;font-family:" noto="" sans="" kr",sans-serif;="" mso-bidi-font-family:gulim;color:#555555;letter-spacing:-.75pt;mso-font-kerning:="" 0pt;mso-ligatures:none"="">상품별 주요 주의 사항</span><span style="font-size:13.5pt;
font-family:" noto="" sans="" kr",sans-serif;mso-bidi-font-family:gulim;color:#555555;="" letter-spacing:-.75pt;mso-font-kerning:0pt;mso-ligatures:none"="">
                        <o:p></o:p>
                    </span></p>

                <ul style="margin-top:0in" type="disc">
                    <li class="MsoNormal" style="color:#555555;margin-bottom:11.25pt;text-align:
     left;line-height:19.5pt;mso-pagination:widow-orphan;mso-list:l1 level1 lfo2;
     tab-stops:list .5in;background:white;text-autospace:ideograph-numeric ideograph-other;
     word-break:normal"><span lang="KO" style="mso-bidi-font-size:10.0pt;
     font-family:" noto="" sans="" kr",sans-serif;mso-bidi-font-family:gulim;="" letter-spacing:-.15pt;mso-font-kerning:0pt;mso-ligatures:none"="">① 호텔 등 숙박시설</span><span style="mso-bidi-font-size:10.0pt;font-family:" noto="" sans="" kr",sans-serif;="" mso-bidi-font-family:gulim;letter-spacing:-.15pt;mso-font-kerning:0pt;="" mso-ligatures:none"="">
                            <o:p></o:p>
                        </span></li>
                    <ul style="margin-top:0in" type="circle">
                        <li class="MsoNormal" style="color:#666666;margin-bottom:0in;text-align:left;
      line-height:19.5pt;mso-pagination:widow-orphan;mso-list:l1 level2 lfo2;
      tab-stops:list 1.0in;background:white;text-autospace:ideograph-numeric ideograph-other;
      word-break:normal"><span lang="KO" style="mso-bidi-font-size:10.0pt;
      font-family:" noto="" sans="" kr",sans-serif;mso-bidi-font-family:gulim;="" letter-spacing:-.15pt;mso-font-kerning:0pt;mso-ligatures:none"="">ㆍ수영장 이용시간외
                                또는 안전요원</span><span style="mso-bidi-font-size:10.0pt;font-family:" noto="" sans="" kr",sans-serif;="" mso-bidi-font-family:gulim;letter-spacing:-.15pt;mso-font-kerning:0pt;="" mso-ligatures:none"="">(<span lang="KO">호텔 직원</span>)<span lang="KO">이 없는 시간은 수영장
                                    이용을 삼가 주세요</span>. <span lang="KO">또한 음주 후 수영은 금물 입니다</span>.<o:p></o:p></span></li>
                        <li class="MsoNormal" style="color:#666666;margin-bottom:0in;text-align:left;
      line-height:19.5pt;mso-pagination:widow-orphan;mso-list:l1 level2 lfo2;
      tab-stops:list 1.0in;background:white;text-autospace:ideograph-numeric ideograph-other;
      word-break:normal"><span lang="KO" style="mso-bidi-font-size:10.0pt;
      font-family:" noto="" sans="" kr",sans-serif;mso-bidi-font-family:gulim;="" letter-spacing:-.15pt;mso-font-kerning:0pt;mso-ligatures:none"="">ㆍ숙박시설내 수영장에서
                                다이빙은 절대 금지 입니다</span><span style="mso-bidi-font-size:10.0pt;font-family:
      " noto="" sans="" kr",sans-serif;mso-bidi-font-family:gulim;letter-spacing:-.15pt;="" mso-font-kerning:0pt;mso-ligatures:none"="">.<o:p></o:p></span></li>
                        <li class="MsoNormal" style="color:#666666;margin-bottom:0in;text-align:left;
      line-height:19.5pt;mso-pagination:widow-orphan;mso-list:l1 level2 lfo2;
      tab-stops:list 1.0in;background:white;text-autospace:ideograph-numeric ideograph-other;
      word-break:normal"><span lang="KO" style="mso-bidi-font-size:10.0pt;
      font-family:" noto="" sans="" kr",sans-serif;mso-bidi-font-family:gulim;="" letter-spacing:-.15pt;mso-font-kerning:0pt;mso-ligatures:none"="">ㆍ아동은 반드시 보호자와
                                함께 수영장 등 호텔 부대시설을 이용해 주셔야 합니다</span><span style="mso-bidi-font-size:10.0pt;
      font-family:" noto="" sans="" kr",sans-serif;mso-bidi-font-family:gulim;="" letter-spacing:-.15pt;mso-font-kerning:0pt;mso-ligatures:none"="">.<o:p></o:p></span></li>
                        <li class="MsoNormal" style="color:#666666;margin-bottom:0in;text-align:left;
      line-height:19.5pt;mso-pagination:widow-orphan;mso-list:l1 level2 lfo2;
      tab-stops:list 1.0in;background:white;text-autospace:ideograph-numeric ideograph-other;
      word-break:normal"><span lang="KO" style="mso-bidi-font-size:10.0pt;
      font-family:" noto="" sans="" kr",sans-serif;mso-bidi-font-family:gulim;="" letter-spacing:-.15pt;mso-font-kerning:0pt;mso-ligatures:none"="">ㆍ제공되는 생수 이외에
                                수돗물은 절대 드시지 말아 주시고 숙박시설 내에서 제공되는 음식을 드실 때에도 알러지 등의 이상 반응이 있는 음식은 직접 선별해 드셔야
                                합니다</span><span style="mso-bidi-font-size:10.0pt;font-family:" noto="" sans="" kr",sans-serif;="" mso-bidi-font-family:gulim;letter-spacing:-.15pt;mso-font-kerning:0pt;="" mso-ligatures:none"="">.<o:p></o:p></span></li>
                        <li class="MsoNormal" style="color:#666666;margin-bottom:0in;text-align:left;
      line-height:19.5pt;mso-pagination:widow-orphan;mso-list:l1 level2 lfo2;
      tab-stops:list 1.0in;background:white;text-autospace:ideograph-numeric ideograph-other;
      word-break:normal"><span lang="KO" style="mso-bidi-font-size:10.0pt;
      font-family:" noto="" sans="" kr",sans-serif;mso-bidi-font-family:gulim;="" letter-spacing:-.15pt;mso-font-kerning:0pt;mso-ligatures:none"="">ㆍ귀중품은 분실 또는
                                도난 당하지 않도록 안전 금고를 이용하시거나 직접 잘 간수해 주셔야 합니다</span><span style="mso-bidi-font-size:
      10.0pt;font-family:" noto="" sans="" kr",sans-serif;mso-bidi-font-family:gulim;="" letter-spacing:-.15pt;mso-font-kerning:0pt;mso-ligatures:none"="">.<o:p></o:p></span></li>
                        <li class="MsoNormal" style="color:#666666;margin-bottom:0in;text-align:left;
      line-height:19.5pt;mso-pagination:widow-orphan;mso-list:l1 level2 lfo2;
      tab-stops:list 1.0in;background:white;text-autospace:ideograph-numeric ideograph-other;
      word-break:normal"><span lang="KO" style="mso-bidi-font-size:10.0pt;
      font-family:" noto="" sans="" kr",sans-serif;mso-bidi-font-family:gulim;="" letter-spacing:-.15pt;mso-font-kerning:0pt;mso-ligatures:none"="">ㆍ욕실</span><span style="mso-bidi-font-size:10.0pt;font-family:" noto="" sans="" kr",sans-serif;="" mso-bidi-font-family:gulim;letter-spacing:-.15pt;mso-font-kerning:0pt;="" mso-ligatures:none"="">, <span lang="KO">침실</span>, <span lang="KO">수영장 바닥이 미끄러울
                                    수 있으니 주의해 주세요</span>.<o:p></o:p></span></li>
                        <li class="MsoNormal" style="color:#666666;margin-bottom:0in;text-align:left;
      line-height:19.5pt;mso-pagination:widow-orphan;mso-list:l1 level2 lfo2;
      tab-stops:list 1.0in;background:white;text-autospace:ideograph-numeric ideograph-other;
      word-break:normal"><span lang="KO" style="mso-bidi-font-size:10.0pt;
      font-family:" noto="" sans="" kr",sans-serif;mso-bidi-font-family:gulim;="" letter-spacing:-.15pt;mso-font-kerning:0pt;mso-ligatures:none"="">ㆍ체크인 후 숙박시설
                                내 표시된 비상 탈출로를 반드시 확인해 주세요</span><span style="mso-bidi-font-size:10.0pt;
      font-family:" noto="" sans="" kr",sans-serif;mso-bidi-font-family:gulim;="" letter-spacing:-.15pt;mso-font-kerning:0pt;mso-ligatures:none"="">.<o:p></o:p></span></li>
                        <li class="MsoNormal" style="color:#666666;margin-bottom:0in;text-align:left;
      line-height:19.5pt;mso-pagination:widow-orphan;mso-list:l1 level2 lfo2;
      tab-stops:list 1.0in;background:white;text-autospace:ideograph-numeric ideograph-other;
      word-break:normal"><span lang="KO" style="mso-bidi-font-size:10.0pt;
      font-family:" noto="" sans="" kr",sans-serif;mso-bidi-font-family:gulim;="" letter-spacing:-.15pt;mso-font-kerning:0pt;mso-ligatures:none"="">ㆍ기물이 파손되지 않도록
                                주의해 주시고</span><span style="mso-bidi-font-size:10.0pt;font-family:" noto="" sans="" kr",sans-serif;="" mso-bidi-font-family:gulim;letter-spacing:-.15pt;mso-font-kerning:0pt;="" mso-ligatures:none"="">, <span lang="KO">고객 부주의로 기물 파손시 직접 변상해 주셔야 합니다</span>.<o:p></o:p></span></li>
                        <li class="MsoNormal" style="color:#666666;margin-bottom:0in;text-align:left;
      line-height:19.5pt;mso-pagination:widow-orphan;mso-list:l1 level2 lfo2;
      tab-stops:list 1.0in;background:white;text-autospace:ideograph-numeric ideograph-other;
      word-break:normal"><span lang="KO" style="mso-bidi-font-size:10.0pt;
      font-family:" noto="" sans="" kr",sans-serif;mso-bidi-font-family:gulim;="" letter-spacing:-.15pt;mso-font-kerning:0pt;mso-ligatures:none"="">ㆍ 발코니는 추락의
                                위험이 있으므로 난간에 기대거나 어린이 혼자 있지 않도록 주의해 주셔야 합니다</span><span style="mso-bidi-font-size:
      10.0pt;font-family:" noto="" sans="" kr",sans-serif;mso-bidi-font-family:gulim;="" letter-spacing:-.15pt;mso-font-kerning:0pt;mso-ligatures:none"="">.<o:p></o:p></span></li>
                    </ul>
                    <li class="MsoNormal" style="color:#555555;margin-bottom:11.25pt;text-align:
     left;line-height:19.5pt;mso-pagination:widow-orphan;mso-list:l1 level1 lfo2;
     tab-stops:list .5in;background:white;text-autospace:ideograph-numeric ideograph-other;
     word-break:normal"><span lang="KO" style="mso-bidi-font-size:10.0pt;
     font-family:" noto="" sans="" kr",sans-serif;mso-bidi-font-family:gulim;="" letter-spacing:-.15pt;mso-font-kerning:0pt;mso-ligatures:none"="">② 투어</span><span style="mso-bidi-font-size:10.0pt;font-family:" noto="" sans="" kr",sans-serif;="" mso-bidi-font-family:gulim;letter-spacing:-.15pt;mso-font-kerning:0pt;="" mso-ligatures:none"="">
                            <o:p></o:p>
                        </span></li>
                    <ul style="margin-top:0in" type="circle">
                        <li class="MsoNormal" style="color:#666666;margin-bottom:0in;text-align:left;
      line-height:19.5pt;mso-pagination:widow-orphan;mso-list:l1 level2 lfo2;
      tab-stops:list 1.0in;background:white;text-autospace:ideograph-numeric ideograph-other;
      word-break:normal"><span lang="KO" style="mso-bidi-font-size:10.0pt;
      font-family:" noto="" sans="" kr",sans-serif;mso-bidi-font-family:gulim;="" letter-spacing:-.15pt;mso-font-kerning:0pt;mso-ligatures:none"="">ㆍ해양</span><span style="mso-bidi-font-size:10.0pt;font-family:" noto="" sans="" kr",sans-serif;="" mso-bidi-font-family:gulim;letter-spacing:-.15pt;mso-font-kerning:0pt;="" mso-ligatures:none"="">(<span lang="KO">수상</span>) <span lang="KO">스포츠 또는 각종 액티비티가
                                    포함된 투어 상품을 이용하는 것은 사고나 개인적인 신체 부상</span>(<span lang="KO">사망 포함</span>) <span lang="KO">및 재산의 손실 또는 손해가 발생될 수 있다는 위험이 잠재 되어 있다는 점을 스스로 인정하고 이용하시는 것입니다</span>.
                                <span lang="KO">따라서 안전장비</span>(<span lang="KO">구명조끼 등 보호장구</span>) <span lang="KO">착용은 필수 이고</span>, <span lang="KO">현지 가이드 또는 안내원을 잘 따라 주셔야 하며</span>,
                                <span lang="KO">개인의 안전에 더욱 각별히 주의해 주시길 당부 드립니다</span>.<o:p></o:p></span></li>
                        <li class="MsoNormal" style="color:#666666;margin-bottom:0in;text-align:left;
      line-height:19.5pt;mso-pagination:widow-orphan;mso-list:l1 level2 lfo2;
      tab-stops:list 1.0in;background:white;text-autospace:ideograph-numeric ideograph-other;
      word-break:normal"><span lang="KO" style="mso-bidi-font-size:10.0pt;
      font-family:" noto="" sans="" kr",sans-serif;mso-bidi-font-family:gulim;="" letter-spacing:-.15pt;mso-font-kerning:0pt;mso-ligatures:none"="">ㆍ해양</span><span style="mso-bidi-font-size:10.0pt;font-family:" noto="" sans="" kr",sans-serif;="" mso-bidi-font-family:gulim;letter-spacing:-.15pt;mso-font-kerning:0pt;="" mso-ligatures:none"="">(<span lang="KO">수상</span>) <span lang="KO">스포츠</span>(<span lang="KO">스피드보트 탑승</span>, <span lang="KO">스노클링 포함</span>) <span lang="KO">또는 각종
                                    액티비티</span>(<span lang="KO">짚라인</span>, ATV <span lang="KO">코끼리트래킹 등과 같이 활동적인
                                    프로그램</span>)<span lang="KO">가 포함된 투어 상품은 일정부분 스릴을 즐기는 투어로써 사전에 본인 스스로의 건강</span>,
                                <span lang="KO">심리상태의 점검이 필요합니다</span>. <span lang="KO">심신이 미약하신 분</span>, <span lang="KO">건강상에 문제가 있거나 기타 질병이 있으신 분은 해당 투어 상품 이용이 불가능 합니다</span>.<o:p></o:p></span></li>
                        <li class="MsoNormal" style="color:#666666;margin-bottom:0in;text-align:left;
      line-height:19.5pt;mso-pagination:widow-orphan;mso-list:l1 level2 lfo2;
      tab-stops:list 1.0in;background:white;text-autospace:ideograph-numeric ideograph-other;
      word-break:normal"><span lang="KO" style="mso-bidi-font-size:10.0pt;
      font-family:" noto="" sans="" kr",sans-serif;mso-bidi-font-family:gulim;="" letter-spacing:-.15pt;mso-font-kerning:0pt;mso-ligatures:none"="">ㆍ스피드 보트 이용
                                시 운행 중에는 일어나서는 안되며 빠른 이동 속도로 움직임이 심하니 허리가 안 좋으신 분은 이용을 자제해 주시는 것이 좋습니다</span><span style="mso-bidi-font-size:10.0pt;font-family:" noto="" sans="" kr",sans-serif;="" mso-bidi-font-family:gulim;letter-spacing:-.15pt;mso-font-kerning:0pt;="" mso-ligatures:none"="">. <span lang="KO">승 하선 시에도 반드시 승무원 또는 가이드의 지시가 있을 때 움직여
                                    주셔야 합니다</span>.<o:p></o:p></span></li>
                        <li class="MsoNormal" style="color:#666666;margin-bottom:0in;text-align:left;
      line-height:19.5pt;mso-pagination:widow-orphan;mso-list:l1 level2 lfo2;
      tab-stops:list 1.0in;background:white;text-autospace:ideograph-numeric ideograph-other;
      word-break:normal"><span lang="KO" style="mso-bidi-font-size:10.0pt;
      font-family:" noto="" sans="" kr",sans-serif;mso-bidi-font-family:gulim;="" letter-spacing:-.15pt;mso-font-kerning:0pt;mso-ligatures:none"="">ㆍ해양 동식물 보호와
                                고객의 안전을 위해 아쿠아 슈즈 착용을 권장합니다</span><span style="mso-bidi-font-size:10.0pt;
      font-family:" noto="" sans="" kr",sans-serif;mso-bidi-font-family:gulim;="" letter-spacing:-.15pt;mso-font-kerning:0pt;mso-ligatures:none"="">. <span lang="KO">또한 해파리</span>, <span lang="KO">성게 등 해양 동식물과의 접촉은 안전을 위해 피해 주시기 바랍니다</span>.<o:p></o:p></span></li>
                        <li class="MsoNormal" style="color:#666666;margin-bottom:0in;text-align:left;
      line-height:19.5pt;mso-pagination:widow-orphan;mso-list:l1 level2 lfo2;
      tab-stops:list 1.0in;background:white;text-autospace:ideograph-numeric ideograph-other;
      word-break:normal"><span lang="KO" style="mso-bidi-font-size:10.0pt;
      font-family:" noto="" sans="" kr",sans-serif;mso-bidi-font-family:gulim;="" letter-spacing:-.15pt;mso-font-kerning:0pt;mso-ligatures:none"="">ㆍ투어 이용 중 원숭이나
                                코끼리 또는 다른 야생 동물을 만날 경우</span><span style="mso-bidi-font-size:10.0pt;
      font-family:" noto="" sans="" kr",sans-serif;mso-bidi-font-family:gulim;="" letter-spacing:-.15pt;mso-font-kerning:0pt;mso-ligatures:none"="">, <span lang="KO">접촉하거나 먹이를 주는 행위를 삼가 주세요</span>.<o:p></o:p></span></li>
                    </ul>
                    <li class="MsoNormal" style="color:#555555;margin-bottom:11.25pt;text-align:
     left;line-height:19.5pt;mso-pagination:widow-orphan;mso-list:l1 level1 lfo2;
     tab-stops:list .5in;background:white;text-autospace:ideograph-numeric ideograph-other;
     word-break:normal"><span lang="KO" style="mso-bidi-font-size:10.0pt;
     font-family:" noto="" sans="" kr",sans-serif;mso-bidi-font-family:gulim;="" letter-spacing:-.15pt;mso-font-kerning:0pt;mso-ligatures:none"="">③ 차량</span><span style="mso-bidi-font-size:10.0pt;font-family:" noto="" sans="" kr",sans-serif;="" mso-bidi-font-family:gulim;letter-spacing:-.15pt;mso-font-kerning:0pt;="" mso-ligatures:none"="">
                            <o:p></o:p>
                        </span></li>
                    <ul style="margin-top:0in" type="circle">
                        <li class="MsoNormal" style="color:#666666;margin-bottom:0in;text-align:left;
      line-height:19.5pt;mso-pagination:widow-orphan;mso-list:l1 level2 lfo2;
      tab-stops:list 1.0in;background:white;text-autospace:ideograph-numeric ideograph-other;
      word-break:normal"><span lang="KO" style="mso-bidi-font-size:10.0pt;
      font-family:" noto="" sans="" kr",sans-serif;mso-bidi-font-family:gulim;="" letter-spacing:-.15pt;mso-font-kerning:0pt;mso-ligatures:none"="">ㆍ안전벨트를 반드시
                                착용해 주세요</span><span style="mso-bidi-font-size:10.0pt;font-family:" noto="" sans="" kr",sans-serif;="" mso-bidi-font-family:gulim;letter-spacing:-.15pt;mso-font-kerning:0pt;="" mso-ligatures:none"="">.<o:p></o:p></span></li>
                        <li class="MsoNormal" style="color:#666666;margin-bottom:0in;text-align:left;
      line-height:19.5pt;mso-pagination:widow-orphan;mso-list:l1 level2 lfo2;
      tab-stops:list 1.0in;background:white;text-autospace:ideograph-numeric ideograph-other;
      word-break:normal"><span lang="KO" style="mso-bidi-font-size:10.0pt;
      font-family:" noto="" sans="" kr",sans-serif;mso-bidi-font-family:gulim;="" letter-spacing:-.15pt;mso-font-kerning:0pt;mso-ligatures:none"="">ㆍ승 하차 시 반드시
                                주위를 살펴 주시기 바랍니다</span><span style="mso-bidi-font-size:10.0pt;font-family:
      " noto="" sans="" kr",sans-serif;mso-bidi-font-family:gulim;letter-spacing:-.15pt;="" mso-font-kerning:0pt;mso-ligatures:none"="">.<o:p></o:p></span></li>
                        <li class="MsoNormal" style="color:#666666;margin-bottom:0in;text-align:left;
      line-height:19.5pt;mso-pagination:widow-orphan;mso-list:l1 level2 lfo2;
      tab-stops:list 1.0in;background:white;text-autospace:ideograph-numeric ideograph-other;
      word-break:normal"><span lang="KO" style="mso-bidi-font-size:10.0pt;
      font-family:" noto="" sans="" kr",sans-serif;mso-bidi-font-family:gulim;="" letter-spacing:-.15pt;mso-font-kerning:0pt;mso-ligatures:none"="">ㆍ이용 종료 시 놓고
                                내린 물건은 없는지 반드시 확인해 주세요</span><span style="mso-bidi-font-size:10.0pt;
      font-family:" noto="" sans="" kr",sans-serif;mso-bidi-font-family:gulim;="" letter-spacing:-.15pt;mso-font-kerning:0pt;mso-ligatures:none"="">.<o:p></o:p></span></li>
                    </ul>
                    <li class="MsoNormal" style="color:#555555;margin-bottom:11.25pt;text-align:
     left;line-height:19.5pt;mso-pagination:widow-orphan;mso-list:l1 level1 lfo2;
     tab-stops:list .5in;background:white;text-autospace:ideograph-numeric ideograph-other;
     word-break:normal"><span lang="KO" style="mso-bidi-font-size:10.0pt;
     font-family:" noto="" sans="" kr",sans-serif;mso-bidi-font-family:gulim;="" letter-spacing:-.15pt;mso-font-kerning:0pt;mso-ligatures:none"="">④ 골프</span><span style="mso-bidi-font-size:10.0pt;font-family:" noto="" sans="" kr",sans-serif;="" mso-bidi-font-family:gulim;letter-spacing:-.15pt;mso-font-kerning:0pt;="" mso-ligatures:none"="">
                            <o:p></o:p>
                        </span></li>
                    <ul style="margin-top:0in" type="circle">
                        <li class="MsoNormal" style="color:#666666;margin-bottom:0in;text-align:left;
      line-height:19.5pt;mso-pagination:widow-orphan;mso-list:l1 level2 lfo2;
      tab-stops:list 1.0in;background:white;text-autospace:ideograph-numeric ideograph-other;
      word-break:normal"><span lang="KO" style="mso-bidi-font-size:10.0pt;
      font-family:" noto="" sans="" kr",sans-serif;mso-bidi-font-family:gulim;="" letter-spacing:-.15pt;mso-font-kerning:0pt;mso-ligatures:none"="">ㆍ플레이 중 비가 오거나
                                번개가 칠 경우 플레이를 중단해 주시고 안전한 곳으로 이동해 주세요</span><span style="mso-bidi-font-size:
      10.0pt;font-family:" noto="" sans="" kr",sans-serif;mso-bidi-font-family:gulim;="" letter-spacing:-.15pt;mso-font-kerning:0pt;mso-ligatures:none"="">.<o:p></o:p></span></li>
                        <li class="MsoNormal" style="color:#666666;margin-bottom:0in;text-align:left;
      line-height:19.5pt;mso-pagination:widow-orphan;mso-list:l1 level2 lfo2;
      tab-stops:list 1.0in;background:white;text-autospace:ideograph-numeric ideograph-other;
      word-break:normal"><span lang="KO" style="mso-bidi-font-size:10.0pt;
      font-family:" noto="" sans="" kr",sans-serif;mso-bidi-font-family:gulim;="" letter-spacing:-.15pt;mso-font-kerning:0pt;mso-ligatures:none"="">ㆍ공이 어디서 날아올지
                                모르고</span><span style="mso-bidi-font-size:10.0pt;font-family:" noto="" sans="" kr",sans-serif;="" mso-bidi-font-family:gulim;letter-spacing:-.15pt;mso-font-kerning:0pt;="" mso-ligatures:none"="">, <span lang="KO">주변에 사람이 있을 수 있으니 반드시 주의를 살피며 플레이를 즐겨주세요</span>.<o:p></o:p></span></li>
                        <li class="MsoNormal" style="color:#666666;margin-bottom:0in;text-align:left;
      line-height:19.5pt;mso-pagination:widow-orphan;mso-list:l1 level2 lfo2;
      tab-stops:list 1.0in;background:white;text-autospace:ideograph-numeric ideograph-other;
      word-break:normal"><span lang="KO" style="mso-bidi-font-size:10.0pt;
      font-family:" noto="" sans="" kr",sans-serif;mso-bidi-font-family:gulim;="" letter-spacing:-.15pt;mso-font-kerning:0pt;mso-ligatures:none"="">ㆍ캐디의 안내에 잘
                                따라 주시기 바랍니다</span><span style="mso-bidi-font-size:10.0pt;font-family:
      " noto="" sans="" kr",sans-serif;mso-bidi-font-family:gulim;letter-spacing:-.15pt;="" mso-font-kerning:0pt;mso-ligatures:none"="">.<o:p></o:p></span></li>
                        <li class="MsoNormal" style="color:#666666;margin-bottom:0in;text-align:left;
      line-height:19.5pt;mso-pagination:widow-orphan;mso-list:l1 level2 lfo2;
      tab-stops:list 1.0in;background:white;text-autospace:ideograph-numeric ideograph-other;
      word-break:normal"><span lang="KO" style="mso-bidi-font-size:10.0pt;
      font-family:" noto="" sans="" kr",sans-serif;mso-bidi-font-family:gulim;="" letter-spacing:-.15pt;mso-font-kerning:0pt;mso-ligatures:none"="">ㆍ전동카트는 캐디에게
                                운전을 맡겨주시고 직접 운전하지 말아주세요</span><span style="mso-bidi-font-size:10.0pt;
      font-family:" noto="" sans="" kr",sans-serif;mso-bidi-font-family:gulim;="" letter-spacing:-.15pt;mso-font-kerning:0pt;mso-ligatures:none"="">.<o:p></o:p></span></li>
                        <li class="MsoNormal" style="color:#666666;margin-bottom:0in;text-align:left;
      line-height:19.5pt;mso-pagination:widow-orphan;mso-list:l1 level2 lfo2;
      tab-stops:list 1.0in;background:white;text-autospace:ideograph-numeric ideograph-other;
      word-break:normal"><span lang="KO" style="mso-bidi-font-size:10.0pt;
      font-family:" noto="" sans="" kr",sans-serif;mso-bidi-font-family:gulim;="" letter-spacing:-.15pt;mso-font-kerning:0pt;mso-ligatures:none"="">ㆍ날씨가 더운 경우
                                수분 부족으로 탈수 또는 열사병이 올 수 있으니 플레이 도중 충분히 수분 섭취를 하셔야 합니다</span><span style="mso-bidi-font-size:10.0pt;font-family:" noto="" sans="" kr",sans-serif;="" mso-bidi-font-family:gulim;letter-spacing:-.15pt;mso-font-kerning:0pt;="" mso-ligatures:none"="">.<o:p></o:p></span></li>
                        <li class="MsoNormal" style="color:#666666;margin-bottom:0in;text-align:left;
      line-height:19.5pt;mso-pagination:widow-orphan;mso-list:l1 level2 lfo2;
      tab-stops:list 1.0in;background:white;text-autospace:ideograph-numeric ideograph-other;
      word-break:normal"><span lang="KO" style="mso-bidi-font-size:10.0pt;
      font-family:" noto="" sans="" kr",sans-serif;mso-bidi-font-family:gulim;="" letter-spacing:-.15pt;mso-font-kerning:0pt;mso-ligatures:none"="">ㆍ골프장 특성상 뱀이나
                                벌 그 밖의 동물 및 곤충이 출몰할 수 있으니 물리거나 쏘이지 않게 주의해주세요</span><span style="mso-bidi-font-size:10.0pt;font-family:" noto="" sans="" kr",sans-serif;="" mso-bidi-font-family:gulim;letter-spacing:-.15pt;mso-font-kerning:0pt;="" mso-ligatures:none"="">.<o:p></o:p></span></li>
                    </ul>
                    <li class="MsoNormal" style="color:#555555;margin-bottom:11.25pt;text-align:
     left;line-height:19.5pt;mso-pagination:widow-orphan;mso-list:l1 level1 lfo2;
     tab-stops:list .5in;background:white;text-autospace:ideograph-numeric ideograph-other;
     word-break:normal"><span lang="KO" style="mso-bidi-font-size:10.0pt;
     font-family:" noto="" sans="" kr",sans-serif;mso-bidi-font-family:gulim;="" letter-spacing:-.15pt;mso-font-kerning:0pt;mso-ligatures:none"="">⑤ 스파</span><span style="mso-bidi-font-size:10.0pt;font-family:" noto="" sans="" kr",sans-serif;="" mso-bidi-font-family:gulim;letter-spacing:-.15pt;mso-font-kerning:0pt;="" mso-ligatures:none"="">(<span lang="KO">마사지</span>)<span lang="KO">시설 또는 관광지</span>(<span lang="KO">관광시설</span>)<o:p></o:p></span></li>
                    <ul style="margin-top:0in" type="circle">
                        <li class="MsoNormal" style="color:#666666;margin-bottom:0in;text-align:left;
      line-height:19.5pt;mso-pagination:widow-orphan;mso-list:l1 level2 lfo2;
      tab-stops:list 1.0in;background:white;text-autospace:ideograph-numeric ideograph-other;
      word-break:normal"><span lang="KO" style="mso-bidi-font-size:10.0pt;
      font-family:" noto="" sans="" kr",sans-serif;mso-bidi-font-family:gulim;="" letter-spacing:-.15pt;mso-font-kerning:0pt;mso-ligatures:none"="">ㆍ스파</span><span style="mso-bidi-font-size:10.0pt;font-family:" noto="" sans="" kr",sans-serif;="" mso-bidi-font-family:gulim;letter-spacing:-.15pt;mso-font-kerning:0pt;="" mso-ligatures:none"="">(<span lang="KO">마사지</span>) <span lang="KO">이용 중에 통증</span>,
                                <span lang="KO">알러지 반응 등이 있을 경우 참지 마시고 바로바로 마사지사에게 직접 이야기 하셔야 합니다</span>.<o:p></o:p></span></li>
                        <li class="MsoNormal" style="color:#666666;margin-bottom:0in;text-align:left;
      line-height:19.5pt;mso-pagination:widow-orphan;mso-list:l1 level2 lfo2;
      tab-stops:list 1.0in;background:white;text-autospace:ideograph-numeric ideograph-other;
      word-break:normal"><span lang="KO" style="mso-bidi-font-size:10.0pt;
      font-family:" noto="" sans="" kr",sans-serif;mso-bidi-font-family:gulim;="" letter-spacing:-.15pt;mso-font-kerning:0pt;mso-ligatures:none"="">ㆍ관광지 또는 관광시설
                                이용 시 해당장소 내 안전관련 유의 사항은 반드시 살펴 보는 것이 좋습니다</span><span style="mso-bidi-font-size:
      10.0pt;font-family:" noto="" sans="" kr",sans-serif;mso-bidi-font-family:gulim;="" letter-spacing:-.15pt;mso-font-kerning:0pt;mso-ligatures:none"="">.<o:p></o:p></span></li>
                        <li class="MsoNormal" style="color:#666666;margin-bottom:0in;text-align:left;
      line-height:19.5pt;mso-pagination:widow-orphan;mso-list:l1 level2 lfo2;
      tab-stops:list 1.0in;background:white;text-autospace:ideograph-numeric ideograph-other;
      word-break:normal"><span lang="KO" style="mso-bidi-font-size:10.0pt;
      font-family:" noto="" sans="" kr",sans-serif;mso-bidi-font-family:gulim;="" letter-spacing:-.15pt;mso-font-kerning:0pt;mso-ligatures:none"="">ㆍ동물원 관람 시 동물을
                                만지거나 자극하는 행위는 삼가 주세요</span><span style="mso-bidi-font-size:10.0pt;
      font-family:" noto="" sans="" kr",sans-serif;mso-bidi-font-family:gulim;="" letter-spacing:-.15pt;mso-font-kerning:0pt;mso-ligatures:none"="">. <span lang="KO">물리거나 다칠 위험이 있습니다</span>.<o:p></o:p></span></li>
                    </ul>
                </ul>

                <p class="MsoNormal" align="left" style="text-align:left;line-height:19.5pt;
mso-pagination:widow-orphan;background:white;text-autospace:ideograph-numeric ideograph-other;
word-break:normal"><span lang="KO" style="mso-bidi-font-size:10.0pt;font-family:
" noto="" sans="" kr",sans-serif;mso-bidi-font-family:gulim;color:#555555;letter-spacing:="" -.15pt;mso-font-kerning:0pt;mso-ligatures:none"="">※ 이 밖에도 여행 중에는 다양한 위험요소가 있을 수 있으며</span><span style="mso-bidi-font-size:10.0pt;font-family:" noto="" sans="" kr",sans-serif;="" mso-bidi-font-family:gulim;color:#555555;letter-spacing:-.15pt;mso-font-kerning:="" 0pt;mso-ligatures:none"="">, <span lang="KO">모든 위험요소를 나열할 수 없으므로 여행 중 매 순간 개인 안전에 철저히
                            주의해 주시길 당부 드립니다</span>.<o:p></o:p></span></p>

                <p class="MsoNormal">
                    <o:p>&nbsp;</o:p>
                </p><br>
                <p>&nbsp;</p>
            </div> -->
        </div>
</section>
<?php $this->endSection(); ?>