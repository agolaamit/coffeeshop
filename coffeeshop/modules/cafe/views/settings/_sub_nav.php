<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/settings/cafe') ?>" id="list"><?php echo lang('cafe_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission('Cafe.Settings.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/settings/cafe/create') ?>" id="create_new"><?php echo lang('cafe_new'); ?></a>
	</li>
	<?php endif; ?>
</ul>