<?php
/**
 * @var $this View
 */
?>

<?php echo $this->Element('headers/improve/store'); ?>

<div class="pad">

	Did we get something wrong with this one? We'd appreciate your help to fix it! Use the following form to correct any errors or omissions and they'll be sent to us for review and approval.
	<br/><br/>

	<?php echo $this->Form->create('Store', array('class' => 'well span11')); ?>
	<div class="row">
		<div class="span5">
			<?php echo $this->Form->input('name', array('class' => 'span5')); ?>
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
			<?php echo $this->Form->input('ebay_url', array('class' => 'span6', 'label' => 'Ebay URL')); ?>
		</div>
		<?php echo $this->Form->submit(__('Submit Changes'), array('class' => 'btn btn-custom pull-right')); ?>
	</div>
	<?php echo $this->Form->end(); ?>

</div>