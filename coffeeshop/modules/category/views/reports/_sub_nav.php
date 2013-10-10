<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/reports/category') ?>" id="list"><?php echo lang('category_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission('Category.Reports.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/reports/category/create') ?>" id="create_new"><?php echo lang('category_new'); ?></a>
	</li>
	<?php endif; ?>
</ul>