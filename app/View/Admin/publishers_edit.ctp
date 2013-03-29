<?php
/**
 *@var $this View
 */
?>
<?php echo $this->Form->create('Publisher', array('class' => 'form-horizontal')); ?>
<?php echo $this->Form->input('publisher_name', array('class' => 'span6')); ?>
<?php echo $this->Form->submit(__('Save Publisher')); ?>
<?php echo $this->Form->end(); ?>