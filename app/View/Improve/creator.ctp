<?php
/**
 * @var $this View
 */
?>

<?php echo $this->Element('headers/improve/creator'); ?>

<div class="pad">

	Did we get something wrong with this one? We'd appreciate your help to fix it! Use the following form to correct any errors or omissions and they'll be sent to us for review and approval.
	<br/><br/>

	<?php echo $this->Form->create('Creator', array('class' => 'well span11')); ?>
	<div class="row">
		<div class="span3">
			<?php echo $this->Form->input('creator_name', array('class' => 'span3')); ?>
			<?php echo $this->Form->input('creator_website', array('class' => 'span3')); ?>
			<?php echo $this->Form->input('creator_facebook', array('class' => 'span3')); ?>
			<?php echo $this->Form->input('creator_twitter', array('class' => 'span3')); ?>
		</div>
		<div class="span8">
			<?php echo $this->Form->input('creator_bio', array('class' => 'input-xlarge span8', 'rows' => 15, 'label' => 'Creator Bio')); ?>
		</div>
		<?php echo $this->Form->submit(__('Submit Changes'), array('class' => 'btn btn-custom pull-right')); ?>
	</div>
	<?php echo $this->Form->end(); ?>

</div>