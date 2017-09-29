<script type="text/javascript"><?= ((!empty($redirect))?'window.location.href = "'.$redirect.'"':'')?></script>
<?php
  $social_medias_list_table = new CJ_List("cj_social_media", [
    [
      'name'  => 'photo_prev',
      'label' => 'Photo',
      'no_sort' => true
    ],
    [
      'name'  => 'url_prev',
      'label' => 'URL',
      'no_sort' => true
    ],
    //'created'
    /*[
      'name'  => 'name',
      'label' => 'Name',
      'no_sort' => true
    ]*/
  ], [
    'select_sql' => "
       select
         *,
         CONCAT('<div style=\"background-color: darkgrey;\"><img src=\"', IF(cj_social_media.photo <> '', CONCAT('/wp-content/uploads/', cj_social_media.photo), '/wp-content/themes/condon-johnson/images/no-image-available.png'), '\" style=\"width: 150px;\"></div>') as photo_prev,
         CONCAT('<a href=\"?page=".esc_attr($_REQUEST['page'])."&action=edit&id=', id,'\">', url, '</a>') as url_prev
       from cj_social_media
    ",
    'edit'       => true
  ]);
?>

<div class="wrap">
    <h1>
        Social medias
        <a href="/wp-admin/admin.php?page=condonjohnson-social-media-create" class="page-title-action">Add New</a>
    </h1>
    <form method="post">
       <?php $social_medias_list_table->display(); ?>
     </form>
</div>

