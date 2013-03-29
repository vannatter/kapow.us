<?php
/**
 *@var $this View
 */
?>
<?php echo $this->Form->create('Series', array('class' => 'form-horizontal')); ?>
<?php echo $this->Form->input('series_name', array('class' => 'span6')); ?>
<?php echo $this->Form->submit(__('Save Creator')); ?>
<?php echo $this->Form->end(); ?>