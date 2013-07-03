<?php if($item['item_name'] != $item['item_name_new']) { ?>
	<div class="well">
		<h3><?php echo __('Item Name'); ?></h3>
		<h4><?php echo __('Current'); ?></h4>
		<?php echo $item['item_name']; ?>
		<h4><?php echo __('Changed'); ?></h4>
		<?php echo $item['item_name_new']; ?>
		<br /><br />
		<?php echo $this->Html->link(__('Accept'), '#', array('data-id' => $item['id'], 'data-type' => 1, 'data-field' => 'item_name', 'class' => 'improve-accept btn btn-small btn-success')); ?>
		<?php echo $this->Html->link(__('Decline'), '#', array('data-id' => $item['id'], 'data-type' => 1, 'data-field' => 'item_name', 'class' => 'improve-decline btn btn-small btn-danger')); ?>
	</div>
<?php } ?>

<?php if($item['section_id'] != $item['section_id_new']) { ?>
	<div class="well">
		<h3><?php echo __('Section'); ?></h3>
		<h4><?php echo __('Current'); ?></h4>
		<?php echo $sections[$item['section_id']]; ?>
		<h4><?php echo __('Changed'); ?></h4>
		<?php echo $sections[$item['section_id_new']]; ?>
		<br /><br />
		<?php echo $this->Html->link(__('Accept'), '#', array('data-id' => $item['id'], 'data-type' => 1, 'data-field' => 'section_id', 'class' => 'improve-accept btn btn-small btn-success')); ?>
		<?php echo $this->Html->link(__('Decline'), '#', array('data-id' => $item['id'], 'data-type' => 1, 'data-field' => 'section_id', 'class' => 'improve-decline btn btn-small btn-danger')); ?>
	</div>
<?php } ?>

<?php if($item['publisher_id'] != $item['publisher_id_new']) { ?>
	<div class="well">
		<h3><?php echo __('Publisher'); ?></h3>
		<h4><?php echo __('Current'); ?></h4>
		<?php echo $publishers[$item['publisher_id']]; ?>
		<h4><?php echo __('Changed'); ?></h4>
		<?php echo $publishers[$item['publisher_id_new']]; ?>
		<br /><br />
		<?php echo $this->Html->link(__('Accept'), '#', array('data-id' => $item['id'], 'data-type' => 1, 'data-field' => 'publisher_id', 'class' => 'improve-accept btn btn-small btn-success')); ?>
		<?php echo $this->Html->link(__('Decline'), '#', array('data-id' => $item['id'], 'data-type' => 1, 'data-field' => 'publisher_id', 'class' => 'improve-decline btn btn-small btn-danger')); ?>
	</div>
<?php } ?>

<?php if($item['series_id'] != $item['series_id_new']) { ?>
	<div class="well">
		<h3><?php echo __('Series'); ?></h3>
		<h4><?php echo __('Current'); ?></h4>
		<?php echo $series[$item['series_id']]; ?>
		<h4><?php echo __('Changed'); ?></h4>
		<?php echo $series[$item['series_id_new']]; ?>
		<br /><br />
		<?php echo $this->Html->link(__('Accept'), '#', array('data-id' => $item['id'], 'data-type' => 1, 'data-field' => 'series_id', 'class' => 'improve-accept btn btn-small btn-success')); ?>
		<?php echo $this->Html->link(__('Decline'), '#', array('data-id' => $item['id'], 'data-type' => 1, 'data-field' => 'series_id', 'class' => 'improve-decline btn btn-small btn-danger')); ?>
	</div>
<?php } ?>

<?php if($item['series_num'] != $item['series_num_new']) { ?>
	<div class="well">
		<h3><?php echo __('Series #'); ?></h3>
		<h4><?php echo __('Current'); ?></h4>
		<?php echo $item['series_num']; ?>
		<h4><?php echo __('Changed'); ?></h4>
		<?php echo $item['series_num_new']; ?>
		<br /><br />
		<?php echo $this->Html->link(__('Accept'), '#', array('data-id' => $item['id'], 'data-type' => 1, 'data-field' => 'series_num', 'class' => 'improve-accept btn btn-small btn-success')); ?>
		<?php echo $this->Html->link(__('Decline'), '#', array('data-id' => $item['id'], 'data-type' => 1, 'data-field' => 'series_num', 'class' => 'improve-decline btn btn-small btn-danger')); ?>
	</div>
<?php } ?>

<?php if($item['srp'] != $item['srp_new']) { ?>
	<div class="well">
		<h3><?php echo __('Suggested Retail Price'); ?></h3>
		<h4><?php echo __('Current'); ?></h4>
		<?php echo $item['srp']; ?>
		<h4><?php echo __('Changed'); ?></h4>
		<?php echo $item['srp_new']; ?>
		<br /><br />
		<?php echo $this->Html->link(__('Accept'), '#', array('data-id' => $item['id'], 'data-type' => 1, 'data-field' => 'srp', 'class' => 'improve-accept btn btn-small btn-success')); ?>
		<?php echo $this->Html->link(__('Decline'), '#', array('data-id' => $item['id'], 'data-type' => 1, 'data-field' => 'srp', 'class' => 'improve-decline btn btn-small btn-danger')); ?>
	</div>
<?php } ?>

<?php if($item['stock_id'] != $item['stock_id_new']) { ?>
	<div class="well">
		<h3><?php echo __('Stock ID'); ?></h3>
		<h4><?php echo __('Current'); ?></h4>
		<?php echo $item['stock_id']; ?>
		<h4><?php echo __('Changed'); ?></h4>
		<?php echo $item['stock_id_new']; ?>
		<br /><br />
		<?php echo $this->Html->link(__('Accept'), '#', array('data-id' => $item['id'], 'data-type' => 1, 'data-field' => 'stock_id', 'class' => 'improve-accept btn btn-small btn-success')); ?>
		<?php echo $this->Html->link(__('Decline'), '#', array('data-id' => $item['id'], 'data-type' => 1, 'data-field' => 'stock_id', 'class' => 'improve-decline btn btn-small btn-danger')); ?>
	</div>
<?php } ?>

<?php if($item['printing'] != $item['printing_new']) { ?>
	<div class="well">
		<h3><?php echo __('Printing'); ?></h3>
		<h4><?php echo __('Current'); ?></h4>
		<?php echo $item['printing']; ?>
		<h4><?php echo __('Changed'); ?></h4>
		<?php echo $item['printing_new']; ?>
		<br /><br />
		<?php echo $this->Html->link(__('Accept'), '#', array('data-id' => $item['id'], 'data-type' => 1, 'data-field' => 'printing', 'class' => 'improve-accept btn btn-small btn-success')); ?>
		<?php echo $this->Html->link(__('Decline'), '#', array('data-id' => $item['id'], 'data-type' => 1, 'data-field' => 'printing', 'class' => 'improve-decline btn btn-small btn-danger')); ?>
	</div>
<?php } ?>

<?php if($item['item_date'] != $item['item_date_new']) { ?>
	<div class="well">
		<h3><?php echo __('Item Date'); ?></h3>
		<h4><?php echo __('Current'); ?></h4>
		<?php echo $item['item_date']; ?>
		<h4><?php echo __('Changed'); ?></h4>
		<?php echo $item['item_date_new']; ?>
		<br /><br />
		<?php echo $this->Html->link(__('Accept'), '#', array('data-id' => $item['id'], 'data-type' => 1, 'data-field' => 'item_date', 'class' => 'improve-accept btn btn-small btn-success')); ?>
		<?php echo $this->Html->link(__('Decline'), '#', array('data-id' => $item['id'], 'data-type' => 1, 'data-field' => 'item_date', 'class' => 'improve-decline btn btn-small btn-danger')); ?>
	</div>
<?php } ?>

<?php if($item['description'] != $item['description_new']) { ?>
	<div class="well">
		<h3><?php echo __('Description'); ?></h3>
		<h4><?php echo __('Current'); ?></h4>
		<?php echo $item['description']; ?>
		<h4><?php echo __('Changed'); ?></h4>
		<?php echo $item['description_new']; ?>
		<br /><br />
		<?php echo $this->Html->link(__('Accept'), '#', array('data-id' => $item['id'], 'data-type' => 1, 'data-field' => 'description', 'class' => 'improve-accept btn btn-small btn-success')); ?>
		<?php echo $this->Html->link(__('Decline'), '#', array('data-id' => $item['id'], 'data-type' => 1, 'data-field' => 'description', 'class' => 'improve-decline btn btn-small btn-danger')); ?>
	</div>
<?php } ?>