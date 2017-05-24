<?php
  get_header();

  // /wp-content/themes/condon-johnson/

?>

<?php
  while ( have_posts() ) : the_post();
   the_content();
  endwhile;
?>

<?php get_footer(); ?>


