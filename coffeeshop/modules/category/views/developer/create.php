
<?php if (validation_errors()) : ?>
<div class="alert alert-block alert-error fade in ">
  <a class="close" data-dismiss="alert">&times;</a>
  <h4 class="alert-heading">Please fix the following errors :</h4>
 <?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<?php // Change the css classes to suit your needs
if( isset($category) ) {
    $category = (array)$category;
}
$id = isset($category['id']) ? $category['id'] : '';
?>
<div class="admin-box">
    <h3>Category</h3>
<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
    <fieldset>
        <div class="control-group <?php echo form_error('category_name') ? 'error' : ''; ?>">
            <?php echo form_label('Name'. lang('bf_form_label_required'), 'category_name', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="category_name" type="text" name="category_name" maxlength="255" value="<?php echo set_value('category_name', isset($category['category_name']) ? $category['category_name'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('category_name'); ?></span>
        </div>


        </div>



        <div class="form-actions">
            <br/>
            <input type="submit" name="save" class="btn btn-primary" value="Create Category" />
            or <?php echo anchor(SITE_AREA .'/developer/category', lang('category_cancel'), 'class="btn btn-warning"'); ?>
            
        </div>
    </fieldset>
    <?php echo form_close(); ?>


</div>
