<?php
if ($this->uri->segment(4) == 'attribute_listing' || $this->uri->segment(4) == 'create_attribute' || $this->uri->segment(4) == 'edit_attribute')
{
    ?>

    <ul class="nav nav-pills">
        <li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
            <a href="<?php echo site_url(SITE_AREA . '/settings/sub_category/attribute_listing/'.$this->uri->segment(5)) ?>" id="list"><?php echo lang('sub_category_list'); ?></a>
        </li>
        <?php if ($this->auth->has_permission('Sub_Category.Settings.Create')) : ?>
            <li <?php echo $this->uri->segment(4) == 'create_attribute' ? 'class="active"' : '' ?> >
                <a href="<?php echo site_url(SITE_AREA . '/settings/sub_category/create_attribute/'.$this->uri->segment(5)) ?>" id="create_new"><?php echo lang('sub_category_new'); ?></a>
            </li>
        <?php endif; ?>
    </ul>
    <?php
}
else if ($this->uri->segment(4) == 'option_listing' || $this->uri->segment(4) == 'create_option' || $this->uri->segment(4) == 'edit_option')
{
    ?>

    <ul class="nav nav-pills">
        <li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
            <a href="<?php echo site_url(SITE_AREA . '/settings/sub_category/option_listing/'.$this->uri->segment(5)) ?>" id="list"><?php echo lang('sub_category_list'); ?></a>
        </li>
        <?php if ($this->auth->has_permission('Sub_Category.Settings.Create')) : ?>
            <li <?php echo $this->uri->segment(4) == 'create_option' ? 'class="active"' : '' ?> >
                <a href="<?php echo site_url(SITE_AREA . '/settings/sub_category/create_option/'.$this->uri->segment(5)) ?>" id="create_new"><?php echo lang('sub_category_new'); ?></a>
            </li>
        <?php endif; ?>
    </ul>
    <?php
}
else
{
    ?>
    <ul class="nav nav-pills">
        <li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
            <a href="<?php echo site_url(SITE_AREA . '/settings/sub_category/listing/'.$this->uri->segment(5)) ?>" id="list"><?php echo lang('sub_category_list'); ?></a>
        </li>
        <?php if ($this->auth->has_permission('Sub_Category.Settings.Create')) : ?>
            <li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
                <a href="<?php echo site_url(SITE_AREA . '/settings/sub_category/create/'.$this->uri->segment(5)) ?>" id="create_new"><?php echo lang('sub_category_new'); ?></a>
            </li>
        <?php endif; ?>
    </ul>
<?php } ?>