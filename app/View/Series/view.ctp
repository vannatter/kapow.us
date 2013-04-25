<?php
/**
 * @var $this View
 */
?>
<?php $this->Html->script('page/series.js', array('inline' => false)); ?>
<?php echo $this->Element('headers/series/view'); ?>
<?php echo $this->Element('series/actions'); ?>
<?php echo $this->Element('series/items'); ?>