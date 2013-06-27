<?php
/**
 * @var $this View
 */
?>
<?php
$name = '';
$link = '';
switch($report['Report']['item_type']) {
	case 1:   ## ITEM
		$name = $report['Item']['item_name'];
		$link = $this->Html->link($name, '/items/' . $this->Common->seoize($report['Item']['id'], $name), array('target' => '_blank'));
		break;
	case 2:   ## SERIES
		$name = $report['Series']['series_name'];
		$link = $this->Html->link($name, '/series/' . $this->Common->seoize($report['Series']['id'], $name), array('target' => '_blank'));
		break;
	case 3:   ## CREATOR
		$name = $report['Creator']['creator_name'];
		$link = $this->Html->link($name, '/creators/' . $this->Common->seoize($report['Creator']['id'], $name), array('target' => '_blank'));
		break;
	case 4:   ## PUBLISHER
		$name = $report['Publisher']['publisher_name'];
		$link = $this->Html->link($name, '/publishers/' . $this->Common->seoize($report['Publisher']['id'], $name), array('target' => '_blank'));
		break;
	case 5:   ## SHOP
		$name = $report['Store']['name'];
		$link = $this->Html->link($name, '/shops/' . $this->Common->seoize($report['Store']['id'], $name), array('target' => '_blank'));
		break;
}
?>
<h2><?php echo $link; ?></h2>
<h4><?php echo __('Description'); ?></h4>
<div class="well"><?php echo $report['Report']['description']; ?></div>
<?php echo $this->Html->link(__('Cancel'), '/admin/reports/cancel/' . $report['Report']['id'], array('class' => 'btn')); ?> <?php echo $this->Html->link(__('Close'), '/admin/reports/close/' . $report['Report']['id'], array('class' => 'btn')); ?>