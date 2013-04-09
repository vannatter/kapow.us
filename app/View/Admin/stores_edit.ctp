<?php
/**
 *@var $this View
 */
?>
<?php $this->Html->script('page/shops.admin.js', array('inline' => false)); ?>

<ul class="nav nav-tabs" id="shopTabs">
	<li class="active"><?php echo $this->Html->link(__('Info'), '#info', array('data-toggle' => 'tab')); ?></li>
	<li><?php echo $this->Html->link(__('Photos'), '#photos', array('data-toggle' => 'tab')); ?></li>
</ul>

<div class="tab-content">
	<div class="tab-pane active" id="info">
		<?php echo $this->Form->create('Store', array('class' => 'form-horizontal')); ?>
		<?php echo $this->Form->input('name', array('class' => 'span6')); ?>
		<?php echo $this->Form->input('address', array('class' => 'span6')); ?>
		<?php echo $this->Form->input('address_2', array('class' => 'span6')); ?>
		<?php echo $this->Form->input('city', array('class' => 'span6')); ?>
		<?php echo $this->Form->input('state', array('class' => 'span3', 'options' => $this->States->getArray())); ?>
		<?php echo $this->Form->input('zip', array('class' => 'span3')); ?>
		<?php echo $this->Form->input('phone_no', array('class' => 'span4')); ?>
		<?php echo $this->Form->input('website', array('class' => 'span6')); ?>
		<?php echo $this->Form->input('google_reference', array('class' => 'span6', 'rows' => 5)); ?>
		<?php echo $this->Form->submit(__('Save Store')); ?>
		<?php echo $this->Form->end(); ?>
	</div>
	<div class="tab-pane" id="photos">
		<table class="table table-striped">
			<thead>
			<tr>
				<th><?php echo __('Primary'); ?></th>
				<th><?php echo __('Location'); ?></th>
				<th>&nbsp;</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach($this->request->data['StorePhoto'] as $photo) { ?>
				<tr>
					<td><input type="checkbox" data-id="<?php echo $photo['id']; ?>" data-store-id="<?php echo $photo['store_id']; ?>" <?php echo ($photo['primary']) ? "checked" : ""; ?> /></td>
					<td><?php echo $photo['photo_path']; ?></td>
					<td>
						<?php echo $this->Html->link(__('view'), $photo['photo_path'], array('class' => 'btn btn-small', 'target' => '_blank')); ?>
						<?php echo $this->Html->link(__('delete'), sprintf('/admin/stores/deletePhoto/%s', $photo['id']), array('class' => 'btn btn-small btn-danger'), __('Are You Sure?')); ?>
					</td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
</div>