<div class="admin-box">
	<h3>order</h3>
	<?php echo form_open($this->uri->uri_string()); ?>
		<table class="table table-striped">
			<thead>
				<tr>
					<?php if ($this->auth->has_permission('Order.Developer.Delete') && isset($records) && is_array($records) && count($records)) : ?>
					<th class="column-check"><input class="check-all" type="checkbox" /></th>
					<?php endif;?>
					
					<th>Userid</th>
					<th>Name</th>
					<th>Items</th>
					<th>Total</th>
					<th>Created Time</th>
					<th>Pickup Time</th>
				</tr>
			</thead>
			<?php if (isset($records) && is_array($records) && count($records)) : ?>
			<tfoot>
				<?php if ($this->auth->has_permission('Order.Developer.Delete')) : ?>
				<tr>
					<td colspan="7">
						<?php echo lang('bf_with_selected') ?>
						<input type="submit" name="delete" id="delete-me" class="btn btn-danger" value="<?php echo lang('bf_action_delete') ?>" onclick="return confirm('<?php echo lang('order_delete_confirm'); ?>')">
					</td>
				</tr>
				<?php endif;?>
			</tfoot>
			<?php endif; ?>
			<tbody>
			<?php if (isset($records) && is_array($records) && count($records)) : ?>
			<?php foreach ($records as $record) : ?>
				<tr>
					<?php if ($this->auth->has_permission('Order.Developer.Delete')) : ?>
					<td><input type="checkbox" name="checked[]" value="<?php echo $record->id ?>" /></td>
					<?php endif;?>
					
				<?php if ($this->auth->has_permission('Order.Developer.Edit')) : ?>
				<td><?php echo anchor(SITE_AREA .'/developer/order/edit/'. $record->id, '<i class="icon-pencil">&nbsp;</i>' .  $record->order_userid) ?></td>
				<?php else: ?>
				<td><?php echo $record->order_userid ?></td>
				<?php endif; ?>
			
				<td><?php echo $record->order_name?></td>
				<td><?php echo $record->order_items?></td>
				<td><?php echo $record->order_total?></td>
				<td><?php echo $record->order_createdtime?></td>
				<td><?php echo $record->order_pickuptime?></td>
				</tr>
			<?php endforeach; ?>
			<?php else: ?>
				<tr>
					<td colspan="7">No records found that match your selection.</td>
				</tr>
			<?php endif; ?>
			</tbody>
		</table>
	<?php echo form_close(); ?>
</div>