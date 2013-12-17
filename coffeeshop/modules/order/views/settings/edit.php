
<?php if (validation_errors()) : ?>
<div class="alert alert-block alert-error fade in ">
  <a class="close" data-dismiss="alert">&times;</a>
  <h4 class="alert-heading">Please fix the following errors :</h4>
 <?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<?php // Change the css classes to suit your needs
if( isset($order) ) {
    $order = (array)$order;
}
$id = isset($order['id']) ? $order['id'] : '';
?>
<div class="admin-box">
    <h3>order</h3>
<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
    <fieldset>
        <div class="control-group <?php echo form_error('order_userid') ? 'error' : ''; ?>">
            <?php echo form_label('Userid'. lang('bf_form_label_required'), 'order_userid', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="order_userid" type="text" name="order_userid" maxlength="11" value="<?php echo set_value('order_userid', isset($order['order_userid']) ? $order['order_userid'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('order_userid'); ?></span>
        </div>


        </div>
        <div class="control-group <?php echo form_error('order_name') ? 'error' : ''; ?>">
            <?php echo form_label('Name', 'order_name', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="order_name" type="text" name="order_name" maxlength="255" value="<?php echo set_value('order_name', isset($order['order_name']) ? $order['order_name'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('order_name'); ?></span>
        </div>


        </div>
        <div class="control-group <?php echo form_error('order_items') ? 'error' : ''; ?>">
            <?php echo form_label('Items', 'order_items', array('class' => "control-label") ); ?>
            <div class='controls'>
            <?php echo form_textarea( array( 'name' => 'order_items', 'id' => 'order_items', 'rows' => '5', 'cols' => '80', 'value' => set_value('order_items', isset($order['order_items']) ? $order['order_items'] : '') ) )?>
            <span class="help-inline"><?php echo form_error('order_items'); ?></span>
        </div>

        </div>
        <div class="control-group <?php echo form_error('order_total') ? 'error' : ''; ?>">
            <?php echo form_label('Total', 'order_total', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="order_total" type="text" name="order_total" maxlength="11" value="<?php echo set_value('order_total', isset($order['order_total']) ? $order['order_total'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('order_total'); ?></span>
        </div>


        </div>
        <div class="control-group <?php echo form_error('order_createdtime') ? 'error' : ''; ?>">
            <?php echo form_label('Created Time', 'order_createdtime', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="order_createdtime" type="text" name="order_createdtime"  value="<?php echo set_value('order_createdtime', isset($order['order_createdtime']) ? $order['order_createdtime'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('order_createdtime'); ?></span>
        </div>


        </div>
        <div class="control-group <?php echo form_error('order_pickuptime') ? 'error' : ''; ?>">
            <?php echo form_label('Pickup Time', 'order_pickuptime', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="order_pickuptime" type="text" name="order_pickuptime"  value="<?php echo set_value('order_pickuptime', isset($order['order_pickuptime']) ? $order['order_pickuptime'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('order_pickuptime'); ?></span>
        </div>


        </div>



        <div class="form-actions">
            <br/>
            <input type="submit" name="save" class="btn btn-primary" value="Edit order" />
            or <?php echo anchor(SITE_AREA .'/settings/order', lang('order_cancel'), 'class="btn btn-warning"'); ?>
            

    <?php if ($this->auth->has_permission('Order.Settings.Delete')) : ?>

            or <button type="submit" name="delete" class="btn btn-danger" id="delete-me" onclick="return confirm('<?php echo lang('order_delete_confirm'); ?>')">
            <i class="icon-trash icon-white">&nbsp;</i>&nbsp;<?php echo lang('order_delete_record'); ?>
            </button>

    <?php endif; ?>


        </div>
    </fieldset>
    <?php echo form_close(); ?>


</div>
