<?php
/**
 * @var $this View
 */
?>

<h2><?php echo $item; ?></h2>
<?php echo $this->Form->create('Flag', array('class' => 'form-horizontal')); ?>
<?php echo $this->Form->input('description', array('class' => 'span8', 'rows' => 10)); ?>
<?php echo $this->Form->submit(__('Submit')); ?>
<?php echo $this->Form->end(); ?>