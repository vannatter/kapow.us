<?php
/**
 *@var $this View
 */
?>
<?php echo $this->Html->script('page/publishers', array('block' => 'scriptBottom')); ?>
<?php echo $this->Element('headers/publishers/index'); ?>
<?php echo $this->Element('publishers/scroll_list'); ?>