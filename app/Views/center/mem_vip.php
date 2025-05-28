<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>
<link href="/css/center/center.css" rel="stylesheet" type="text/css" />
<link href="/css/center/center_responsive.css" rel="stylesheet" type="text/css" />
<link href="/css/center/img_convert.css" rel="stylesheet" type="text/css" />
<section class="privacy">
          <?php
          echo view("center/center_term", ["tab9" => "on"]);
          ?>
          <div class="inner">
                    <div class="point_use" itemprop="description">
                              <div class="top_exp mem_vip">
                                        <strong>더투어랩 VIP 회원제</strong>
                                        <em>더투어랩은 VIP 회원의 문턱이 낮습니다.</em>
                                        <p>보다 많은 분들이 혜택을 누릴 수 있도록 진입 장벽을 확 낮추었습니다. <br class="only_web"> <br class="only_mo">
                                                  계속해서 많은 관심과 이용 부탁드립니다. <br class="only_web">
                                        </p>
                                        <span class="mem_vip_txt" style="">2022년 7월 25일부터 개편된 회원 등급 규정이 적용됩니다. </span>
                              </div>
                              <div class="section">
                                        <h3>VIP 회원제 안내</h3>
                                        <div class="cont">
                                                  <h4>적립대상</h4>
                                                  <div class="c_cont">
                                                            5년 누적 결제 금액 300만원 이상
                                                  </div>
                                                  <h4>VIP 회원 혜택</h4>
                                                  <div class="c_cont">
                                                            타 등급 대비 높은 포인트 적립률 <br>
                                                            <ol>
                                                                      <li class="f_bold">• 현금결제 4% (무통장, 실시간 계좌이체, 가상계좌)</li>
                                                                      <li class="f_bold">• 신용카드, 간편결제 2.5%</li>
                                                            </ol>
                                                            <br>
                                                            바트화 결제는 포인트 적립 및 사용이 불가능합니다. <br>
                                                            더투어랩 월드(태국,베트남,대만,필리핀,괌을 제외한 전 세계 호텔)의 포인트 제도는 별도로 적용됩니다.<br>
                                                            실버회원 1%, 골드회원 1%, VIP 회원 1.5%
                                                  </div>
                                                  <h4>추가 할인</h4>
                                                  <div class="c_cont">
                                                            호텔 1박당 50바트 할인<br>
                                                            골프, 투어 1인당 50바트 할인<br>
                                                            차량 1대당 100바트 할인
                                                  </div>
                                                  <h4>VIP 회원 전용 할인 쿠폰</h4>
                                                  <div class="c_cont">
                                                            VIP 회원 적용 추가 할인 쿠폰을 지속해서 발급해 드릴 예정입니다.
                                                  </div>
                                        </div>
                              </div>
                    </div>
          </div>

</section>

<?php $this->endSection(); ?>