<?php
  /*
   Template Name: About Us Page
  */
   get_header();
?>

<?php
while ( have_posts() ) : the_post();
    the_content();
endwhile;
?>

    <div class="meet-the-team">
        <div class="container">
            <div class="text-center">
                <h2>MEET THE TEAM</h2>
                <hr />
            </div>

            <?php
              $team = $wpdb->get_results("select * from cj_team", 'ARRAY_A');
            ?>




            <div class="row">
                <?php
                  foreach ($team as $member) {
                    $photo  = '/wp-content/themes/condon-johnson/images/no-image-available.png';
                    if (!empty($member['photo'])) {
                      $photo = '/wp-content/uploads/'.$member['photo'];
                    }
                ?>
                    <div class="col-md-4 col-xs-6" style="max-height: 542px; margin-bottom: 20px;">
                        <div class="team-item team-person">
                           
                            <div class="photo"><a href="/about-person/?id=<?= $member['id'] ?>"><img src="<?= $photo ?>" alt="team" /></a></div>

                            <div class="title"><?= $member['name'] ?></div>
                            <div class="subtitle"><?= $member['position'] ?></div>
                            <div class="content" style="max-height: 130px; overflow: hidden;">
                                <p>
                                    <?= substr($member['description'], 0, 165) ?> . . .
                                    <a href="/about-person/?id=<?= $member['id'] ?>" class="read-more">SEE MORE</a>
                                </p>
                            </div>

                        </div>
                    </div>
                <?php }?>



            </div>
        </div>






    </div>

<script type="text/javascript">
   jQuery(document).ready(function () {
       jQuery('.team-person').on('click', function () {
          jQuery('.modal-body img').attr('src', jQuery(this).find('img').attr('src'));
          jQuery('.modal-body .title').html(jQuery(this).find('.title').html());
          jQuery('.modal-body .subtitle').html(jQuery(this).find('.subtitle').html());
           jQuery('.modal-body .content-more').html(jQuery(this).find('.content').html());

       });

   });
</script>


<?php get_footer(); ?>