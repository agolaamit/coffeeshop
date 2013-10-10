
<?php if (validation_errors()) : ?>
<div class="alert alert-block alert-error fade in ">
  <a class="close" data-dismiss="alert">&times;</a>
  <h4 class="alert-heading">Please fix the following errors :</h4>
 <?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<?php // Change the css classes to suit your needs
if( isset($sub_category) ) {
    $sub_category = (array)$sub_category;
}
$id = isset($sub_category['id']) ? $sub_category['id'] : '';
?>
<div class="admin-box">
    <h3>Sub Category</h3>
<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
    <fieldset>


        <?php // Change the values in this array to populate your dropdown as required ?>

<?php $options = array(
                255 => 255,
); ?>

        <?php echo form_dropdown('sub_category_category', $options, set_value('sub_category_category', isset($sub_category['sub_category_category']) ? $sub_category['sub_category_category'] : ''), 'Category'. lang('bf_form_label_required'))?>        <div class="control-group <?php echo form_error('sub_category_name') ? 'error' : ''; ?>">
            <?php echo form_label('Name'. lang('bf_form_label_required'), 'sub_category_name', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="sub_category_name" type="text" name="sub_category_name" maxlength="255" value="<?php echo set_value('sub_category_name', isset($sub_category['sub_category_name']) ? $sub_category['sub_category_name'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('sub_category_name'); ?></span>
        </div>


        </div>



        <div class="form-actions">
            <br/>
            <input type="submit" name="save" class="btn btn-primary" value="Edit Sub Category" />
            or <?php echo anchor(SITE_AREA .'/reports/sub_category', lang('sub_category_cancel'), 'class="btn btn-warning"'); ?>
            

    <?php if ($this->auth->has_permission('Sub_Category.Reports.Delete')) : ?>

            or <button type="submit" name="delete" class="btn btn-danger" id="delete-me" onclick="return confirm('<?php echo lang('sub_category_delete_confirm'); ?>')">
            <i class="icon-trash icon-white">&nbsp;</i>&nbsp;<?php echo lang('sub_category_delete_record'); ?>
            </button>

    <?php endif; ?>


        </div>
    </fieldset>
    <?php echo form_close(); ?>


</div>
