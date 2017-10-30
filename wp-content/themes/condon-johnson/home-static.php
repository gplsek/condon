<?php
  /*
   Template Name: Home Page
  */
  include('head.php')
?>

    <div class="header text-center">
        <div class="container">
            <a href="/" class="logo"></a>
            <button type="button" class="button-show-menu navbar-toggle collapsed" data-toggle="collapse" data-target="#top-nav-menu" aria-expanded="false">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="row top-menu">
                <div class="col-md-9 col-md-offset-3">

                    <?php include('header-menu.php') ?>
                </div>
            </div>
        </div>
    </div>



    <?php
      $publications = $wpdb->get_results("select * from cj_publications where cj_publications.photo <> '' and cj_publications.type = 2", 'ARRAY_A');
    ?>

    <div class="slider text-center">
        <div class="slider-wrapper animate-slow">
            <?php foreach ($publications as $publication) {?>
               <div class="slide-item slide-1" style="background-image: url(/wp-content/uploads/<?= $publication['photo'] ?>);"></div>
            <?php }?>
            <!--<div class="slide-item slide-1"></div>
            <div class="slide-item slide-2"></div>
            <div class="slide-item slide-3"></div>-->
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="square">
                        <h1>Condon-Johnson &amp; Associates has been the leading geotechnical construction contractor on the West Coast since 1974</h1>
                        <h5>Specializing in innovative and cost-effective solutions</h5>
                        <div class="actions">
                            <a href="/careers/" class="button button-white animate-slow">Careers</a>
                            <a href="/projects/" class="button button-white animate-slow">Our projects</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="arrows">
            <div class="arrow arrow-prev animate-slow" id="prev-slide"></div>
            <div class="arrow arrow-next animate-slow" id="next-slide"></div>
        </div>
    </div>







<?php
while ( have_posts() ) : the_post();
    the_content();
endwhile;
?>

    <div class="services text-center">
        <div class="container-fluid">
            <h2>Services</h2>
            <hr />
            <div class="row-fluid">
                <a href="/deep-foundation/">
                <div class="service service-1 col-md-3 col-xs-3" type="9">
                    <div class="content animate-slow">
                        <div class="title">DEEP FOUNDATIONS</div>
                    </div>
                </div>
                </a>
                <a href="/earth-retention/">
                <div class="service service-2 col-md-3 col-xs-3" type="10">
                    <div class="content animate-slow">
                        <div class="title">EARTH RETENTION</div>
                    </div>
                </div>
                </a>
                <a href="/ground-improvement/">
                <div class="service service-3 col-md-3 col-xs-3" type="11">
                    <div class="content animate-slow">
                        <div class="title">GROUND IMPROVEMENT</div>
                    </div>
                </div>
                </a>
                <a href="/dewatering/">
                <div class="service service-4 col-md-3 col-xs-3" type="12">
                    <div class="content animate-slow">
                        <div class="title">DEWATERING</div>
                    </div>
                </div>
                </a>
            </div>
        </div>
    </div>


    <div class="recent-projects text-center">
        <div class="container">
            <h2>Recent Projects</h2>
            <hr />
            <div class="row projects-list">

            </div>
            <div>
                <a href="#" class="button button-orange animate-slow load-more-projects">See more</a>
            </div>
        </div>
    </div>
    <div class="affiliated-organizations text-center">
        <div class="container">
            <h2>AFFILIATED ORGANIZATIONS</h2>
            <hr />

            <div class="row">
                <?php
                  $affiliatedOrganizations = $wpdb->get_results("select * from cj_affiliated_organizations where cj_affiliated_organizations.photo <> ''", 'ARRAY_A');
                  foreach ($affiliatedOrganizations as $affiliatedOrganization) {
                ?>
                      <div class="col-md-4 col-sm-4 col-xs-6">
                          <div class="organization">
                              <a href="<?= $affiliatedOrganization['url'] ?>"><img src="/wp-content/uploads/<?= $affiliatedOrganization['photo'] ?>" alt="organization" /></a>
                          </div>
                      </div>
                <?php
                  }
                ?>
                <!--<div class="col-md-4 col-sm-4 col-xs-6">
                    <div class="organization">
                        <a href="http://www.dfi.org"><img src="/wp-content/themes/condon-johnson/images/affiliated-organizations/dfi-logo.svg" alt="organization" /></a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-6">
                    <div class="organization">
                        <a href="http://www.adsc-iafd.com"><img src="/wp-content/themes/condon-johnson/images/affiliated-organizations/adsc-logo.svg" alt="organization" /></a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-6">
                    <div class="organization">
                        <a href="http://seattlegeotech.org"><img src="/wp-content/themes/condon-johnson/images/affiliated-organizations/asce-logo.svg" alt="organization" /></a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-6">
                    <div class="organization">
                        <a href="http://www.thebeavers.org"><img src="/wp-content/themes/condon-johnson/images/affiliated-organizations/thebeavers-logo.svg" alt="organization" /></a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-6">
                    <div class="organization">
                        <a href="http://www.unitedcontractors.org"><img src="/wp-content/themes/condon-johnson/images/affiliated-organizations/unitedcontractors-logo.svg" alt="organization" /></a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-6">
                    <div class="organization">
                        <a href="http://www.agcsd.org"><img src="/wp-content/themes/condon-johnson/images/affiliated-organizations/aac-logo.svg" alt="organization" /></a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-6">
                    <div class="organization">
                        <a href="http://www.geoinstitute.org"><img src="/wp-content/themes/condon-johnson/images/affiliated-organizations/geoinstitute-logo.svg" alt="organization" /></a>
                    </div>
                </div>-->
            </div>

        </div>
    </div>


    <script type="text/javascript">
        jQuery(document).ready(function () {
            getProjects(currentPage, currentType, currentCity);
            jQuery('.load-more-projects').on('click', function (e) {
                e.preventDefault();
                currentPage++;
                getProjects(currentPage, currentType, currentCity);
            });


            jQuery('.service').on('click', function () {
                // console.log('+++');
                // services-active

                currentPage = 1;
                currentCity = '';
                if (jQuery(this).hasClass('services-active')) {
                  currentType = -1;
                  jQuery('.service').removeClass('services-active');
                } else {
                  currentType = jQuery(this).attr('type');
                  jQuery('.service').removeClass('services-active');
                  jQuery(this).addClass('services-active');
                }
                getProjects(currentPage, currentType, currentCity);
            });

        });
    </script>


  <!--  --><?php
/*    while ( have_posts() ) : the_post();
        the_content();
    endwhile;

    */?>

    <?php get_footer(); ?>