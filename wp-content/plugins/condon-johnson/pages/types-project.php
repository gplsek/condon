<script type="text/javascript"><?= ((!empty($redirect))?'window.location.href = "'.$redirect.'"':'')?></script>
<?php
  $types_list_table = new CJ_List("cj_types_project", [
    'name'
    /*[
      'name'  => 'name',
      'label' => 'Name',
      'no_sort' => true
    ]*/
  ], [
   'edit' => true,
  ]);
?>

<div class="wrap">
    <h1>
        Types project
        <a href="/wp-admin/admin.php?page=condonjohnson-type-project-create" class="page-title-action">Add New</a>
    </h1>
    <form method="post">
       <?php $types_list_table->display(); ?>
    </form>
</div>

