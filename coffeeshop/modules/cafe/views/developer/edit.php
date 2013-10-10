
<?php if (validation_errors()) : ?>
<div class="alert alert-block alert-error fade in ">
  <a class="close" data-dismiss="alert">&times;</a>
  <h4 class="alert-heading">Please fix the following errors :</h4>
 <?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<?php // Change the css classes to suit your needs
if( isset($cafe) ) {
    $cafe = (array)$cafe;
}
$id = isset($cafe['id']) ? $cafe['id'] : '';
?>
<div class="admin-box">
    <h3>Cafe</h3>
<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
    <fieldset>
        <div class="control-group <?php echo form_error('cafe_name') ? 'error' : ''; ?>">
            <?php echo form_label('Name'. lang('bf_form_label_required'), 'cafe_name', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="cafe_name" type="text" name="cafe_name" maxlength="255" value="<?php echo set_value('cafe_name', isset($cafe['cafe_name']) ? $cafe['cafe_name'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('cafe_name'); ?></span>
        </div>


        </div>
        <div class="control-group <?php echo form_error('cafe_url_name') ? 'error' : ''; ?>">
            <?php echo form_label('Url Name'. lang('bf_form_label_required'), 'cafe_url_name', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="cafe_url_name" type="text" name="cafe_url_name" maxlength="255" value="<?php echo set_value('cafe_url_name', isset($cafe['cafe_url_name']) ? $cafe['cafe_url_name'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('cafe_url_name'); ?></span>
        </div>


        </div>


        <?php // Change the values in this array to populate your dropdown as required ?>

<?php $options = array(
                255 => 255,
); ?>

        <?php echo form_dropdown('cafe_status', $options, set_value('cafe_status', isset($cafe['cafe_status']) ? $cafe['cafe_status'] : ''), 'Status'. lang('bf_form_label_required'))?>


        <div class="form-actions">
            <br/>
            <input type="submit" name="save" class="btn btn-primary" value="Edit Cafe" />
            or <?php echo anchor(SITE_AREA .'/developer/cafe', lang('cafe_cancel'), 'class="btn btn-warning"'); ?>
            

    <?php if ($this->auth->has_permission('Cafe.Developer.Delete')) : ?>

            or <button type="submit" name="delete" class="btn btn-danger" id="delete-me" onclick="return confirm('<?php echo lang('cafe_delete_confirm'); ?>')">
            <i class="icon-trash icon-white">&nbsp;</i>&nbsp;<?php echo lang('cafe_delete_record'); ?>
            </button>

    <?php endif; ?>


        </div>
    </fieldset>
    <?php echo form_close(); ?>


</div>
