<script type="text/javascript"><?= ((!empty($redirect))?'window.location.href = "'.$redirect.'"':'')?></script>
<?php
  $publications_list_table = new CJ_List("cj_publications", [
    [
      'name'  => 'photo_prev',
      'label' => 'Photo',
      'no_sort' => true
    ],
    [
      'name'  => 'name',
      'label' => 'Caption',
    ],
    [
      'name'  => 'type_prev',
      'label' => 'Type',
    ],
    [
      'name'  => 'donwload_prev',
      'label' => 'Attachment',
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
         CONCAT('<img src=\"', IF(cj_publications.photo <> '', CONCAT('/wp-content/uploads/', cj_publications.photo), '/wp-content/themes/condon-johnson/images/no-image-available.png'), '\" style=\"width: 150px;\">') as photo_prev,
         IF(name <> '', name, 'No caption') as name_prev,
         CASE type WHEN 0 THEN 'Magazine' WHEN 1 THEN 'Article' WHEN 2 THEN 'Front page' END as type_prev,
         IF(donwload <> '', CONCAT('<a href=\"/wp-content/uploads/', donwload,'\" download>', 'Attachment' ,'</a>'), 'No Attachment') as donwload_prev
       from cj_publications
    ",
    'edit'       => true
  ]);
?>

<div class="wrap">
    <h1>
        Publications
        <a href="/wp-admin/admin.php?page=condonjohnson-publication-create" class="page-title-action">Add New</a>
    </h1>
    <form method="post">
       <?php $publications_list_table->display(); ?>
     </form>
</div>

