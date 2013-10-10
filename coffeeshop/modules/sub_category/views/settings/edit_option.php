<?php if (validation_errors()) : ?>
    <div class="alert alert-block alert-error fade in ">
        <a class="close" data-dismiss="alert">&times;</a>
        <h4 class="alert-heading">Please fix the following errors :</h4>
        <?php echo validation_errors(); ?>
    </div>
<?php endif; ?>
<?php

// Change the css classes to suit your needs
if (isset($sub_category))
{
    $sub_category = (array) $sub_category;
}
$id = isset($sub_category['id']) ? $sub_category['id'] : '';
?>
<div class="admin-box">
    <h3>Sub Category Attribute</h3>
    <?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
    <fieldset>
        <div class="control-group <?php echo form_error('option_name') ? 'error' : ''; ?>">
        <?php echo form_label('Option Name' . lang('bf_form_label_required'), 'option_name', array('class' => "control-label")); ?>
            <div class='controls'>
                <input id="option_name" type="text" name="option_name" maxlength="255" value="<?php echo set_value('option_name', isset($sub_category['option_name']) ? $sub_category['option_name'] : ''); ?>"  />
                <span class="help-inline"><?php echo form_error('option_name'); ?></span>
            </div>
        </div>
        
        <div class="form-actions">
            <br/>
            <input type="hidden" name="sub_cat_attr_id" id="sub_cat_id" value="<?php echo $this->uri->segment(5); ?>" />
            <input type="hidden" name="id" id="id" value="<?php echo $this->uri->segment(6); ?>" />
            <input type="submit" name="save" class="btn btn-primary" value="Edit Option" />
            or <?php echo anchor(SITE_AREA . '/settings/sub_category/option_listing/'.$this->uri->segment(5), lang('sub_category_cancel'), 'class="btn btn-warning"'); ?>

        </div>
    </fieldset>
    <?php echo form_close(); ?>
</div>