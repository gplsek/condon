<script type="text/javascript"><?= ((!empty($redirect))?'window.location.href = "'.$redirect.'"':'')?></script>

<div class="wrap">
    <h1><?= ((empty($socialMedia))?'New social media':$socialMedia['url']) ?></h1>
    <form id="formPublication" name="publication" enctype="multipart/form-data" method="post" autocomplete="off">
        <input type="hidden" name="id" value="<?= ((empty($socialMedia))?'':$socialMedia['id']) ?>">
        <div class="tool-box">
            <table class="form-table">
                <tr>
                    <th scope="row">
                        <label for="photo">Photo</label>
                    </th>
                    <td>
                        <img src="<?= ((!empty($socialMedia) && !empty($socialMedia['photo']))?'/wp-content/uploads/'.$socialMedia['photo']:'/wp-content/themes/condon-johnson/images/no-image-available.png') ?>" style="height: 100px;"/><br/>
                        <input style="width: 100%;" type="file" name="photo"  value="<?= ((empty($socialMedia))?'':$socialMedia['photo']) ?>">
                    </td>
                </tr>

                <tr>
                    <th scope="row">
                        <label for="name">Url</label>
                    </th>
                    <td>
                        <input style="width: 100%;" name="url" type="text" value="<?= ((empty($socialMedia))?'':$socialMedia['url']) ?>" maxlength="225" size="30"/>
                    </td>
                </tr>



            </table>
        </div>
        <?php
          submit_button();
        ?>
    </form>
</div>

