<?php
/**
 * @var $this View
 */
?>

<?php echo $this->element('headers/shops/add'); ?>

<div class="pad">

	Are we missing your favorite local comic shop? Please let us know the details so we can get it added!
	<br/><br/>
	
	<?php echo $this->Form->create('Store', array('class' => 'well span11')); ?>
	<div class="row">
		<div class="span5">

			<?php echo $this->Form->input('name', array('class' => 'span5', 'label' => 'Store Name')); ?>
			<?php echo $this->Form->input('address', array('class' => 'span5')); ?>
			<?php echo $this->Form->input('address_2', array('class' => 'span5')); ?>
			<?php echo $this->Form->input('city', array('class' => 'span5')); ?>
			<?php echo $this->Form->input('state', array('empty' => true, 'options' => $this->States->getArray(), 'class' => 'span5')); ?>
			<?php echo $this->Form->input('zip', array('class' => 'span5')); ?>
		</div>
		<div class="span6">
			<?php echo $this->Form->input('phone_no', array('class' => 'span6', 'label' => 'Phone Number')); ?>
			<?php echo $this->Form->input('website', array('class' => 'span6', 'label' => 'Website URL')); ?>
			<?php echo $this->Form->input('facebook_url', array('class' => 'span6', 'label' => 'Facebook URL')); ?>
			<?php echo $this->Form->input('twitter_url', array('class' => 'span6', 'label' => 'Twitter URL')); ?>
			<?php echo $this->Form->input('ebay_url', array('class' => 'span6', 'label' => 'Ebay Store URL')); ?>
		</div>
		<?php echo $this->Form->submit(__('Submit Store'), array('class' => 'btn btn-custom float-end')); ?>
	</div>
	<?php echo $this->Form->end(); ?>

</div>