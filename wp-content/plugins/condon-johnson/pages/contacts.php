<script type="text/javascript"><?= ((!empty($redirect))?'window.location.href = "'.$redirect.'"':'')?></script>
<?php
  $contacts_list_table = new CJ_List("cj_contacts", [
    'name',
    'phone',
    'email',
    'subject',
    'message',
    'created'
    /*[
      'name'  => 'name',
      'label' => 'Name',
      'no_sort' => true
    ]*/
  ]);
?>

<div class="wrap">
    <h1>
        Contacts
    </h1>
     <?php $contacts_list_table->display(); ?>
</div>

