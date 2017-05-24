<script type="text/javascript"><?= ((!empty($redirect))?'window.location.href = "'.$redirect.'"':'')?></script>
<?php
  $team_list_table = new CJ_List("cj_team", [
    [
      'name'  => 'photo_prev',
      'label' => 'Photo',
      'no_sort' => true
    ],
    'name',
    'position',
    [
        'name'  => 'description_prev',
        'label' => 'Description',
        'no_sort' => true
    ]
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
         CONCAT('<img src=\"', IF(cj_team.photo <> '', CONCAT('/wp-content/uploads/', cj_team.photo), '/wp-content/themes/condon-johnson/images/no-image-available.png'), '\" style=\"width: 150px;\">') as photo_prev,
         CONCAT(SUBSTRING(cj_team.description, 1, 200), ' ... ') as description_prev
       from cj_team
    ",
    'edit'       => true
  ]);
?>

<div class="wrap">
    <h1>
        Team
        <a href="/wp-admin/admin.php?page=condonjohnson-team-create" class="page-title-action">Add New</a>
    </h1>
    <form method="post">
       <?php $team_list_table->display(); ?>
     </form>
</div>

