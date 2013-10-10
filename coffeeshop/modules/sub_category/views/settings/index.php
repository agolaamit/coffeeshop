<div class="admin-box">
    <h3>Sub Category</h3>
    <?php echo form_open($this->uri->uri_string()); ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <?php if ($this->auth->has_permission('Sub_Category.Settings.Delete') && isset($records) && is_array($records) && count($records)) : ?>
                    <th class="column-check"><input class="check-all" type="checkbox" /></th>
                <?php endif; ?>

                <th>Name</th>
                <th>Parent</th>
                <?php if ($this->auth->has_permission('Sub_Category.Settings.Edit')) : ?>
                <th>Action</th>
                <?php endif; ?>
            </tr>
        </thead>
        <?php if (isset($records) && is_array($records) && count($records)) : ?>
            <tfoot>
                <?php if ($this->auth->has_permission('Sub_Category.Settings.Delete')) : ?>
                    <tr>
                        <td colspan="3">
                            <?php echo lang('bf_with_selected') ?>
                            <input type="submit" name="delete" id="delete-me" class="btn btn-danger" value="<?php echo lang('bf_action_delete') ?>" onclick="return confirm('<?php echo lang('sub_category_delete_confirm'); ?>')">
                        </td>
                    </tr>
                <?php endif; ?>
            </tfoot>
        <?php endif; ?>
        <tbody>
            <?php if (isset($records) && is_array($records) && count($records)) : ?>
                <?php foreach ($records as $record) : ?>
                    <tr>
                        <?php if ($this->auth->has_permission('Sub_Category.Settings.Delete')) : ?>
                            <td><input type="checkbox" name="checked[]" value="<?php echo $record->id ?>" /></td>
                        <?php endif; ?>

                        <td><?php echo $record->sub_category_name ?></td>
                        <?php
                        if ($record->cafe_id == '1')
                        {
                            $cat = 'Food';
                        }
                        elseif ($record->cafe_id == '2')
                        {
                            $cat = 'Drink';
                        }
                        else
                        {
                            $cat = 'Coffee';
                        }
                        ?>

                        <td><?php echo $cat ?></td>

                        <?php if ($this->auth->has_permission('Sub_Category.Settings.Edit')) : ?>
                            <td><?php echo anchor(SITE_AREA . '/settings/sub_category/edit/' . $record->id, '<i class="icon-pencil">&nbsp;</i>') ?></td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
<?php else: ?>
                <tr>
                    <td colspan="3">No records found that match your selection.</td>
                </tr>
<?php endif; ?>
        </tbody>
    </table>
<?php echo form_close(); ?>
</div>