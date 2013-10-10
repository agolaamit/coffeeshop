<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/developer/sub_category') ?>" id="list"><?php echo lang('sub_category_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission('Sub_Category.Developer.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/developer/sub_category/create') ?>" id="create_new"><?php echo lang('sub_category_new'); ?></a>
	</li>
	<?php endif; ?>
</ul>