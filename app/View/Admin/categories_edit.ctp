<?php
/**
 *@var $this View
 */
?>
<?php echo $this->Form->create('Category', array('class' => 'form-horizontal')); ?>
<?php echo $this->Form->input('category_name', array('class' => 'span6')); ?>
<?php echo $this->Form->submit(__('Save Categroy')); ?>
<?php echo $this->Form->end(); ?>