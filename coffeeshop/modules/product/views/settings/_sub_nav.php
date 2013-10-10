<ul class="nav nav-pills">
    <li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
        <a href="<?php echo site_url(SITE_AREA . '/settings/product') ?>" id="list"><?php echo lang('product_list'); ?></a>
    </li>
    <li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
        <a href="<?php echo site_url(SITE_AREA . '/settings/product/create') ?>" id="create_new"><?php echo lang('product_new'); ?></a>
    </li>
</ul>