<?php
  /*
   Template Name: About Person Page
  */
   get_header();
?>

    <div class="team-item-description">
        <div class="container">
            <?php
              $person = $wpdb->get_results("select * from cj_team where cj_team.id = ".$_GET['id'], 'ARRAY_A');
            ?>
            <?php
            if (!empty($person)) {
                $person = $person[0];
                $photo  = '/wp-content/themes/condon-johnson/images/no-image-available.png';
                if (!empty($person['photo'])) {
                    $photo = '/wp-content/uploads/'.$person['photo'];
                }
            ?>
                <div class="row" style="">
                    <div class="col-md-6 col-sm-6"><img src="<?= $photo ?>" title="<?= $person['name'] ?>"></div>
                    <div class="col-md-6 col-sm-6">
                        <div class="title"><?= $person['name'] ?> -  <?= $person['position'] ?> </div>

                        <div class="content">
                            <?= $person['description'] ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

<?php get_footer(); ?>