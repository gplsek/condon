<script type="text/javascript"><?= ((!empty($redirect))?'window.location.href = "'.$redirect.'"':'')?></script>

<div class="wrap">
    <h1><?= ((empty($affiliatedOrganization))?'New organization':$affiliatedOrganization['name']) ?></h1>
    <form id="formPublication" name="publication" enctype="multipart/form-data" method="post" autocomplete="off">
        <input type="hidden" name="id" value="<?= ((empty($affiliatedOrganization))?'':$affiliatedOrganization['id']) ?>">
        <div class="tool-box">
            <table class="form-table">
                <tr>
                    <th scope="row">
                        <label for="photo">Photo</label>
                    </th>
                    <td>
                        <img src="<?= ((!empty($affiliatedOrganization) && !empty($affiliatedOrganization['photo']))?'/wp-content/uploads/'.$affiliatedOrganization['photo']:'/wp-content/themes/condon-johnson/images/no-image-available.png') ?>" style="height: 100px;"/><br/>
                        <input style="width: 100%;" type="file" name="photo"  value="<?= ((empty($affiliatedOrganization))?'':$affiliatedOrganization['photo']) ?>">
                    </td>
                </tr>

                <tr>
                    <th scope="row">
                        <label for="name">Url</label>
                    </th>
                    <td>
                        <input style="width: 100%;" name="url" type="text" value="<?= ((empty($affiliatedOrganization))?'':$affiliatedOrganization['url']) ?>" maxlength="225" size="30"/>
                    </td>
                </tr>



            </table>
        </div>
        <?php
          submit_button();
        ?>
    </form>
</div>

