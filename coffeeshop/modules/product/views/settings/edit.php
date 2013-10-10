<script src="<?php echo Template::theme_url('js/jquery-1.7.2.min.js'); ?>"></script>
<?php if (validation_errors()) : ?>
    <div class="alert alert-block alert-error fade in ">
        <a class="close" data-dismiss="alert">&times;</a>
        <h4 class="alert-heading">Please fix the following errors :</h4>
        <?php echo validation_errors(); ?>
    </div>
<?php endif; ?>
<?php
// Change the css classes to suit your needs
if (isset($product))
{
    $product = (array) $product;
}
$id = isset($product['id']) ? $product['id'] : '';
?>
<div class="admin-box">
    <h3><b>Product</b></h3>
    <?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
    <fieldset>
        
        <div class="control-group ">
            <label for="cat_id" class="control-label">Category<span class="required">*</span></label>
            <div class="controls">
                <select name="cat_id" id="cat_id" onChange="javascript: sub_category_dropdown(this.value)" >
                    <option value="">Select</option>
                    <?php
                    foreach ($category_list as $cat)
                    {
                        ?>
                        <option <?php if(isset($product['cat_id']) && $product['cat_id'] == $cat['id']){ ?> selected="selected" <?php } ?> value="<?php echo $cat['id'] ?>"><?php echo $cat['category_name'] ?></option>
                    <?php } ?>
                </select>
                <span class="help-inline"><?php echo form_error('cat_id'); ?></span>
            </div>
        </div>

        <div class="control-group " id="sub_cat" <?php if(isset($product['cat_id']) && $product['cat_id'] == 0){ ?> style="display: none;" <?php } ?>>
            <label for="sub_cat_id" class="control-label">Sub Category<span class="required">*</span></label>
            <div class="controls" id="sub_dropdown">
                <select name="sub_cat_id" id="sub_cat_id">
                    <option value="">Select</option>
                    <?php
                    foreach ($sub_category_list as $sub_cat)
                    {
                        ?>
                        <option <?php if(isset($product['sub_cat_id']) && $product['sub_cat_id'] == $sub_cat['id']){ ?> selected="selected" <?php } ?> value="<?php echo $sub_cat['id'] ?>"><?php echo $sub_cat['sub_category_name'] ?></option>
                    <?php } ?>
                </select>
                <span class="help-inline"><?php echo form_error('sub_cat_id'); ?></span>
            </div>
        </div>

        <div class="control-group <?php echo form_error('product_name') ? 'error' : ''; ?>">
            <?php echo form_label('Product Name' . lang('bf_form_label_required'), 'product_name', array('class' => "control-label")); ?>
            <div class='controls'>
                <input id="product_name" type="text" name="product_name" maxlength="255" value="<?php echo set_value('product_name', isset($product['product_name']) ? $product['product_name'] : ''); ?>"  />
                <span class="help-inline"><?php echo form_error('product_name'); ?></span>
            </div>
        </div>

        <div class="control-group <?php echo form_error('price') ? 'error' : ''; ?>">
            <?php echo form_label('Price' . lang('bf_form_label_required'), 'price', array('class' => "control-label")); ?>
            <div class='controls'>
                <input id="price" type="text" name="price" maxlength="255" value="<?php echo set_value('price', isset($product['price']) ? $product['price'] : ''); ?>"  />
                <span class="help-inline"><?php echo form_error('price'); ?></span>
            </div>
        </div>

        <div class="control-group " id="attt_list" <?php if(isset($product['sub_cat_id']) && $product['sub_cat_id'] == 0){ ?> style="display: none;" <?php } ?>>
        </div>

        <div class="form-actions">
            <br/>
            <input type="submit" name="save" class="btn btn-primary" value="Create Product" />
            or <?php echo anchor(SITE_AREA . '/settings/product', lang('product_cancel'), 'class="btn btn-warning"'); ?>

        </div>
    </fieldset>
    <?php echo form_close(); ?>


</div>
<script>
<?php
if ((isset($product['cat_id']) && $product['cat_id'] != 0) || (isset($product['sub_cat_id']) && $product['sub_cat_id'] != 0))
{
    ?>
        //sub_category_dropdown(<?php echo $product['cat_id']; ?>);
        attribute_listing(<?php echo $product['sub_cat_id']; ?>,<?php echo $product['id']; ?>);
    <?php
}
?>
    function sub_category_dropdown(cat_id){
        $.ajax({
            type:'POST',
            url: '<?php echo base_url() ?>index.php/<?php echo SITE_AREA; ?>/settings/product/get_sub_cat_dropdown',
            data:{cat_id:cat_id},
            success: function(data) {
                if(data == ''){
                    $("#sub_cat").hide();
                }else{
                    $("#sub_cat").show();
                    $("#sub_dropdown").html(data); 
                    //$('#related_id').val(related_id);
                }
            }
        });
    }
    
    
    function attribute_listing(sub_cat_id,product_id){
        $.ajax({
            type:'POST',
            url:'<?php echo base_url() ?>index.php/<?php echo SITE_AREA; ?>/settings/product/get_attribute_listing',
            data:{sub_cat_id:sub_cat_id,product_id:product_id},
            success: function(data) {
                if(data == ''){
                    $("#attt_list").hide();
                }else{
                    $("#attt_list").show();
                    $("#attt_list").html(data); 
                    //$('#related_id').val(related_id);
                }
            }
        });
    }
</script>