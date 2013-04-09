<?php
/**
 *@var $this View
 */
?>
<?php echo $this->element('headers/shops/add_image'); ?>

<div class="well">
	<?php echo $this->Form->create('StorePhoto', array('type' => 'file', 'class' => 'form-horizontal')); ?>
	<div class="control-group<?php echo (isset($this->validationErrors['StorePhoto']['photo_upload'])) ? " error" : ""; ?>">
		<div class="controls">
			<?php echo $this->Form->file('photo_upload'); ?>
			<?php if(isset($this->validationErrors['StorePhoto']['photo_upload'])) { ?>
				<span class="help-inline error-message"><?php echo $this->validationErrors['StorePhoto']['photo_upload']; ?></span>
			<?php } ?>
		</div>
	</div>
	<?php echo $this->Form->submit(__('Save Photo')); ?>
	<?php echo $this->Form->end(); ?>
</div>