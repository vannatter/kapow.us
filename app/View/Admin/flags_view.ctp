<?php
/**
 * @var $this View
 */
?>
<?php
$name = '';
$link = '';
switch($flag['Flag']['item_type']) {
	case 1:   ## ITEM
		$name = $flag['Item']['item_name'];
		$link = $this->Html->link($name, '/items/' . $this->Common->seoize($flag['Item']['id'], $name), array('target' => '_blank'));
		break;
	case 2:   ## SERIES
		$name = $flag['Series']['series_name'];
		$link = $this->Html->link($name, '/series/' . $this->Common->seoize($flag['Series']['id'], $name), array('target' => '_blank'));
		break;
	case 3:   ## CREATOR
		$name = $flag['Creator']['creator_name'];
		$link = $this->Html->link($name, '/creators/' . $this->Common->seoize($flag['Creator']['id'], $name), array('target' => '_blank'));
		break;
	case 4:   ## PUBLISHER
		$name = $flag['Publisher']['publisher_name'];
		$link = $this->Html->link($name, '/publishers/' . $this->Common->seoize($flag['Publisher']['id'], $name), array('target' => '_blank'));
		break;
	case 5:   ## SHOP
		$name = $flag['Store']['name'];
		$link = $this->Html->link($name, '/shops/' . $this->Common->seoize($flag['Store']['id'], $name), array('target' => '_blank'));
		break;
}
?>
	<h2><?php echo $link; ?></h2>
	<h4><?php echo __('Description'); ?></h4>
	<div class="well"><?php echo $flag['Flag']['description']; ?></div>
<?php echo $this->Html->link(__('Cancel'), '/admin/flags/cancel/' . $flag['Flag']['id'], array('class' => 'btn')); ?> <?php echo $this->Html->link(__('Close Flag'), '/admin/flags/close/' . $flag['Flag']['id'], array('class' => 'btn')); ?>