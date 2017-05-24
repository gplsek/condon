<script type="text/javascript"><?= ((!empty($redirect))?'window.location.href = "'.$redirect.'"':'')?></script>
<?php
  $jobs_list_table = new CJ_List("cj_jobs", [
    'name',
    'location',
    'description',
    //'created'
    /*[
      'name'  => 'name',
      'label' => 'Name',
      'no_sort' => true
    ]*/
  ], [
    'edit'       => true
  ]);
?>

<div class="wrap">
    <h1>
        Jobs
        <a href="/wp-admin/admin.php?page=condonjohnson-job-create" class="page-title-action">Add New</a>
    </h1>
    <form method="post">
       <?php $jobs_list_table->display(); ?>
     </form>
</div>

