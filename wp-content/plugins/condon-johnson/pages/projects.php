<script type="text/javascript"><?= ((!empty($redirect))?'window.location.href = "'.$redirect.'"':'')?></script>
<?php
  $projects_list_table = new CJ_List("cj_projects", [
    'name', 'description',
    [
      'name'  => 'type_name',
      'label' => 'Type',
      'no_sort' => true
    ]
  ], [
    'select_sql' => "
       select *, cj_types_project.name as type_name, cj_projects.name, cj_projects.id
       from cj_projects
       left JOIN cj_types_project on cj_types_project.id = cj_projects.type
    ",
    'edit'       => true
  ]);
?>
<div class="wrap">
    <h1>
      Projects
       <a href="/wp-admin/admin.php?page=condonjohnson-project-create" class="page-title-action">Add New</a>
    </h1>
    <form method="post">
        <?php $projects_list_table->display(); ?>
    </form>
</div>

