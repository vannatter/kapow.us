<?php
/**
 *@var $this View
 */
?>
<?php echo $this->Form->create('Publisher', array('type' => 'file', 'class' => 'form-horizontal')); ?>
<?php echo $this->Form->input('publisher_name', array('class' => 'span6')); ?>
<?php echo $this->Form->input('publisher_bio', array('class' => 'span6', 'rows' => 5)); ?>
<?php echo $this->Form->input('publisher_website', array('class' => 'span6')); ?>
<div class="control-group">
	<label class="control-label"><?php echo __('Weight'); ?></label>
	<div class="controls">
		<div id="weight" style="width: 50%;"></div>
	</div>
</div>
<?php echo $this->Form->input('publisher_photo', array('class' => 'span6', 'disabled' => true)); ?>
<?php if(!empty($this->request->data['Publisher']['publisher_photo'])) { ?>
	<div class="control-group">
		<div class="controls">
				<?php echo $this->Html->image($this->request->data['Publisher']['publisher_photo'], array('class' => 'span6')); ?>
		</div>
	</div>
<?php } ?>
<div class="control-group">
	<div class="controls">
		<?php echo $this->Form->file('photo_upload'); ?>
	</div>
</div>
<?php echo $this->Form->input('status', array('options' => array('0' => __('Needs Data'), '1' => __('Clean')))); ?>
<div class="form-actions">
	<button type="submit" class="btn"><?php echo __('Save Publisher'); ?></button>
	<?php echo $this->Html->link(__('Cancel'), sprintf('/admin/publishers/unlock/%s', $this->request->data['Publisher']['id']), array('class' => 'btn')); ?>
</div>
<?php echo $this->Form->end(); ?>

<script>
	$(document).ready(function() {
		$( "#weight" ).slider({
	    range: "max",
	    min: 0,
	    max: 100,
	    value: <?php echo $this->request->data['Publisher']['weight']; ?>,
	    slide: function( event, ui ) {
	      $(this).find('.ui-slider-handle').text(ui.value);
	    },
	    change: function( event, ui ) {
	    	$.getJSON('/ajax/publisherWeight', { publisherId: <?php echo  $this->request->data['Publisher']['id']; ?>, value: ui.value }, function(data) {
	    		if(data.error) {
	    			flash('Error updating weight', 3000);
	    		} else {
	    			flash('Updated Weight', 3000);
	    		}
	      });
	    }
	  });
	 	
	 	var value = $("#weight").slider("option","value");
	 	$('#weight').find('.ui-slider-handle').text(value);
	});
</script>