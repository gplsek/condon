<script type="text/javascript"><?= ((!empty($redirect))?'window.location.href = "'.$redirect.'"':'')?></script>

<div class="wrap">
    <h1><?= ((empty($publication))?'New publication':$publication['name']) ?></h1>
    <form id="formPublication" name="publication" enctype="multipart/form-data" method="post" autocomplete="off">
        <input type="hidden" name="id" value="<?= ((empty($publication))?'':$publication['id']) ?>">
        <div class="tool-box">
            <table class="form-table">
                <tr>
                    <th scope="row">
                        <label for="photo">Photo</label>
                    </th>
                    <td>
                        <img src="<?= ((!empty($publication) && !empty($publication['photo']))?'/wp-content/uploads/'.$publication['photo']:'/wp-content/themes/condon-johnson/images/no-image-available.png') ?>" style="height: 100px;"/><br/>
                        <input style="width: 100%;" type="file" name="photo"  value="<?= ((empty($publication))?'':$publication['photo']) ?>">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="type">Type</label>
                    </th>
                    <td>
                        <?php
                          $types = ['Magazine', 'Article', 'Front page'];
                        ?>
                        <select name="type">
                            <?php foreach ($types as $index => $type) {?>
                              <option value="<?= $index ?>" <?= ((!empty($publication) && $publication['type'] == $index)?'selected':'') ?> ><?= $type ?></option>
                            <?php }?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="name">Name</label>
                    </th>
                    <td>
                        <input style="width: 100%;" name="name" type="text" value="<?= ((empty($publication))?'':$publication['name']) ?>" maxlength="225" size="30"/>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="attachment">Attachment</label>
                    </th>
                    <td>
                        <b><?= ((!empty($publication) && !empty($publication['donwload']))?'<a href="/wp-content/uploads/'.$publication['donwload'].'">Attachment</a>':'No Attachment') ?></b>
                        <input style="width: 100%;" type="file" name="donwload"  value="<?= ((empty($publication))?'':$publication['donwload']) ?>">
                    </td>
                </tr>


            </table>
        </div>
        <?php
          submit_button();
        ?>
    </form>
</div>

