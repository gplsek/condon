<?php
  /*
   Template Name: Publications Page
  */
   get_header();
?>
    <div class="magazine">
        <div class="container">
            <div class="text-center">
                <h2>CJA MAGAZINE</h2>
                <hr />
            </div>
            <div class="row text-center">
                <div id="carousel-publications-1" class="carousel slide" data-ride="carousel_1">
                    <div class="items" style="display: none;">
                        <?php
                          $publications = $wpdb->get_results("select * from cj_publications where cj_publications.photo <> '' and cj_publications.type = 0", 'ARRAY_A');
                          foreach ($publications as $index => $publication) {
                             $photo = '/wp-content/themes/condon-johnson/images/no-image-available.png';
                             if (!empty($publication['photo'])) {
                               $photo = '/wp-content/uploads/'.$publication['photo'];
                             }
                        ?>
                              <div class="">
                                  <?php if (!empty($publication['donwload'])) {?>
                                  <a href="/wp-content/uploads/<?= $publication['donwload'] ?>" download>
                                      <?php } ?>
                                      <div><img src="<?= $photo ?>" title="<?= $publication['name'] ?>" style="max-height: 318px;"/></div>
                                      <div class="title"><?= $publication['name'] ?></div>
                                      <?php if (!empty($publication['donwload'])) {?>
                                  </a>
                              <?php } ?>
                              </div>

                        <?php } ?>
                    </div>
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                    </div>
                </div>
            </div>
        </div>
        <!-- Controls -->
        <?php if (count($publications) > 3) {?>
        <div class="arrows">
            <div class="arrow arrow-prev animate-slow" href="#carousel-publications-1" role="button" data-slide="prev"></div>
            <div class="arrow arrow-next animate-slow" href="#carousel-publications-1" role="button" data-slide="next"></div>
        </div>
        <?php } ?>
    </div>

<?php
  while ( have_posts() ) : the_post();
    the_content();
  endwhile;
?>

    <div class="published-articles">
        <div class="container">
            <div class="text-center">
                <h2>CJ PUBLISHED ARTICLES</h2>
                <hr />
            </div>
            <div class="row text-center">
                <div class="col-md-12 description">
                    The following is a list of published magazine articles that features Condon-Johnson &amp; Associates projects:
                </div>
            </div>
            <div class="row text-center">

                <div id="carousel-publications-2" class="carousel slide" data-ride="carousel_2">

                    <div class="items" style="display: none;">
                        <?php
                        $publications = $wpdb->get_results("select * from cj_publications where cj_publications.photo <> '' and cj_publications.type = 1", 'ARRAY_A');
                        foreach ($publications as $index => $publication) {
                            $photo = '/wp-content/themes/condon-johnson/images/no-image-available.png';
                            if (!empty($publication['photo'])) {
                                $photo = '/wp-content/uploads/'.$publication['photo'];
                            }
                            ?>
                            <div class="">
                                <?php if (!empty($publication['donwload'])) {?>
                                <a href="/wp-content/uploads/<?= $publication['donwload'] ?>" download>
                                    <?php } ?>
                                    <div><img src="<?= $photo ?>" title="<?= $publication['name'] ?>" style="max-height: 318px;"/></div>
                                    <div class="title"><?= $publication['name'] ?></div>
                                    <?php if (!empty($publication['donwload'])) {?>
                                </a>
                            <?php } ?>
                            </div>

                        <?php } ?>
                    </div>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                    </div>

                </div>
            </div>
        </div>
        <!-- Controls -->
        <?php if (count($publications) > 3) {?>
        <div class="arrows">
            <div class="arrow arrow-prev animate-slow" href="#carousel-publications-2" role="button" data-slide="prev"></div>
            <div class="arrow arrow-next animate-slow" href="#carousel-publications-2" role="button" data-slide="next"></div>
        </div>
        <?php } ?>
    </div>



<script type="text/javascript">
   $(document).ready(function () {
       $('.carousel').each(function (index, c) {
         var slides = $(c).find('div.items > div');
         var slideSize = 3;
         var slideLayoutClass = 'col-md-4 col-sm-4 col-xs-4';
         if (($(document).width() <= 600)) {
          // console.log('probably mobile layout');
           slideSize = 2;
           slideLayoutClass = 'col-md-6 col-sm-6 col-xs-6';
         }
         var countSlides = Math.ceil(slides.length/slideSize);
        /* console.log(slides.length);
         console.log(slideSize);
         console.log(countSlides);*/
         for (var i = 0; i < countSlides; i++) {
            var slide = $('<div class="item ' + ((i == 0)?'active':'') + '"></div>');
            for (var j = 0; j < slideSize; j++) {
              $(slide).append($(c).find('div.items > div:first').addClass(slideLayoutClass));
            }
            $(c).find('.carousel-inner').append(slide);
         }
       });
       $('.carousel').carousel({
           interval: 1500
       });
   });
</script>


<?php get_footer(); ?>