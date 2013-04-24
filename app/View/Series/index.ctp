<?php
/**
 * @var $this View
 */
?>
<?php $this->Html->script('page/series.js', array('inline' => false)); ?>
<?php echo $this->Element('headers/series/index'); ?>
<?php echo $this->Element('series/scroll_list'); ?>