<?php
/**
 * @var $this View
 */
?>

<?php $this->Html->script('page/improve.admin.js', array('inline' => false)); ?>

<?php
switch($improve['Improvement']['improve_type']) {
	case 1:   ## ITEM
		echo $this->Element('admin/improvements/item', array('item' => $improve['ImproveItem']));
		break;
}
?>