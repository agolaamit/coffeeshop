<div class="admin-box">
    <h3>Product</h3>
    <?php echo form_open($this->uri->uri_string()); ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th class="column-check"><input class="check-all" type="checkbox" /></th>
                <th>Name</th>
                <th>Category</th>
                <th>Sub Category</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <?php if (isset($records) && is_array($records) && count($records)) : ?>
            <tfoot>
                    <tr>
                        <td colspan="5">
                            <?php echo lang('bf_with_selected') ?>
                            <input type="submit" name="delete" id="delete-me" class="btn btn-danger" value="<?php echo lang('bf_action_delete') ?>" onclick="return confirm('<?php echo lang('product_delete_confirm'); ?>')">
                        </td>
                    </tr>
            </tfoot>
        <?php endif; ?>
        <tbody>
            <?php if (isset($records) && is_array($records) && count($records)) : ?>
                <?php foreach ($records as $record) : ?>
                    <tr>
                        <td><input type="checkbox" name="checked[]" value="<?php echo $record->id ?>" /></td>
                        <td><?php echo $record->product_name ?></td>
                        <td><?php echo $record->category_name ?></td>
                        <td><?php echo $record->sub_category_name ?></td>
                        <td><?php echo $record->price ?></td>
                        <td><?php echo anchor(SITE_AREA . '/settings/product/edit/' . $record->id, '<i class="icon-pencil">&nbsp;</i>') ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No records found that match your selection.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <?php echo form_close(); ?>
</div>