<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/developer/cafe') ?>" id="list"><?php echo lang('cafe_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission('Cafe.Developer.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/developer/cafe/create') ?>" id="create_new"><?php echo lang('cafe_new'); ?></a>
	</li>
	<?php endif; ?>
</ul>