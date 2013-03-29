<?php
/**
 *@var $this View
 */
?>
<?php echo $this->Form->create('Item', array('class' => 'form-horizontal')); ?>
<?php echo $this->Form->input('item_name', array('class' => 'span6')); ?>
<?php echo $this->Form->input('section_id', array('class' => 'span6')); ?>
<?php echo $this->Form->input('publisher_id', array('class' => 'span6')); ?>
<?php echo $this->Form->input('series_id', array('class' => 'span6')); ?>
<?php echo $this->Form->input('item_id', array('type' => 'text', 'label' => __('Item Id'), 'class' => 'span6')); ?>
<?php echo $this->Form->input('printing', array('class' => 'span2')); ?>
<?php echo $this->Form->input('series_num', array('class' => 'span2')); ?>
<?php echo $this->Form->input('item_date', array('type' => 'text', 'class' => 'span3 datepicker')); ?>
<?php echo $this->Form->input('img_fullpath', array('label' => __('Image Fullpath'), 'class' => 'span10')); ?>
<?php echo $this->Form->input('srp', array('label' => __('SRP'), 'class' => 'span4', 'prepend' => '$')); ?>
<?php echo $this->Form->input('description', array('class' => 'span8', 'rows' => 5)); ?>
<?php echo $this->Form->submit(__('Save Item')); ?>
<?php echo $this->Form->end(); ?>
<script>
	$(document).ready(function() {
		$('.datepicker').datepicker({
			'format': 'yyyy-mm-dd'
		})
	});
</script>