<?php
/**
 *@var $this View
 */
?>

<?php echo $this->Form->create('Item', array('class' => 'form-horizontal', 'inputDefaults' => array(
		'div' => 'form-group',
		'wrapInput' => false,
		'class' => 'form-control'
	)
)); ?>
<?php echo $this->Form->input('item_name'); ?>
<?php echo $this->Form->input('section_id'); ?>
<?php echo $this->Form->input('publisher_id'); ?>
<?php echo $this->Form->input('series_id'); ?>
<?php echo $this->Form->input('item_id', array('type' => 'text', 'label' => __('Item ID'))); ?>
<?php echo $this->Form->input('printing'); ?>
<?php echo $this->Form->input('series_num'); ?>
<?php echo $this->Form->input('item_date', array('type' => 'text', 'class' => 'form-control datepicker')); ?>
<?php echo $this->Form->input('img_fullpath', array('label' => __('Image Fullpath'))); ?>
<?php echo $this->Form->input('srp', array('label' => __('SRP'), 'prepend' => '$')); ?>
<?php echo $this->Form->input('description', array('rows' => 5)); ?>
<div class="form-group">
	<label ><?php echo __('Hotness'); ?></label>
	<div class="controls">
		<div id="hotness" style="width: 50%;"></div>
	</div>
</div>
<?php echo $this->Form->submit(__('Save Item'), array(
	'div' => 'form-group',
	'class' => 'btn btn-default'
)); ?>
<?php echo $this->Form->end(); ?>
<script>
	$(document).ready(function() {
		$('.datepicker').datepicker({
			'format': 'yyyy-mm-dd'
		})
		
		$( "#hotness" ).slider({
	    range: "max",
	    min: 0,
	    max: 100,
	    value: <?php echo $this->request->data['Item']['hot']; ?>,
	    slide: function( event, ui ) {
	      $(this).find('.ui-slider-handle').text(ui.value);
	    },
	    change: function( event, ui ) {
	    	$.getJSON('/ajax/itemHotness', { itemId: <?php echo  $this->request->data['Item']['id']; ?>, value: ui.value }, function(data) {
	    		if (data.error) {
	    			flash('Error updating hotness', 3000);
	    		} else {
	    			flash('Updated Hotness', 3000);
	    		}
	      });
	    }
	  });
	 	
	 	var value = $("#hotness").slider("option","value");
	 	$('#hotness').find('.ui-slider-handle').text(value);
	});
</script>