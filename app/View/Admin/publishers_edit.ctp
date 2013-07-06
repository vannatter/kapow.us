<?php
/**
 *@var $this View
 */
?>
<?php echo $this->Form->create('Publisher', array('type' => 'file', 'class' => 'form-horizontal')); ?>
<?php echo $this->Form->input('publisher_name', array('class' => 'span6')); ?>
<?php echo $this->Form->input('publisher_bio', array('class' => 'span6', 'rows' => 5)); ?>
<?php echo $this->Form->input('publisher_website', array('class' => 'span6')); ?>
<?php echo $this->Form->input('publisher_photo', array('class' => 'span6', 'disabled' => true)); ?>
<?php if(!empty($this->request->data['Publisher']['publisher_photo'])) { ?>
	<div class="control-group">
		<div class="controls">
				<?php echo $this->Html->image($this->request->data['Publisher']['publisher_photo'], array('class' => 'span6')); ?>
		</div>
	</div>
<?php } ?>
<div class="control-group">
	<div class="controls">
		<?php echo $this->Form->file('photo_upload'); ?>
	</div>
</div>
<?php echo $this->Form->input('status', array('options' => array('0' => __('Needs Data'), '1' => __('Clean')))); ?>
<div class="form-actions">
	<button type="submit" class="btn"><?php echo __('Save Publisher'); ?></button>
	<?php echo $this->Html->link(__('Cancel'), sprintf('/admin/publishers/unlock/%s', $this->request->data['Publisher']['id']), array('class' => 'btn')); ?>
</div>
<?php echo $this->Form->end(); ?>