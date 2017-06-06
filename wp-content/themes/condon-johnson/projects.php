<?php
  /*
   Template Name: Projects Page
  */
  include('head.php')
?>

<style type="text/css">
   .filters-line a, .filters-list a, .cities-list a{
     cursor: pointer;
   }
</style>

    <div class="header header-color text-center">
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

    <div class="map-projects">
        <div id="map-canvas">
        </div>
        <div class="container">

            <div class="filters-container">
                <div class="row">
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="filters-wrapper">
                            <div class="filters-group">
                                <div class="filters">
                                    <div class="group accordion-list active">
                                        <div class="title">SELECT BY TYPE OF WORK</div>
                                        <ul class="list animate-slow filters-list">

                                        </ul>
                                    </div>
                                    <div class="group accordion-list">
                                        <div class="title">SELECT BY CITY</div>
                                        <ul class="list animate-slow cities-list">

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row visible-xs visible-sm">
                    <div class="col-md-12 text-center">
                        <img src="/wp-content/themes/condon-johnson/images/arrow-bottom.svg" title="arrow" />
                    </div>
                </div>
            </div>

            <!--<div class="filters-container">
                <div class="filters-wrapper">
                    <div class="row">
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="filters-group">
                                <div class="filters">
                                    <div class="group accordion-list active">
                                        <div class="title">SELECT BY TYPE OF WORK</div>
                                        <ul class="list animate-slow filters-list">

                                        </ul>
                                    </div>
                                    <div class="group accordion-list">
                                        <div class="title">SELECT BY CITY</div>
                                        <ul class="list animate-slow cities-list">

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row visible-xs visible-sm">
                        <a href="#bottom">
                            <div class="col-md-12 text-center">
                                <img src="/wp-content/themes/condon-johnson/images/arrow-bottom.svg" title="arrow" />
                            </div>
                        </a>
                    </div>
                </div>
            </div>-->



        </div>
    </div>
    <a name="bottom"></a>
    <div class="featured-projects recent-projects text-center">
        <div class="container">

            <h2>FEATURED PROJECTS</h2>
            <hr/>
            <div class="filters filters-line">
               <!-- <b>All</b> / Deep Foundations / Ground Improvement / Earth Retention / Dewatering-->
            </div>

            <div class="row projects-list">
            </div>

            <div>
                <a href="#" class="button button-orange animate-slow load-more-projects">See more</a>
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

        $('a[href="#bottom"]').on('click', function () {
            setTimeout(function () {
               $(document).scrollTop($(document).scrollTop() - 60);
            }, 200);
        });

      });
    </script>



    <?php
    while ( have_posts() ) : the_post();
        the_content();
    endwhile;
    ?>
    <script src="https: //maps.google.com/maps/api/js?sensor=true&key=AIzaSyCT_bOx9CleX3rEf1RnCg3Jl5m4Izj_ENk" type="text/javascript"></script>

    <?php get_footer(); ?>