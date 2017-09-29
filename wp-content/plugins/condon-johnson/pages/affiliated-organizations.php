<script type="text/javascript"><?= ((!empty($redirect))?'window.location.href = "'.$redirect.'"':'')?></script>
<?php
  $affiliated_organizations_list_table = new CJ_List("cj_affiliated_organizations", [
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
         CONCAT('<img src=\"', IF(cj_affiliated_organizations.photo <> '', CONCAT('/wp-content/uploads/', cj_affiliated_organizations.photo), '/wp-content/themes/condon-johnson/images/no-image-available.png'), '\" style=\"width: 150px;\">') as photo_prev,
         CONCAT('<a href=\"?page=".esc_attr($_REQUEST['page'])."&action=edit&id=', id,'\">', url, '</a>') as url_prev
       from cj_affiliated_organizations
    ",
    'edit'       => true
  ]);
?>

<div class="wrap">
    <h1>
        Affiliated organizations
        <a href="/wp-admin/admin.php?page=condonjohnson-affiliated-organization-create" class="page-title-action">Add New</a>
    </h1>
    <form method="post">
       <?php $affiliated_organizations_list_table->display(); ?>
     </form>
</div>

