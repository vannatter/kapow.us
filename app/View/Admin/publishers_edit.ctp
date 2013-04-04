<?php
/**
 *@var $this View
 */
?>
<?php echo $this->Form->create('Publisher', array('type' => 'file', 'class' => 'form-horizontal')); ?>
<?php echo $this->Form->input('publisher_name', array('class' => 'span6')); ?>
<?php echo $this->Form->input('publisher_bio', array('class' => 'span6', 'rows' => 5)); ?>
<?php echo $this->Form->input('publisher_photo', array('class' => 'span6', 'disabled' => true)); ?>
<div class="control-group">
	<div class="controls">
		<?php echo $this->Form->file('photo_upload'); ?>
	</div>
</div>
<?php echo $this->Form->submit(__('Save Publisher')); ?>
<?php echo $this->Form->end(); ?>