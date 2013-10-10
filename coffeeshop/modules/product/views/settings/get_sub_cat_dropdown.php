<select name="sub_cat_id" id="sub_cat_id" onChange="javascript: attribute_listing(this.value)">
    <option value="">Select</option>
<?php
if (!empty($sub_cat_dropdown))
{
    foreach ($sub_cat_dropdown as &$val)
    {
        ?>
    <option value="<?php echo $val['id']; ?>"><?php echo $val['sub_category_name']; ?></option>
        <?php
    }
}
?>
</select>