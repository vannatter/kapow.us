<?php
/**
 *@var $this View
 */
?>
<?php echo $this->Form->create('Section', array('class' => 'form-horizontal')); ?>
<?php echo $this->Form->input('category_id', array('class' => 'span6')); ?>
<?php echo $this->Form->input('section_name', array('class' => 'span6')); ?>
<?php echo $this->Form->submit(__('Save Section')); ?>
<?php echo $this->Form->end(); ?>