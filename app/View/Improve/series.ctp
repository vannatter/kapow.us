<?php
/**
 * @var $this View
 */
?>

<?php echo $this->Element('headers/improve/series'); ?>

<div class="pad">

	Did we get something wrong with this one? We'd appreciate your help to fix it! Use the following form to correct any errors or omissions and they'll be sent to us for review and approval.
	<br/><br/>

	<?php echo $this->Form->create('Series', array('class' => 'well span11')); ?>
	<div class="row">
		<div class="span11">
			<?php echo $this->Form->input('series_name', array('class' => 'span11')); ?>
			<?php echo $this->Form->input('description', array('class' => 'span11', 'rows' => 20)); ?>
		</div>
		<?php echo $this->Form->submit(__('Submit Changes'), array('class' => 'btn btn-custom pull-right')); ?>
	</div>
	<?php echo $this->Form->end(); ?>

</div>