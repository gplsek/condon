        <div class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 col-sm-3 col-xs-6">
                        <ul class="menu">
                            <li><a href="/">HOME</a></li>
                            <li><a href="/about-us">ABOUT US</a></li>
                            <!--<li><a href="dewatering.html">DEWATERING</a></li>-->
                            <!--<li><a href="/services">SERVICES</a></li>-->
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
                                    <!--<li><a href="/earth-retention/#">Slope Stabilization</a></li>-->

                                    <li><a href="/earth-retention/#">Tieback Anchors</a></li>
                                    <li><a href="/earth-retention/#soldier_nail_walls">Soil Nails Walls</a></li>
                                    <li><a href="/earth-retention/#soldier_pile_walls">Soldier Pie Walls</a></li>
                                    <li><a href="/earth-retention/#soldier_mixed_walls">Soil Mixed Walls</a></li>


                                    <li><a href="/earth-retention/#sheet_piling">Sheet Piling</a></li>
                                    <li><a href="/earth-retention/#shear_pins">Shear Pins</a></li>
                                    <li><a href="/earth-retention/#secant_pile_systems">Secant Pie Walls</a></li>

                                    <li><a href="/earth-retention/#internal_bracing">Internal Bracing</a></li>
                                   <!-- <li><a href="/earth-retention/#">Underpinning</a></li>
                                    <li><a href="/earth-retention/#">Access Shafts</a></li>-->
                                </ul>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <div class="title">GROUND IMPROVEMENT</div>
                                <ul class="submenu hidden-xs">
                                    <li><a href="/ground-improvement/#permeation_dam_grouting">Permeation/Dam Grouting</a></li>
                                    <li><a href="/ground-improvement/#compaction_grouting">Compaction Grouting</a></li>
                                    <li><a href="/ground-improvement/#soil_mixing">Soil Mixing</a></li>
                                    <li><a href="/ground-improvement/#jet_grouting">Jet Grouting</a></li>
                                    <li><a href="/ground-improvement/#">Stone Columns</a></li>
                                    <!--<li><a href="/ground-improvement/#">Rigid Inclusions</a></li>
                                    <li><a href="/ground-improvement/#">Barrel Vaults</a></li>
                                    <li><a href="/ground-improvement/#">Compensation Grouting</a></li>-->

                                </ul>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <div class="title">DEEP FOUNDATION</div>
                                <ul class="submenu hidden-xs">
                                    <li><a href="/deep-foundation/#drilled_shafts">Drilled Shafts</a></li>
                                    <li><a href="/deep-foundation/#auger_cast_piles">Auger Cast Piles</a></li>
                                    <li><a href="/deep-foundation/#displacement_piles">Displacement Piles</a></li>
                                    <li><a href="/deep-foundation/#micropiles">Micropiles</a></li>
                                    <li><a href="/deep-foundation/#barettes">Barettes</a></li>
                                    <li><a href="/deep-foundation/#">Tiedowns</a></li>
                                </ul>
                                <!--<div class="title">DEWATERING</div>-->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <!--<div class="es_msg"><span id="es_msg_pg"></span></div>-->
                        <!--<div class="title">SIGN UP NEWSLETTER</div>-->
                        <div class="row">
                            <div class="col-md-12 col-sm-6 col-xs-12">
                            <!--    <div class="newsletter">
                                    <form class="subscribe-news" action="/?es=subscribe" method="post">
                                        <input id="es_txt_email_pg" class="email" type="email" name="es_email" placeholder="YOUR EMAIL ADDRESS">
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
                                </div>-->
                            </div>
                            <div class="col-md-12 col-sm-6 col-xs-12">
                                <div class="social-links">
                                    <?php
                                    $socialMedias = $wpdb->get_results("select * from cj_social_media where cj_social_media.photo <> ''", 'ARRAY_A');
                                    foreach ($socialMedias as $socialMedia) {
                                        ?>
                                        <a href="<?= $socialMedia['url'] ?>" class="social-icon">
                                            <img style="height: 40px;" src="/wp-content/uploads/<?= $socialMedia['photo'] ?>" alt="social media" />
                                        </a>
                                        <?php
                                    }
                                    ?>

                                   <!-- <a href="#" class="social-icon icon-youtube"></a><a href="#" class="social-icon icon-linkedin"></a>-->
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
