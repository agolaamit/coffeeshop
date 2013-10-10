
<?php
if (!empty($sub_cat_dropdown))
{
    $i = 0;
    foreach ($sub_cat_dropdown as &$val)
    {
        $label = ucfirst($val['attribute_name']);
        $field = strtolower($val['attribute_name']);
        ?>

        <div class="control-group <?php echo form_error('$field') ? 'error' : ''; ?>">
            <?php echo form_label($label . lang('bf_form_label_required'), '$field', array('class' => "control-label")); ?>
            <?php
            if (!empty($val['options']))
            {
                foreach ($val['options'] as $option)
                {
                    $option_label = ucfirst($option['option_name']);
                    ?>
                    <div class='controls'>
                        <input id="<?php echo $option['id']; ?>" type="text" name="<?php echo $option['id']; ?>" maxlength="255" value="<?php echo set_value($option['id'], isset($product[$i]['extra_price']) ? $product[$i]['extra_price'] : '0.0'); ?>"  />&nbsp;<b>(<?php echo $option_label; ?>)</b>
                        <br><br>
                    </div>
                    <?php
                $i++;
                }
            }
            else
            {
                echo "<div class='controls'>No options available</div>";
            }
            ?>
        </div>
        <?php
    }
}
?>