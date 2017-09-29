<?php
  /*
    Template Name: Search Page
  */
  get_header();
?>

<?php

    $s = $_COOKIE["s"];
    $total_results = 0;
    $pageSize = 5;

    if (strlen($s) > 3) {
        global $wpdb;
        $sql = "
      select * from wp_posts
      where
        wp_posts.post_type = 'page' and
        (wp_posts.post_content LIKE '%{$s}%' OR wp_posts.post_title LIKE '%{$s}%')
    ";
        $result = $wpdb->get_results($sql, 'ARRAY_A');
        $total_results = count($result);
    }
?>

<div class="new-search">
    <div class="container">
        <div class="title">New Search</div>
        <div class="row">
            <div class="col-md-4 col-sm-6">
                <div class="search-form">
                    <form id="searchform" role="search" method="get" action="/search">
                        <input  id="s" name="s"   type="text" placeholder="Write search text..." class="search-input" value="<?= $s ?>">
                        <button id="searchsubmit" type="submit" class="search-button animate-slow"><i class="glyphicon glyphicon-search"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if ($total_results > 0) {?>
<div class="search-result">
    <div class="container">
        <div class="title"><?= $total_results ?> SEARCH RESULTS FOR: <?= $s ?></div>
        <div class="search-result-list">
            <ol>
               <?php
                 $page = 0;
                 foreach ($result as $index => $r) {
                    if ($index % $pageSize == 0) {
                      $page++;
                    }
               ?>
                  <li page="<?= $page ?>" style="display: none;"><a href="/<?= $r['post_name'] ?>"><?= $r['post_title'] ?></a> </li>
               <?php } ?>
            </ol>
        </div>

        <?php if (ceil($total_results/$pageSize) > 1) {?>
        <div class="search-pagination text-right">
            <ul class="pagination">
                <li>
                    <a href="#" aria-label="Previous" prev>
                        <i class="glyphicon glyphicon-menu-left"></i>
                    </a>
                </li>
                <li><a href="#" page="1" class="active">1</a></li>
                <?php
                  for ($i = 2; $i <= ceil($total_results/$pageSize); $i++) {
                ?>
                  <li><a href="#" page="<?= $i ?>"><?= $i ?></a></li>
                <?php } ?>
                <li>
                    <a href="#" aria-label="Next" next>
                        <i class="glyphicon glyphicon-menu-right"></i>
                    </a>
                </li>
            </ul>
        </div>
        <?php } ?>


    </div>
</div>
<?php } ?>

<script type="text/javascript">
   $(document).ready(function () {
     $('li[page]').hide();
     $('li[page=1]').show();
     $('a[page]').on('click', function () {
         $('a[page]').removeClass('active');
         $(this).addClass('active');
         $('li[page]').hide();
         $('li[page=' + $(this).attr('page') + ']').show();
     });
     $('a[next]').on('click', function () {
        var p = parseInt($('a.active[page]').attr('page')) + 1;
        if ( $('a[page=' + p + ']').length > 0) {
           $('a[page]').removeClass('active');
           $('a[page=' + p + ']').addClass('active');
           $('li[page]').hide();
           $('li[page=' + p + ']').show();
        }
     });
     $('a[prev]').on('click', function () {
           var p = parseInt($('a.active[page]').attr('page')) - 1;
           if ( $('a[page=' + p + ']').length > 0) {
               $('a[page]').removeClass('active');
               $('a[page=' + p + ']').addClass('active');
               $('li[page]').hide();
               $('li[page=' + p + ']').show();
           }
     });




       $('body').addClass('search page-template-search');
     $('#searchform').submit(function (e) {
         e.preventDefault();
         //console.log($('input[name="s"]').val());
         $.cookie('s', $('#searchform').find('input[name="s"]').val());
         location.reload();
     });
   });
</script>



<?php get_footer(); ?>


