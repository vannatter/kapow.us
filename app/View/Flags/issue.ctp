<?php
/**
 * @var $this View
 */
?>

<?php echo $this->Element('headers/flag/issue'); ?>

<div class="pad">

	Is something in this content inappropriate? Please flag it with a description so our administrator can look into it as soon as possible. 
	<br/><br/>
	
	<?php echo $this->Form->create('Flag', array('class' => 'well span11')); ?>
	<div class="row">
		<div class="span11">
			<?php echo $this->Form->input('description', array('class' => 'input-xlarge span11', 'rows' => 12, 'label' => 'Describe the Inappropriate Content')); ?>
		</div>
		<?php echo $this->Form->submit(__('Submit Report'), array('class' => 'btn btn-custom float-end')); ?>
	</div>
	<?php echo $this->Form->end(); ?>

</div>
