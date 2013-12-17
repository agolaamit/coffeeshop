<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/developer/order') ?>" id="list"><?php echo lang('order_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission('Order.Developer.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/developer/order/create') ?>" id="create_new"><?php echo lang('order_new'); ?></a>
	</li>
	<?php endif; ?>
</ul>