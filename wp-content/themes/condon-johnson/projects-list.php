<?php
  /*
   Template Name: Projects List Page
  */
   get_header();
?>

    <div class="projects-list">
        <div class="container">

            <?php
              $projects = $wpdb->get_results("select * from cj_projects  order by created desc", 'ARRAY_A');
            ?>

               <?php
                  foreach ($projects as $index => $project) {
                    $photo  = '/wp-content/themes/condon-johnson/images/no-image-available.png';
                    $photos = $wpdb->get_results("select * from cj_photos_project where cj_photos_project.project_id = ".$project['id'], 'ARRAY_A');
                    if (count($photos) > 0) {
                      $photo = '/wp-content/uploads/'.$photos[0]['photo'];
                    }
                ?>
                <a name="project_<?= $project['id'] ?>" style="display: block; height: <?= (($index == 0)?'40':'140') ?>px;"></a>
                <?php if ($index == 0) { ?>
                    <div class="text-center">
                       <h2 style="padding: 0;">PROJECTS</h2>
                        <hr />
                    </div>
                <?php } 
				
				if (trim($project['description']) != ''){
				?>
                <div class="row" style="padding: 0;">
                    
                    <div class="col-md-6 col-sm-6">
                        <div class="title"><?= $project['name'] ?></div>
                        <div class="content">
                            <?= $project['description'] ?>
                        </div>
                    </div>
					
					
                    <div class="col-md-6 col-sm-6">
                        <?php if (count($photos) > 1) {
                        ?>
                            <div id="carousel-project-<?= $project['id'] ?>" class="carousel slide" data-ride="carousel" data-interval="false">
                                <!-- Wrapper for slides -->
                                <div class="carousel-inner" role="listbox">
                                    <?php foreach ($photos as $index => $p) {
                                    ?>
                                        <div class="item <?= ($index == 0)?'active':'' ?>">
                                            <img src="/wp-content/uploads/<?= $p['photo'] ?>" alt="text">
                                        </div>
                                    <?php }?>

                                    <!--<div class="item active">
                                        <img src="images/project-1-1.jpg" alt="text">
                                    </div>-->

                                </div>
                                <!-- Controls -->
                                <div class="arrows">
                                    <div class="arrow arrow-prev animate-slow" href="#carousel-project-<?= $project['id'] ?>" role="button" data-slide="prev"></div>
                                    <div class="arrow arrow-next animate-slow" href="#carousel-project-<?= $project['id'] ?>" role="button" data-slide="next"></div>
                                </div>
                            </div>
                        <?php } else {?>
                            <img src="<?= $photo ?>" title="<?= $project['name'] ?>">
                        <?php }?>
                    </div>
					
					
					
                </div>
				<?php }?> <!-- Make sure is a full project -->
            <?php } ?>
        </div>
    </div>



<?php get_footer(); ?>