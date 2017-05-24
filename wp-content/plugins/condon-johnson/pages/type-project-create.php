<script type="text/javascript"><?= ((!empty($redirect))?'window.location.href = "'.$redirect.'"':'')?></script>
<div class="wrap">
    <h1><?= ((empty($type_project))?'New type project':$type_project['name']) ?></h1>
    <form name="type-project" method="post" autocomplete="off">
        <input type="hidden" name="id" value="<?= ((empty($type_project))?'':$type_project['id']) ?>">
        <div class="tool-box">
           <table class="form-table">
               <tr>
                   <th scope="row">
                       <label for="name">Type name</label>
                   </th>
                   <td>
                       <input name="name" type="text" id="name" value="<?= ((empty($type_project))?'New type project':$type_project['name']) ?>" maxlength="225" size="30" required/>
                   </td>
               </tr>
           </table>
        </div>
        <?php
        submit_button();
        ?>
    </form>
</div>

