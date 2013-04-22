<?php
/**
 * @var $this View
 */
?>
<?php echo $this->Form->create('Blog', array('class' => 'form-horizontal')); ?>
<?php echo $this->Form->input('title', array('class' => 'span10')); ?>
<?php echo $this->Form->input('body', array('class' => 'span10 wysihtml', 'rows' => 10)); ?>
<?php echo $this->Form->submit(__('Save Blog')); ?>
<?php echo $this->Form->end(); ?>