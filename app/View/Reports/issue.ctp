<?php
/**
 * @var $this View
 */
?>

<?php echo $this->Element('headers/report/issue'); ?>

<div class="pad">

	Have an issue with something relating to this content? Please describe the issue and we will contact you or fix the problem as soon as possible.
	<br/><br/>
	
	<?php echo $this->Form->create('Report', array('class' => 'well span11')); ?>
	<div class="row">
		<div class="span11">
			<?php echo $this->Form->input('description', array('class' => 'input-xlarge span11', 'rows' => 12, 'label' => 'Describe the Issue')); ?>
		</div>
		<?php echo $this->Form->submit(__('Submit Issue'), array('class' => 'btn btn-custom pull-right')); ?>
	</div>
	<?php echo $this->Form->end(); ?>

</div>
