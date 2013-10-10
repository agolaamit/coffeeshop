<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
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
    <h3>Sub Category</h3>
    <?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
    <fieldset>

        <?php //pre($cafe_list); ?>
        <?php
        $options = array(
            1 => 'Food',
            2 => 'Drink',
            3 => 'Coffee',
        );
        ?>
        <?php echo form_dropdown('cat_id', $options, set_value('cat_id', isset($sub_category['cat_id']) ? $sub_category['cat_id'] : ''), 'Category' . lang('bf_form_label_required')) ?>        
        <div class="control-group <?php echo form_error('sub_category_name') ? 'error' : ''; ?>">
            <?php echo form_label('Name' . lang('bf_form_label_required'), 'sub_category_name', array('class' => "control-label")); ?>
            <div class='controls'>
                <input id="sub_category_name" type="text" name="sub_category_name" maxlength="255" value="<?php echo set_value('sub_category_name', isset($sub_category['sub_category_name']) ? $sub_category['sub_category_name'] : ''); ?>"  />
                <span class="help-inline"><?php echo form_error('sub_category_name'); ?></span>
            </div>
        </div>
        

        <div class="control-group ">
            <label for="cafe_id" class="control-label">Cafe<span class="required">*</span></label>
            <div class="controls">
                <select name="cafe_id" id="cafe_id">
                    <option value="">Select</option>
                    <?php foreach($cafe_list as $cafe){ ?>
                    <option value="<?php echo $cafe['id'] ?>"><?php echo $cafe['cafe_name'] ?></option>
                    <?php } ?>
                </select>
                <span class="help-inline"><?php echo form_error('cafe_id'); ?></span>
            </div>
        </div>
<!--        <span id='TextBoxesGroup'>
            <div class="control-group">
                <div class='controls' id="TextBoxDiv1">
                    <label>Label 1 : </label>
                    <input type="text" id='textbox1' name='textbox1' maxlength="255" value="<?php echo set_value('textbox1', isset($sub_category['textbox1']) ? $sub_category['textbox1'] : ''); ?>"  /><br>
                    <input type="text" id='value1' name='value1' maxlength="255" value="<?php echo set_value('value1', isset($sub_category['value1']) ? $sub_category['value1'] : ''); ?>"  />
                </div>
            </div>    
        </span>
        <div class="form-actions">
            <input type='button' class="btn btn-primary" value='Add Button' id='addButton' />
            <input type='button' class="btn btn-danger" value='Remove Button' id='removeButton' />
        </div>-->
        <div class="form-actions">
            <br/>
            <input type="submit" name="save" class="btn btn-primary" value="Create Sub Category" />
            or <?php echo anchor(SITE_AREA . '/settings/sub_category/listing/'.$this->uri->segment(5), lang('sub_category_cancel'), 'class="btn btn-warning"'); ?>

        </div>
    </fieldset>
    <?php echo form_close(); ?>


</div>

<!--<script>
    $(window).load(function(){
        $(document).ready(function () {
            var counter = 2;
            $("#addButton").click(function () {
                //                if (counter > 2) {
                //                    alert("Only 2 textboxes allowed");
                //                    return false;
                //                }
                $('<div/>',{'id':'TextBoxDiv' + counter,'class':'control-group'}).html(
                $('<label/>').html( 'Label ' + counter + ' : ' )
            )
                .append( $('<input type="text">').attr({'id':'textbox' + counter,'name':'textbox' + counter}) )
                .append( $('<br><input type="text">').attr({'id':'value' + counter,'name':'value' + counter}) )
                .appendTo( '#TextBoxesGroup' )      
                counter++;
            });
 
            $("#removeButton").click(function () {
                if (counter == 1) {
                    alert("No more textbox to remove");
                    return false;
                }
                counter--;
                $("#TextBoxDiv" + counter).remove();
            });
        });
    });
</script>-->
