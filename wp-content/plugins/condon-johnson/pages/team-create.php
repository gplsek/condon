<script type="text/javascript"><?= ((!empty($redirect))?'window.location.href = "'.$redirect.'"':'')?></script>

<div class="wrap">
    <h1><?= ((empty($member))?'New Member of Condon Johnson TEAM':$member['name']) ?></h1>
    <form id="formMember" name="member" enctype="multipart/form-data" method="post" autocomplete="off">
        <input type="hidden" name="id" value="<?= ((empty($member))?'':$member['id']) ?>">
        <div class="tool-box">
            <table class="form-table">
                <tr>
                    <th scope="row">
                        <label for="photo">Photo</label>
                    </th>
                    <td>
                        <img src="<?= ((!empty($member) && !empty($member['photo']))?'/wp-content/uploads/'.$member['photo']:'/wp-content/themes/condon-johnson/images/no-image-available.png') ?>" style="height: 100px;"/><br/>
                        <input style="width: 100%;" type="file" name="photo"  value="<?= ((empty($member))?'':$member['photo']) ?>">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="name">Name</label>
                    </th>
                    <td>
                        <input style="width: 100%;" name="name" type="text" value="<?= ((empty($member))?'':$member['name']) ?>" maxlength="225" size="30" required/>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="name">Position</label>
                    </th>
                    <td>
                        <input style="width: 100%;" name="position" type="text" value="<?= ((empty($member))?'':$member['position']) ?>" maxlength="225" size="30" required/>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="description">Description</label>
                    </th>
                    <td>
                        <textarea style="width: 100%;" rows="3" cols="45" name="description"><?= ((empty($member))?'':$member['description']) ?></textarea>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="name">Order</label>
                    </th>
                    <td>
                        <input style="width: 100%;" name="feature" type="number" min="0" step="1" value="<?= ((empty($member))?'':$member['feature']) ?>" maxlength="225" size="30"/>
                    </td>
                </tr>
            </table>
        </div>
        <?php
          submit_button();
        ?>
    </form>
</div>

