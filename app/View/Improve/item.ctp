<?php
/**
 * @var $this View
 */
?>

<?php echo $this->Element('headers/improve/item'); ?>

<div class="pad">

	Did we get something wrong with this one? We'd appreciate your help to fix it! Use the following form to correct any errors or omissions and they'll be sent to us for review and approval.
	<br/><br/>
	
	<?php echo $this->Form->create('Item', array('class' => 'well span11')); ?>
	<div class="row">
		<div class="span3">
			<?php echo $this->Form->input('item_name', array('class' => 'span3')); ?>
			<?php echo $this->Form->input('section_id', array('class' => 'span3')); ?>
			<?php echo $this->Form->input('publisher_id', array('class' => 'span3')); ?>
			<?php echo $this->Form->input('series_id', array('class' => 'span3')); ?>
			<?php echo $this->Form->input('series_num', array('class' => 'span3', 'label' => 'Series Number')); ?>
			<?php echo $this->Form->input('srp', array('class' => 'span3', 'label' => 'Suggested Retail Price')); ?>
			<?php echo $this->Form->input('stock_id', array('type' => 'text', 'class' => 'span3', 'label' => 'Stock ID')); ?>
			<?php echo $this->Form->input('printing', array('class' => 'span3')); ?>
			<?php echo $this->Form->input('item_date', array('class' => 'span1')); ?>
		</div>
		<div class="span8">
			<?php echo $this->Form->input('description', array('class' => 'input-xlarge span8', 'rows' => 30, 'label' => 'Item Description')); ?>
		</div>
		<?php echo $this->Form->submit(__('Submit Changes'), array('class' => 'btn btn-custom pull-right')); ?>
	</div>
	<?php echo $this->Form->end(); ?>

</div>
