        <div class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 col-sm-3 col-xs-6">
                        <ul class="menu">
                            <li><a href="/">HOME</a></li>
                            <li><a href="/about-us">ABOUT US</a></li>
                            <!--<li><a href="dewatering.html">DEWATERING</a></li>-->
                            <li><a href="/services">SERVICES</a></li>
                            <li><a href="/projects">PROJECTS</a></li>
                            <li><a href="/publications">PUBLICATIONS</a></li>
                            <li><a href="/careers">CAREERS</a></li>
                            <li><a href="/contact">CONTACT US</a></li>
                        </ul>
                    </div>
                    <div class="col-md-6 col-sm-9 col-xs-6">
                        <div class="row">
                            <div class="col-md-4 col-sm-4">
                                <div class="title">EARTH RETENTION</div>
                                <ul class="submenu hidden-xs">
                                    <li>Slope Stabilization</li>
                                    <li>Soil Nails Walls</li>
                                    <li>Soldier Pie Walls</li>
                                    <li>Soil Mixed Walls</li>
                                    <li>Secant Pie Walls</li>
                                    <li>Internal Bracing</li>
                                    <li>Sheet Piling</li>
                                    <li>Underpinning</li>
                                    <li>Access Shafts</li>
                                </ul>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <div class="title">GROUND IMPROVEMENT</div>
                                <ul class="submenu hidden-xs">
                                    <li>Permeation/Dam Grouting</li>
                                    <li>Compaction Grouting</li>
                                    <li>Soil Mixing</li>
                                    <li>Jet Grouting</li>
                                    <li>Stone Columns</li>
                                    <li>Rigid Inclusions</li>
                                    <li>Barrel Vaults</li>
                                    <li>Compensation Grouting</li>

                                </ul>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <div class="title">DEEP FOUNDATION</div>
                                <ul class="submenu hidden-xs">
                                    <li>Drilled Shafts</li>
                                    <li>Auger Cast Piles</li>
                                    <li>Displacement Piles</li>
                                    <li>Micropiles</li>
                                    <li>Barettes</li>
                                    <li>Tiedowns</li>
                                </ul>
                                <!--<div class="title">DEWATERING</div>-->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <!--<div class="es_msg"><span id="es_msg_pg"></span></div>-->
                        <div class="title">SIGN UP NEWSLETTER</div>
                        <div class="row">
                            <div class="col-md-12 col-sm-6 col-xs-12">
                                <div class="newsletter">
                                    <form class="subscribe-news" action="/?es=subscribe" method="post">
                                        <input id="es_txt_email_pg" class="email" type="email" name="es_email" placeholder="YOUR EMAIL ADDRESS">
                                        <!--<input name="es_txt_name_pg" id="es_txt_name_pg" value="" type="hidden">
                                        <input name="es_txt_group_pg" id="es_txt_group_pg" value="" type="hidden">-->
                                        <input class="submit animate-slow" type="submit" value="send">
                                    </form>
                                    <script type="text/javascript">
                                      $(document).ready(function () {
                                         $('form.subscribe-news > input[type="submit"]').on('click', function (e) {
                                            console.log('subscribe');
                                            $.post('/?es=subscribe', {
                                              'es_email': $('form.subscribe-news > input[name="es_email"]').val()
                                            }, function (res) {
                                               // console.log(res);
                                               alert('You successfully subscribed. Please check your email ' + $('form.subscribe-news > input[name="es_email"]').val() + ' and confirm there.');
                                               $('form.subscribe-news > input[name="es_email"]').val('');
                                            });
                                            e.preventDefault();
                                         });
                                      });
                                    </script>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-6 col-xs-12">
                                <div class="social-links">
                                    <a href="#" class="social-icon icon-youtube"></a><a href="#" class="social-icon icon-linkedin"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright text-center">
            <div class="container">
                Copyright - Condon Johnson &amp; Associates. Designed by <a href="http://www.humangrp.com" class="designed-by">HUMAN.</a>
            </div>
        </div>

<!-- close wrapper -->
    </div>


        <?php wp_footer(); ?>
</body>

</html>
