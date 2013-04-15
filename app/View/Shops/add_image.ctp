<?php
/**
 *@var $this View
 */
?>
<?php echo $this->element('headers/shops/add_image'); ?>

<div class="row">
	<div class="span5">
		<?php echo $this->Form->create('StorePhoto', array('type' => 'file', 'class' => 'form-horizontal')); ?>
		<div class="login_block photo_upload_block">
			<?php if(isset($this->validationErrors['StorePhoto']['photo_upload'])) { ?>
				<span class="help-inline error-message"><?php echo $this->validationErrors['StorePhoto']['photo_upload']; ?></span>
			<?php } ?>

			<h5>Photo:</h5>
			<?php echo $this->Form->file('photo_upload'); ?>
			<h5>Description:</h5>
			<?php echo $this->Form->textarea('photo_description', array('rows' => 4, 'class' => 'full-width')); ?>

			<div class="upload_photo">
				<?php echo $this->Form->submit(__('Upload Photo'), array('class' => 'btn btn-custom')); ?>
			</div>
		</div>
		<?php echo $this->Form->end(); ?>
	</div>
	<div class="span7 login_intro">
		Want to add a photo of this shop? Great! Use the form to upload your photo and we'll review it as soon as possible.
		<br/><br/>
		Thank you for your contribution!
	</div>
</div>