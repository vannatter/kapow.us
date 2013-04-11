<?php $this->Html->script('page/series.js', array('inline' => false)); ?>
<?php echo $this->Element('headers/series/view'); ?>
<?php echo $this->Element('series/items'); ?>

<pre>
<?php print_r($series); ?>
</pre>