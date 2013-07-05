<?php
/**
 * @var $this View
 */
?>

<?php echo $this->Element('headers/improve/publisher'); ?>

<div class="pad">

	Did we get something wrong with this one? We'd appreciate your help to fix it! Use the following form to correct any errors or omissions and they'll be sent to us for review and approval.
	<br/><br/>

	<?php echo $this->Form->create('Publisher', array('class' => 'well span11')); ?>
	<div class="row">
		<div class="span3">
			<?php echo $this->Form->input('publisher_name', array('class' => 'span3')); ?>
			<?php echo $this->Form->input('publisher_website', array('class' => 'span3')); ?>
		</div>
		<div class="span8">
			<?php echo $this->Form->input('publisher_bio', array('class' => 'input-xlarge span8', 'rows' => 15, 'label' => 'Publisher Bio')); ?>
		</div>
		<?php echo $this->Form->submit(__('Submit Changes'), array('class' => 'btn btn-custom pull-right')); ?>
	</div>
	<?php echo $this->Form->end(); ?>

</div>