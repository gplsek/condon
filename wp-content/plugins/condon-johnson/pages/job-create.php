<script type="text/javascript"><?= ((!empty($redirect))?'window.location.href = "'.$redirect.'"':'')?></script>

<div class="wrap">
    <h1><?= ((empty($job))?'New job':$job['name']) ?></h1>
    <form id="formJob" name="job" method="post" autocomplete="off">
        <input type="hidden" name="id" value="<?= ((empty($job))?'':$job['id']) ?>">
        <div class="tool-box">
            <table class="form-table">
                <tr>
                    <th scope="row">
                        <label for="name">Name</label>
                    </th>
                    <td>
                        <input style="width: 100%;" name="name" type="text" value="<?= ((empty($job))?'':$job['name']) ?>" maxlength="225" size="30" required/>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="name">Location</label>
                    </th>
                    <td>
                        <input style="width: 100%;" name="location" type="text" value="<?= ((empty($job))?'':$job['location']) ?>" maxlength="225" size="30" required/>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="description">Description</label>
                    </th>
                    <td>
                        <textarea style="width: 100%;" rows="3" cols="45" name="description"><?= ((empty($job))?'':$job['description']) ?></textarea>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="name">URL</label>
                    </th>
                    <td>
                        <input style="width: 100%;" name="url" type="text" value="<?= ((empty($job))?'':$job['url']) ?>" maxlength="225" size="30" required/>
                    </td>
                </tr>
            </table>
        </div>
        <?php
          submit_button();
        ?>
    </form>
</div>

