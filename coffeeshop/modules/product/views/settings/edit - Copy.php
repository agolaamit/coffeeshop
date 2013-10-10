
<?php if (validation_errors()) : ?>
<div class="alert alert-block alert-error fade in ">
  <a class="close" data-dismiss="alert">&times;</a>
  <h4 class="alert-heading">Please fix the following errors :</h4>
 <?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<?php // Change the css classes to suit your needs
if( isset($product) ) {
    $product = (array)$product;
}
$id = isset($product['id']) ? $product['id'] : '';
?>
<div class="admin-box">
    <h3>Product</h3>
<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
    <fieldset>
        <div class="control-group <?php echo form_error('product_name') ? 'error' : ''; ?>">
            <?php echo form_label('Name'. lang('bf_form_label_required'), 'product_name', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="product_name" type="text" name="product_name" maxlength="255" value="<?php echo set_value('product_name', isset($product['product_name']) ? $product['product_name'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('product_name'); ?></span>
        </div>


        </div>


        <?php // Change the values in this array to populate your dropdown as required ?>

<?php $options = array(
                11 => 11,
); ?>

        <?php echo form_dropdown('product_category', $options, set_value('product_category', isset($product['product_category']) ? $product['product_category'] : ''), 'Category'. lang('bf_form_label_required'))?>

        <?php // Change the values in this array to populate your dropdown as required ?>

<?php $options = array(
                11 => 11,
); ?>

        <?php echo form_dropdown('product_sub_category', $options, set_value('product_sub_category', isset($product['product_sub_category']) ? $product['product_sub_category'] : ''), 'Sub Category')?>        <div class="control-group <?php echo form_error('product_description') ? 'error' : ''; ?>">
            <?php echo form_label('Description', 'product_description', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="product_description" type="text" name="product_description" maxlength="255" value="<?php echo set_value('product_description', isset($product['product_description']) ? $product['product_description'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('product_description'); ?></span>
        </div>


        </div>



        <div class="form-actions">
            <br/>
            <input type="submit" name="save" class="btn btn-primary" value="Edit Product" />
            or <?php echo anchor(SITE_AREA .'/settings/product', lang('product_cancel'), 'class="btn btn-warning"'); ?>
            

    <?php if ($this->auth->has_permission('Product.Settings.Delete')) : ?>

            or <button type="submit" name="delete" class="btn btn-danger" id="delete-me" onclick="return confirm('<?php echo lang('product_delete_confirm'); ?>')">
            <i class="icon-trash icon-white">&nbsp;</i>&nbsp;<?php echo lang('product_delete_record'); ?>
            </button>

    <?php endif; ?>


        </div>
    </fieldset>
    <?php echo form_close(); ?>


</div>
