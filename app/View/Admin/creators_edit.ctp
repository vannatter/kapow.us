<?php
/**
 *@var $this View
 */
?>
<?php echo $this->Form->create('Creator', array('type' => 'file', 'class' => 'form-horizontal')); ?>
<?php echo $this->Form->input('creator_name', array('class' => 'span6')); ?>
<?php echo $this->Form->input('creator_bio', array('class' => 'span6', 'rows' => 5)); ?>
<?php echo $this->Form->input('creator_website', array('class' => 'span6')); ?>
<?php echo $this->Form->input('creator_facebook', array('class' => 'span6')); ?>
<?php echo $this->Form->input('creator_twitter', array('class' => 'span6')); ?>
<?php echo $this->Form->input('creator_photo', array('class' => 'span6', 'disabled' => true)); ?>
<?php if(!empty($this->request->data['Creator']['creator_photo'])) { ?>
	<div class="control-group">
		<div class="controls">
			<?php echo $this->Html->image($this->request->data['Creator']['creator_photo'], array('class' => 'span6')); ?>
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
	<button type="submit" class="btn"><?php echo __('Save Creator'); ?></button>
	<?php echo $this->Html->link(__('Cancel'), sprintf('/admin/creators/unlock/%s', $this->request->data['Creator']['id']), array('class' => 'btn')); ?>
</div>
<?php echo $this->Form->end(); ?>