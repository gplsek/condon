<?php
  /*
   Template Name: Careers Page
  */
   get_header();
?>

<?php
  while ( have_posts() ) : the_post();
    the_content();
  endwhile;
?>


    <div class="careers">
        <div class="container">

           <div class="row">

               <?php
                 $jobs = $wpdb->get_results("select * from cj_jobs", 'ARRAY_A');
               ?>

               <!--style="margin-top: 20px;"-->
               <?php foreach ($jobs as $job) {?>
                   <div class="col-md-4 col-sm-4 col-xs-6">
                       <div class="career-item">
                           <div class="title"><?= $job['name'] ?></div>
                           <div class="city"><?= $job['location'] ?></div>
                           <!--style="height: 70px; overflow: hidden;"-->
                           <div class="text">
                               <?= substr($job['description'], 0, 100) ?> . . .
                           </div>
                           <div class="apply-now text-center">
                               <a href="<?= $job['url'] ?>" class="button button-orange animate-slow">APPLY NOW</a>
                           </div>
                       </div>
                   </div>

               <?php }?>

    </div>

        </div>
    </div>

    <script type="text/javascript">
        jQuery(document).ready(function () {


            $('a[href="#careers"]').on('click', function () {
                setTimeout(function () {
                    $(document).scrollTop($(document).scrollTop() - 60);
                }, 200);
            });

        });
    </script>




<?php get_footer(); ?>