<?php
/**
 *@var $this View
 */
?>
<?php echo $this->Form->create('Creator', array('type' => 'file', 'class' => 'form-horizontal')); ?>
<?php echo $this->Form->input('creator_name', array('class' => 'span6')); ?>
<?php echo $this->Form->input('creator_bio', array('class' => 'span6', 'rows' => 5)); ?>
<?php echo $this->Form->input('creator_photo', array('class' => 'span6', 'disabled' => true)); ?>
<div class="control-group">
	<div class="controls">
		<?php echo $this->Form->file('photo_upload'); ?>
	</div>
</div>
<?php echo $this->Form->input('creator_website', array('class' => 'span6')); ?>
<?php echo $this->Form->input('creator_facebook', array('class' => 'span6')); ?>
<?php echo $this->Form->input('creator_twitter', array('class' => 'span6')); ?>
<?php echo $this->Form->submit(__('Save Creator')); ?>
<?php echo $this->Form->end(); ?>